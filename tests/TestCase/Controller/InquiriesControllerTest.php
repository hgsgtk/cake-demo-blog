<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\InquiriesController Test Case
 */
final class InquiriesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Inquiries',
    ];

    /**
     * @test
     */
    public function 問い合わせページにアクセスできる()
    {
        $this->get('/inquiries/add');

        $this->assertResponseOk();
    }

    /**
     * @test
     */
    public function 問い合わせ保存成功時一覧ページへリダイレクトする()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [
            'title' => 'sample',
            'body' => 'sample',
            'email' => 'hgsgtk@gmail.com',
        ];
        $this->post('/inquiries/add', $data);

        $this->assertResponseSuccess();
        $this->assertRedirect('/inquiries');
    }

    /**
     * @test
     */
    public function 問い合わせした内容がinquiriesテーブルに保存される()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->configRequest([
            'environment' => ['REMOTE_ADDR' => '12.34.56.78'],
        ]);

        $data = [
            'title' => 'sample',
            'body' => 'sample',
            'email' => 'hgsgtk@gmail.com',
        ];
        $this->post('/inquiries/add', $data);

        /** @var Inquiry $saved_inquiry */
        $saved_inquiry = TableRegistry::getTableLocator()
            ->get('inquiries')->find()
            ->where(['title' => 'sample'])->first();
        $this->assertInstanceOf('\App\Model\Entity\Inquiry', $saved_inquiry);
    }
}
