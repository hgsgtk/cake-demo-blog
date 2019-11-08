<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;
use App\Model\Table\ArticlesTable;

/**
 * @property ArticlesTable Articles
 */
final class ArticlesController extends AppController
{
    /**
     * @param string|null $slug
     */
    public function view($slug = null)
    {
        $article = $this->Articles->findBySlug($slug)->firstOrFail();

        $this->viewBuilder()
            ->setClassName('Json')
            ->setOption('serialize', 'response');
        $this->set(['response' => [
            'article' => $article,
        ]]);
    }
}
