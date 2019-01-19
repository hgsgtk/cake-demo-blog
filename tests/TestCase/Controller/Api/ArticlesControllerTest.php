<?php
namespace App\Test\TestCase\Controller\Api;

use App\Controller\Api\ArticlesController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Api\ArticlesController Test Case
 */
class ArticlesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Articles'
    ];

    /**
     * @test
     *
     * @throws \PHPUnit\Exception
     *
     * @return void
     */
    public function 記事一覧取得にて成功レスポンスが返却される()
    {
        $this->configRequest([
            'headers' => [
                'Accept' => 'application/json'
            ],
        ]);
        $this->get('/api/articles/index');

        $this->assertResponseOk();
        $this->assertSame('application/json', $this->_response->getType());
    }
}
