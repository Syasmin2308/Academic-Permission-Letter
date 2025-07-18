<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SemestersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SemestersTable Test Case
 */
class SemestersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SemestersTable
     */
    protected $Semesters;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Semesters',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Semesters') ? [] : ['className' => SemestersTable::class];
        $this->Semesters = $this->getTableLocator()->get('Semesters', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Semesters);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\SemestersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
