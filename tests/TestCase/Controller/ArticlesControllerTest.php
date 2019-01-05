<?php

namespace App\Test\TestCase\Controller;

use App\Controller\ArticlesController;
use Cake\Core\App;
use Cake\Core\Configure;
use Cake\Http\Response;
use Cake\Http\ServerRequest;
use Cake\TestSuite\IntegrationTestCase;

/**
 * Class ArticlesControllerTest
 * @package App\Test\TestCase\Controller
 */
class ArticlesControllerTest extends IntegrationTestCase
{
    public $fixtures = [
        'app.articles',
    ];

    /**
     * @test
     *
     * @return void
     * @throws \PHPUnit\Exception
     */
    public function index_200レスポンスが返ること()
    {
        $this->get('/articles/index');
        $this->assertResponseOK();
    }
}
