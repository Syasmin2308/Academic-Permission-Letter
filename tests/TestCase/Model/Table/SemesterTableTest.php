<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SemesterTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SemesterTable Test Case
 */
class SemesterTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SemesterTable
     */
    protected $Semester;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Semester',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Semester') ? [] : ['className' => SemesterTable::class];
        $this->Semester = $this->getTableLocator()->get('Semester', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Semester);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\SemesterTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
