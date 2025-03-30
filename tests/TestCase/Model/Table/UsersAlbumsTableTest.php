<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsersAlbumsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersAlbumsTable Test Case
 */
class UsersAlbumsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UsersAlbumsTable
     */
    protected $UsersAlbums;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.UserAlbum',
        'app.Users',
        'app.Albums',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('UserAlbum') ? [] : ['className' => UsersAlbumsTable::class];
        $this->UsersAlbums = $this->getTableLocator()->get('UserAlbum', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->UsersAlbums);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\UsersAlbumsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\UsersAlbumsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
