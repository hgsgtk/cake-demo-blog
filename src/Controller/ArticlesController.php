<?php

namespace App\Controller;

/**
 * Class ArticlesController
 * @package App\Controller
 */
class ArticlesController extends AppController
{
    /**
     * @throws \Exception
     * @return void
     */
    public function index()
    {
        $this->loadComponent('Paginator');
        $articles = $this->Paginator->paginate($this->Articles->find());
        $this->set(compact('articles'));
    }

    /**
     * @return void
     */
    public function view()
    {
    }
}
