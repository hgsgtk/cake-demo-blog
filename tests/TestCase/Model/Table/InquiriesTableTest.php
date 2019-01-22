<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InquiriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InquiriesTable Test Case
 */
class InquiriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\InquiriesTable
     */
    public $Inquiries;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Inquiries'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Inquiries') ? [] : ['className' => InquiriesTable::class];
        $this->Inquiries = TableRegistry::getTableLocator()->get('Inquiries', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Inquiries);

        parent::tearDown();
    }
}
