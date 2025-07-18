<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SemestersFixture
 */
class SemestersFixture extends TestFixture
{
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
                'Created' => '2025-06-30 00:31:44',
                'Modified' => '2025-06-30 00:31:44',
            ],
        ];
        parent::init();
    }
}
