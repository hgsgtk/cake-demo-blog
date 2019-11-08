<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller\Api;

use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

final class ArticlesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    public function testArticleDetailReturnSuccess(): void
    {
        // arrange
        $this->configRequest([
            'header' => [
                'Accept' => 'application/json',
            ],
        ]);

        // act
        $this->get('/api/articles/view/first');

        // assertion
        $this->assertResponseSuccess();
    }
}
