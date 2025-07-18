<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProgramTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProgramTable Test Case
 */
class ProgramTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProgramTable
     */
    protected $Program;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Program',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Program') ? [] : ['className' => ProgramTable::class];
        $this->Program = $this->getTableLocator()->get('Program', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Program);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ProgramTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
