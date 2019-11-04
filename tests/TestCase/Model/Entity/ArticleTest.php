<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Entity;

use App\Model\Entity\Article;
use App\Model\Entity\Tag;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Entity\Article Test Case
 */
final class ArticleTest extends TestCase
{
    public $fixtures = ['app.Articles', 'app.Tags', 'app.ArticlesTags'];

    /**
     *
     * Test subject
     *
     * @var \App\Model\Entity\Article
     */
    public $Article;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->Article = new Article();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Article);

        parent::tearDown();
    }

    /**
     * @test
     *
     * @dataProvider data_getTagString
     *
     * @param array $tags
     * @param string $expected
     */
    public function getTagString(array $tags, string $expected): void
    {
        $tagEntities = [];
        foreach ($tags as $tagTitle) {
            $tagEntities[] = new Tag(['title' => $tagTitle]);
        }
        $article = new Article(['tags' => $tagEntities]);
        $this->assertSame($expected, $article->tag_string);
    }

    public function data_getTagString(): array
    {
        return [
            '空' => [
                'tags' => [''],
                'expected' => '',
            ],
            '1つのタグ' => [
                'tags' => ['sample1'],
                'expected' => 'sample1',
            ],
            '2つのタグ' => [
                'tags' => ['sample1', 'sample2'],
                'expected' => 'sample1, sample2',
            ],
        ];
    }
}
