<?php

namespace App\Test\TestCase\Controller;

use App\Controller\ArticlesController;
use Cake\Core\App;
use Cake\Core\Configure;
use Cake\Http\Response;
use Cake\Http\ServerRequest;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * Class ArticlesControllerTest
 * @package App\Test\TestCase\Controller
 */
class ArticlesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    public $fixtures = [
        'app.Articles',
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

    /**
     * @test
     *
     * @return void
     * @throws \PHPUnit\Exception
     */
    public function view_200レスポンスが返ること()
    {
        $this->get('/articles/view/first');
        $this->assertResponseOK();
    }

    /**
     * @test
     *
     * @return void
     * @throws \PHPUnit\Exception
     */
    public function view_存在するslug指定時にvarsに期待した値が設定されていること()
    {
        $this->get('/articles/view/first');
        $this->assertInstanceOf('App\Model\Entity\Article', $this->viewVariable('article'));
    }
}
