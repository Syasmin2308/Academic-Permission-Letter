<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ApplicationsFixture
 */
class ApplicationsFixture extends TestFixture
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
                'AppID' => 1,
                'UserID' => 1,
                'SemesterID' => 1,
                'ProgramID' => 1,
                'Ketua_name' => 'Lorem ipsum dolor sit amet',
                'Ketua_matrix' => 'Lorem ipsum dolor ',
                'Ketua_email' => 'Lorem ipsum dolor sit amet',
                'Ketua_phone' => 'Lorem ipsum dolor ',
                'Member1_name' => 'Lorem ipsum dolor sit amet',
                'Member1_matrix' => 'Lorem ipsum dolor ',
                'Member2_name' => 'Lorem ipsum dolor sit amet',
                'Member2_matrix' => 'Lorem ipsum dolor ',
                'Member3_name' => 'Lorem ipsum dolor sit amet',
                'Member3_matrix' => 'Lorem ipsum dolor ',
                'Company_name' => 'Lorem ipsum dolor sit amet',
                'Company_address' => 'Lorem ipsum dolor sit amet',
                'Company_address2' => 'Lorem ipsum dolor sit amet',
                'Postcode' => 1,
                'City' => 'Lorem ipsum dolor sit amet',
                'State' => 'Lorem ipsum dolor sit amet',
                'Company_PIC' => 'Lorem ipsum dolor sit amet',
                'Company_PIC_name' => 'Lorem ipsum dolor sit amet',
                'Visiting_date' => '2025-07-09',
                'Visiting_hours_start' => '18:30:54',
                'Expected_hours_end' => '18:30:54',
                'Purpose' => 'Lorem ipsum dolor sit amet',
                'IV_type' => 'Lorem ipsum dolor sit amet',
                'Status' => 'Lorem ipsum dolor ',
                'Created' => '2025-07-09 18:30:54',
                'Modified' => '2025-07-09 18:30:54',
            ],
        ];
        parent::init();
    }
}
