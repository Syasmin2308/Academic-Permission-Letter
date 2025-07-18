<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SemesterFixture
 */
class SemesterFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'semester';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'SemesterID' => 1,
                'Code' => 'Lorem ipsum dolor ',
                'Name' => 'Lorem ipsum dolor sit amet',
                'Status' => 'Lorem ipsum dolor ',
                'Created' => '2025-06-19 11:38:46',
                'Modified' => '2025-06-19 11:38:46',
            ],
        ];
        parent::init();
    }
}
