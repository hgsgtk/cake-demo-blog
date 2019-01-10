<?php

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ArticlesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * Class ArticlesTableTest
 *
 * @package App\Test\TestCase\Model\Table
 *
 * @coversDefaultClass \App\Model\Table\ArticlesTable
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
     *
     * @covers ::beforeSave
     */
    public function beforeSave_slugに値が設定される()
    {
        $article = $this->Articles->newEntity(
            [
                'user_id' => 1,
                'title' => str_repeat('a', 10),
                'body' => str_repeat('a', 10),
            ]
        );
        $result = $this->Articles->save($article);

        $this->assertInstanceOf('App\Model\Entity\Article', $result);
        $this->assertSame(str_repeat('a', 10), $result->slug);
    }

    /**
     * @test
     *
     * @dataProvider dataProvider_validationDefault
     *
     * @param array $data
     * @param string $expected
     */
    public function validationDefault(array $data, string $expected): void
    {
        $article = $this->Articles->newEntity($data);
        $this->assertArrayHasKey($expected, $article->getErrors());
    }

    /**
     * @return array
     */
    public function dataProvider_validationDefault(): array
    {
        return [
            'titleが空' => [
                'data' => [
                    'title' => '',
                    'body' => str_repeat('a', 10),
                ],
                'expected' => 'title',
            ],
            'titleが9文字以下' => [
                'data' => [
                    'title' => str_repeat('a', 9),
                    'body' => str_repeat('a', 10),
                ],
                'expected' => 'title',
            ],
            'titleが256文字以上' => [
                'data' => [
                    'title' => str_repeat('a', 256),
                    'body' => str_repeat('a', 10),
                ],
                'expected' => 'title',
            ],
            'bodyが空' => [
                'data' => [
                    'title' => str_repeat('a', 10),
                    'body' => '',
                ],
                'expected' => 'body',
            ],
            'bodyが10文字以下' => [
                'data' => [
                    'title' => str_repeat('a', 10),
                    'body' => str_repeat('a', 9),
                ],
                'expected' => 'body',
            ],
        ];
    }
}
