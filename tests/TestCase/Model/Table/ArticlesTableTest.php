<?php

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ArticlesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * Class ArticlesTableTest
 * @package App\Test\TestCase\Model\Table
 *
 * @property  ArticlesTable Articles
 */
class ArticlesTableTest extends TestCase
{
    public $fixtures = ['app.Articles'];

    public function setUp()
    {
        parent::setUp();
        $this->Articles = TableRegistry::get('Articles');
    }

    /**
     * @test
     */
    public function beforeSave_slugに値が設定される()
    {
        $article = $this->Articles->newEntity(
            [
                'user_id' => 1,
                'title' => 'test',
                'body' => 'test',
            ]
        );
        $result = $this->Articles->save($article);

        $this->assertInstanceOf('App\Model\Entity\Article', $result);
        $this->assertSame('test', $result->slug);
    }
}
