<?php

namespace App\Test\TestCase\Controller;

use App\Controller\UsersController;
use App\Model\Table\ArticlesTable;
use App\Model\Table\UsersTable;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\UsersController Test Case
 */
class UsersControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Users',
        'app.Articles',
    ];

    /**
     * @test
     *
     * @throws
     * @return void
     */
    public function loginページにアクセスできること()
    {
        $this->get('/users/login');

        $this->assertResponseOK();
    }

    /**
     * @test
     *
     * @return void
     */
    public function login認証失敗したらエラーメッセージを表示する()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $this->post('/users/login', [
            'email' => 'myname@example.com',
            'password' => 'mistype-password',
        ]);

        $this->assertResponseOk();
        $this->assertResponseContains('ユーザー名またはパスワードが不正です。');
    }

    /**
     * @test
     *
     * @return void
     */
    public function login認証成功したら認証セッションを書き込み、元のページにリダイレクトする()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $this->post('/users/login?redirect=%2Farticles%2Fadd', [
            'email' => 'myname@example.com',
            'password' => 'password',
        ]);

        $this->assertRedirect('/articles/add');
        $this->assertSession(1, 'Auth.User.id');
    }

    /**
     * @test
     *
     * @return void
     */
    public function logoutするとセッションからユーザー情報が削除されている()
    {
        $this->session(['Auth.User.id' => 1]);

        $this->get('/users/logout');

        $this->assertSession([], 'Auth');
        $this->assertRedirect('/users/login');
    }
}
