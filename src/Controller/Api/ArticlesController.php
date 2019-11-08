<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\View\JsonView;

final class ArticlesController extends AppController
{
    public function view($slug = null)
    {
        $this->viewBuilder()
            ->setClassName(JsonView::Class)
            ->setOption('serialize', 'response');
        $this->set('response', []);
    }
}
