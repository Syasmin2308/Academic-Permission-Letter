<?php
declare(strict_types=1);

namespace App\Controller;

use AuditStash\Meta\RequestMetadata;
use Cake\Event\EventManager;
use Cake\Routing\Router;

class ProgramsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Search.Search', ['actions' => ['index']]);
    }
    
    public function index()
    {
        $this->set('title', 'Programs List');
        $this->paginate = ['maxLimit' => 10];

        $query = $this->Programs->find('search', search: $this->request->getQueryParams());
        $programs = $this->paginate($query);

        // Status counts - using string values like SemestersController
        $this->set('total_programs', $this->Programs->find()->count());
        $this->set('total_programs_archived', $this->Programs->find()->where(['Status' => 'Archived'])->count());
        $this->set('total_programs_active', $this->Programs->find()->where(['Status' => 'Active'])->count());
        $this->set('total_programs_inactive', $this->Programs->find()->where(['Status' => 'Inactive'])->count());

        // Monthly chart data (keep your existing code)
        $expectedMonths = [];
        for ($i = 11; $i >= 0; $i--) {
            $expectedMonths[] = date('M-Y', strtotime("-$i months"));
        }

        $monthQuery = $this->Programs->find();
        $monthQuery->select([
                'count' => $monthQuery->func()->count('*'),
                'date' => $monthQuery->func()->date_format(['created' => 'identifier', "%b-%Y"]),
                'month' => 'MONTH(created)',
                'year' => 'YEAR(created)'
            ])
            ->where([
                'created >=' => date('Y-m-01', strtotime('-11 months')),
                'created <=' => date('Y-m-t')
            ])
            ->groupBy(['year', 'month'])
            ->orderBy(['year' => 'ASC', 'month' => 'ASC']);

        $results = $monthQuery->all()->toArray();

        $totalByMonth = [];
        foreach ($expectedMonths as $expectedMonth) {
            $found = false;
            $count = 0;

            foreach ($results as $result) {
                if ($expectedMonth === $result->date) {
                    $found = true;
                    $count = $result->count;
                    break;
                }
            }

            $totalByMonth[] = ['month' => $expectedMonth, 'count' => $count];
        }

        $totalByMonth = json_encode($totalByMonth);
        $dataArray = json_decode($totalByMonth, true);

        $monthArray = $countArray = [];
        foreach ($dataArray as $data) {
            $monthArray[] = $data['month'];
            $countArray[] = $data['count'];
        }

        $this->set(compact('programs', 'monthArray', 'countArray'));
    }

    // Keep all your other methods (view, add, edit, delete) the same as before,
    // but update the archived method to use string status:

    public function archived($id = null)
    {
        $this->set('title', 'Archive Program');
        EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
            foreach ($logs as $log) {
                $log->setMetaInfo($log->getMetaInfo() + [
                    'a_name' => 'Archived',
                    'c_name' => 'Programs',
                    'ip' => $this->request->clientIp(),
                    'url' => Router::url(null, true),
                    'slug' => $this->Authentication->getIdentity('slug')->getIdentifier('slug')
                ]);
            }
        });
        
        $program = $this->Programs->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $program = $this->Programs->patchEntity($program, $this->request->getData());
            $program->Status = 'Archived'; // Changed to string value
            if ($this->Programs->save($program)) {
                $this->Flash->success(__('The program has been archived.'));
                return $this->redirect($this->referer());
            }
            $this->Flash->error(__('The program could not be archived. Please, try again.'));
        }
        $this->set(compact('program'));
    }
}