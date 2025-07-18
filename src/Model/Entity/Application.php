<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Application Entity
 *
 * @property int $AppID
 * @property int|null $UserID
 * @property int|null $SemesterID
 * @property int|null $ProgramID
 * @property string|null $Ketua_name
 * @property string|null $Ketua_matrix
 * @property string|null $Ketua_email
 * @property string|null $Ketua_phone
 * @property string|null $Member1_name
 * @property string|null $Member1_matrix
 * @property string|null $Member2_name
 * @property string|null $Member2_matrix
 * @property string|null $Member3_name
 * @property string|null $Member3_matrix
 * @property string|null $Company_name
 * @property string|null $Company_address
 * @property string $Company_address2
 * @property int $Postcode
 * @property string $City
 * @property string $State
 * @property string|null $Company_PIC
 * @property string|null $Company_PIC_name
 * @property \Cake\I18n\Date|null $Visiting_date
 * @property \Cake\I18n\Time|null $Visiting_hours_start
 * @property \Cake\I18n\Time|null $Expected_hours_end
 * @property string|null $Purpose
 * @property string|null $IV_type
 * @property string|null $Status
 * @property \Cake\I18n\DateTime|null $Created
 * @property \Cake\I18n\DateTime|null $Modified
 *
 * @property \App\Model\Entity\Program $program
 * @property \App\Model\Entity\Semester $semester
 */
class Application extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'UserID' => true,
        'SemesterID' => true,
        'ProgramID' => true,
        'Ketua_name' => true,
        'Ketua_matrix' => true,
        'Ketua_email' => true,
        'Ketua_phone' => true,
        'Member1_name' => true,
        'Member1_matrix' => true,
        'Member2_name' => true,
        'Member2_matrix' => true,
        'Member3_name' => true,
        'Member3_matrix' => true,
        'Company_name' => true,
        'Company_address' => true,
        'Company_address2' => true,
        'Postcode' => true,
        'City' => true,
        'State' => true,
        'Company_PIC' => true,
        'Company_PIC_name' => true,
        'Visiting_date' => true,
        'Visiting_hours_start' => true,
        'Expected_hours_end' => true,
        'Purpose' => true,
        'IV_type' => true,
        'Status' => true,
        'Created' => true,
        'Modified' => true,
        'program' => true,
        'semester' => true,
    ];
}
