<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProgramFixture
 */
class ProgramFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'program';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'ProgramID' => 1,
                'Code' => 'Lorem ipsum dolor ',
                'Name' => 'Lorem ipsum dolor sit amet',
                'Status' => 'Lorem ipsum dolor ',
                'Created' => '2025-06-19 11:39:18',
                'Modified' => '2025-06-19 11:39:18',
            ],
        ];
        parent::init();
    }
}
