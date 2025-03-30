<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsersArtistsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersArtistsTable Test Case
 */
class UsersArtistsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UsersArtistsTable
     */
    protected $UsersArtists;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.UsersArtists',
        'app.Users',
        'app.Artists',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('UsersArtists') ? [] : ['className' => UsersArtistsTable::class];
        $this->UsersArtists = $this->getTableLocator()->get('UsersArtists', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->UsersArtists);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\UsersArtistsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\UsersArtistsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
