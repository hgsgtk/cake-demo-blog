<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;
use App\Model\Table\ArticlesTable;
use Cake\View\JsonView;

/**
 * @property ArticlesTable Articles
 */
final class ArticlesController extends AppController
{
    public function view($slug = null)
    {
        $article = $this->Articles->findBySlug($slug)->firstOrFail();

        $this->viewBuilder()
            ->setClassName(JsonView::Class)
            ->setOption('serialize', 'response');
        $this->set('response', ['article' => $article]);
    }
}
