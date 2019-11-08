<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;

final class ArticlesController extends AppController
{
    public function view()
    {
        // FIXME temporary implementation
        $article = [
            'id' => 1,
            'user_id' => 1,
            'title' => 'First Article',
            'slug' => 'first',
            'body' => 'First Article Body',
            'published' => true,
            'created' => '2018-01-07T15:47:01+00:00',
            'modified' => '2018-01-07T15:47:02+00:00',
        ];

        $this->viewBuilder()
            ->setClassName('Json')
            ->setOption('serialize', 'response');
        $this->set(['response' => [
            'article' => $article,
        ]]);
    }
}
