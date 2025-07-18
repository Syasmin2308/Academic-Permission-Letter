<?php
declare(strict_types=1);

namespace App\Controller;

use AuditStash\Meta\RequestMetadata;
use Cake\Event\EventManager;
use Cake\Routing\Router;

/**
 * Semesters Controller
 *
 * @property \App\Model\Table\SemestersTable $Semesters
 */
class SemestersController extends AppController
{
	public function initialize(): void
	{
		parent::initialize();

		$this->loadComponent('Search.Search', [
			'actions' => ['index'],
		]);
	}
	
	public function beforeFilter(\Cake\Event\EventInterface $event)
	{
		parent::beforeFilter($event);
	}

	/*public function viewClasses(): array
    {
        return [JsonView::class];
		return [JsonView::class, XmlView::class];
    }*/
	
	public function json()
    {
		$this->viewBuilder()->setLayout('json');
        $this->set('semesters', $this->paginate());
        $this->viewBuilder()->setOption('serialize', 'semesters');
    }
	
	public function csv()
	{
		$this->response = $this->response->withDownload('semesters.csv');
		$semesters = $this->Semesters->find();
		$_serialize = 'semesters';

		$this->viewBuilder()->setClassName('CsvView.Csv');
		$this->set(compact('semesters', '_serialize'));
	}
	
	public function pdfList()
	{
		$this->viewBuilder()->enableAutoLayout(false); 
		$semesters = $this->paginate($this->Semesters);
		$this->viewBuilder()->setClassName('CakePdf.Pdf');
		$this->viewBuilder()->setOption(
			'pdfConfig',
			[
				'orientation' => 'portrait',
				'download' => true, 
				'filename' => 'semesters_List.pdf' 
			]
		);
		$this->set(compact('semesters'));
	}
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
{
    $this->set('title', 'Semesters List');

    $this->paginate = [
        'maxLimit' => 10,
    ];

    // Search query
    $query = $this->Semesters->find('search', search: $this->request->getQueryParams());
    $semesters = $this->paginate($query); // DO NOT overwrite $query after this!

    // Summary counts
  $this->set('total_semesters', $this->Semesters->find()->count());
    $this->set('total_semesters_archived', $this->Semesters->find()->where(['status' => 'Archived'])->count());
    $this->set('total_semesters_active', $this->Semesters->find()->where(['status' => 'Active'])->count());
    $this->set('total_semesters_inactive', $this->Semesters->find()->where(['status' => 'Inactive'])->count());
    // Monthly chart data
    $expectedMonths = [];
    for ($i = 11; $i >= 0; $i--) {
        $expectedMonths[] = date('M-Y', strtotime("-$i months"));
    }

    $monthQuery = $this->Semesters->find();
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

        $totalByMonth[] = [
            'month' => $expectedMonth,
            'count' => $count
        ];
    }

    $totalByMonth = json_encode($totalByMonth);
    $dataArray = json_decode($totalByMonth, true);

    $monthArray = [];
    $countArray = [];
    foreach ($dataArray as $data) {
        $monthArray[] = $data['month'];
        $countArray[] = $data['count'];
    }

    // Pass to view
    $this->set(compact('semesters', 'monthArray', 'countArray'));
}


    /**
     * View method
     *
     * @param string|null $id Semester id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->set('title', 'Semesters Details');
        $semester = $this->Semesters->get($id, contain: []);
        $this->set(compact('semester'));

        $this->set(compact('semester'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->set('title', 'New Semesters');
		EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
			foreach ($logs as $log) {
				$log->setMetaInfo($log->getMetaInfo() + ['a_name' => 'Add']);
				$log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'Semesters']);
				$log->setMetaInfo($log->getMetaInfo() + ['ip' => $this->request->clientIp()]);
				$log->setMetaInfo($log->getMetaInfo() + ['url' => Router::url(null, true)]);
				$log->setMetaInfo($log->getMetaInfo() + ['slug' => $this->Authentication->getIdentity('slug')->getIdentifier('slug')]);
			}
		});
        $semester = $this->Semesters->newEmptyEntity();
        if ($this->request->is('post')) {
            $semester = $this->Semesters->patchEntity($semester, $this->request->getData());
            if ($this->Semesters->save($semester)) {
                $this->Flash->success(__('The semester has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The semester could not be saved. Please, try again.'));
        }
        $this->set(compact('semester'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Semester id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->set('title', 'Semesters Edit');
		EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
			foreach ($logs as $log) {
				$log->setMetaInfo($log->getMetaInfo() + ['a_name' => 'Edit']);
				$log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'Semesters']);
				$log->setMetaInfo($log->getMetaInfo() + ['ip' => $this->request->clientIp()]);
				$log->setMetaInfo($log->getMetaInfo() + ['url' => Router::url(null, true)]);
				$log->setMetaInfo($log->getMetaInfo() + ['slug' => $this->Authentication->getIdentity('slug')->getIdentifier('slug')]);
			}
		});
        $semester = $this->Semesters->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $semester = $this->Semesters->patchEntity($semester, $this->request->getData());
            if ($this->Semesters->save($semester)) {
                $this->Flash->success(__('The semester has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The semester could not be saved. Please, try again.'));
        }
        $this->set(compact('semester'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Semester id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
			foreach ($logs as $log) {
				$log->setMetaInfo($log->getMetaInfo() + ['a_name' => 'Delete']);
				$log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'Semesters']);
				$log->setMetaInfo($log->getMetaInfo() + ['ip' => $this->request->clientIp()]);
				$log->setMetaInfo($log->getMetaInfo() + ['url' => Router::url(null, true)]);
				$log->setMetaInfo($log->getMetaInfo() + ['slug' => $this->Authentication->getIdentity('slug')->getIdentifier('slug')]);
			}
		});
        $this->request->allowMethod(['post', 'delete']);
        $semester = $this->Semesters->get($id);
        if ($this->Semesters->delete($semester)) {
            $this->Flash->success(__('The semester has been deleted.'));
        } else {
            $this->Flash->error(__('The semester could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
	public function archived($id = null)
    {
		$this->set('title', 'Semesters Edit');
		EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
			foreach ($logs as $log) {
				$log->setMetaInfo($log->getMetaInfo() + ['a_name' => 'Archived']);
				$log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'Semesters']);
				$log->setMetaInfo($log->getMetaInfo() + ['ip' => $this->request->clientIp()]);
				$log->setMetaInfo($log->getMetaInfo() + ['url' => Router::url(null, true)]);
				$log->setMetaInfo($log->getMetaInfo() + ['slug' => $this->Authentication->getIdentity('slug')->getIdentifier('slug')]);
			}
		});
        $semester = $this->Semesters->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $semester = $this->Semesters->patchEntity($semester, $this->request->getData());
			$semester->status = 2; //archived
            if ($this->Semesters->save($semester)) {
                $this->Flash->success(__('The semester has been archived.'));

				return $this->redirect($this->referer());
            }
            $this->Flash->error(__('The semester could not be archived. Please, try again.'));
        }
        $this->set(compact('semester'));
    }
}
