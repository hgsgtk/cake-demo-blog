<?php

namespace App\Controller\Api;

use App\Controller\AppController;
use App\Model\Table\ArticlesTable;

/**
 * Class ArticlesController
 * @package App\Controller\Api
 * @property ArticlesTable Articles
 */
class ArticlesController extends AppController
{
    /**
     * @throws \Exception
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
    }

    /**
     * list articles
     *
     * @return void
     */
    public function index()
    {
        $articles = $this->Articles
            ->find()
            ->where(['published' => 1])
            ->all();
        $this->set([
            '_serialize' => ['articles'],
            'articles' => $articles,
        ]);
    }
}
