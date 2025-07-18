<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProgramsFixture
 */
class ProgramsFixture extends TestFixture
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
                'ProgramID' => 1,
                'Code' => 'Lorem ipsum dolor ',
                'Name' => 'Lorem ipsum dolor sit amet',
                'Status' => 'Lorem ipsum dolor ',
                'Created' => '2025-06-30 00:32:10',
                'Modified' => '2025-06-30 00:32:10',
            ],
        ];
        parent::init();
    }
}
