<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller\Api;

use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

final class ArticlesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    public $fixtures = [
        'app.Articles'
    ];

    public function testArticleDetailRequestReturnSuccessResponse(): void
    {
        // arrange
        $this->configJsonRequest();

        // act
        $this->get('/api/articles/view/first');

        // assertion
        $this->assertResponseSuccess();
    }

    public function testArticleDetailReturnArticleResource(): void
    {
        // arrange
        $this->configJsonRequest();

        // act
        $this->get('/api/articles/view/first');

        // assertion
        $expected = json_encode([
            'article' => [
                'id' => 1,
                'user_id' => 1,
                'title' => 'First Article',
                'slug' => 'first',
                'body' => 'First Article Body',
                'published' => true,
                'created' => '2018-01-07T15:47:01+00:00',
                'modified' => '2018-01-07T15:47:02+00:00',
            ],
        ], JSON_PRETTY_PRINT);
        $this->assertSame($expected, $this->_getBodyAsString());
    }

    public function testArticleDetailReturn404NotFound(): void
    {
        // arrange
        $this->configJsonRequest();

        // act
        $this->get('/api/articles/view/notfound');

        // assertion
        $this->assertResponseCode(404);
    }

    private function configJsonRequest(): void
    {
        $this->configRequest([
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);
    }
}
