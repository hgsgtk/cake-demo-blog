<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * Class ArticlesControllerTest
 *
 * @package App\Test\TestCase\Controller
 */
final class ArticlesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    public $fixtures = [
        'app.Articles',
        'app.ArticlesTags',
        'app.Users',
        'app.Tags',
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

    /**
     * @test
     *
     * @return void
     * @throws \PHPUnit\Exception
     */
    public function add_GETリクエスト時200レスポンスが返ってくること()
    {
        $this->session(['Auth.User.id' => 1]);

        $this->get('/articles/add');
        $this->assertResponseOK();
    }

    /**
     * @test
     *
     * @return void
     *
     * @throws \PHPUnit\Exception
     */
    public function add_GETリクエスト時ArticleEntityをviewにセットする()
    {
        $this->session(['Auth.User.id' => 1]);

        $this->get('/articles/add');

        $this->assertInstanceOf('App\Model\Entity\Article', $this->viewVariable('article'));
    }

    /**
     * @test
     *
     * @return void
     *
     * @throws \PHPUnit\Exception
     */
    public function add_GETリクエスト時Tagsに関連付けたQueryオブジェクトがviewにセットする()
    {
        $this->session(['Auth.User.id' => 1]);

        $this->get('/articles/add');

        $this->assertInstanceOf('Cake\ORM\Query', $this->viewVariable('tags'));
    }

    /**
     * @test
     *
     * @return void
     * @throws \PHPUnit\Exception
     */
    public function add_POST記事作成リクエストを受付し成功する()
    {
        // 自動トークン生成をOFFにする
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $this->session(['Auth.User.id' => 1]);

        $data = [
            'user_id' => 1,
            'title' => 'new-article',
            'body' => 'new-article-body',
        ];
        $this->post('/articles/add', $data);

        $this->assertResponseSuccess();
    }

    /**
     * @test
     *
     * @return void
     * @throws \PHPUnit\Exception
     */
    public function edit_GETリクエスト時に200レスポンスが返ってくること()
    {
        $this->session(['Auth.User.id' => 1]);

        $this->get('/articles/edit/first');
        $this->assertResponseOK();
    }

    /**
     * @test
     *
     * @return void
     *
     * @throws \PHPUnit\Exception
     */
    public function edit_GETリクエストするとArticleがvarsに設定されている()
    {
        $this->session(['Auth.User.id' => 1]);

        $this->get('/articles/edit/first');
        $this->assertInstanceOf('App\Model\Entity\Article', $this->viewVariable('article'));
    }

    /**
     * @test
     *
     * @return void
     *
     * @throws \PHPUnit\Exception
     */
    public function edit_GETリクエスト時Tagsに関連付けたQueryオブジェクトがviewにセットする()
    {
        $this->session(['Auth.User.id' => 1]);

        $this->get('/articles/edit/first');

        $this->assertInstanceOf('Cake\ORM\Query', $this->viewVariable('tags'));
    }

    /**
     * @test
     *
     * @return void
     *
     * @throws \PHPUnit\Exception
     */
    public function edit_POSTリクエストで記事更新を行うと結果が反映される()
    {
        $this->session(['Auth.User.id' => 1]);

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [
            'user_id' => 1,
            'title' => 'edited-title',
            'body' => 'edited-article-body',
        ];
        $this->post('/articles/edit/first', $data);

        $this->assertResponseSuccess();
    }

    /**
     * @test
     *
     * @throws \PHPUnit\Exception
     */
    public function delete_GETリクエストの場合エラー()
    {
        $this->session(['Auth.User.id' => 1]);

        $this->get('/articles/delete/first');

        $this->assertResponseError();
    }

    /**
     * @test
     *
     * @throws \PHPUnit\Exception
     */
    public function delete_削除成功した場合フラッシュメッセージが設定される()
    {
        $this->session(['Auth.User.id' => 1]);

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $this->delete('/articles/delete/first');

        $this->assertResponseSuccess();
    }

    /**
     * @test
     *
     * @throws \PHPUnit\Exception
     */
    public function tags_リクエストできる()
    {
        $this->get('/articles/tags/sample');

        $this->assertResponseOK();
    }
}
