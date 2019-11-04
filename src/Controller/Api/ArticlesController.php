<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;

/**
 * Class ArticlesController
 * @package App\Controller\Api
 * @property ArticlesTable Articles
 */
class ArticlesController extends AppController
{
    /**
     * 記事一覧
     *
     * @return void
     */
    public function index()
    {
        $articles = $this->Articles->find('all');
        $this->viewBuilder()
            ->setClassName('Json')
            ->setOption('serialize', 'response');
        $this->set(['response' => ['articles' => $articles]]);
    }

    /**
     * 記事詳細
     *
     * @param string $slug article slug
     *
     * @return void
     */
    public function view($slug = null)
    {
        $article = $this->Articles->findBySlug($slug)->firstOrFail();
        $this->viewBuilder()
            ->setClassName('Json')
            ->setOption('serialize', 'response');
        $this->set(['response' => ['article' => $article]]);
    }
}
