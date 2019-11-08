<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;

final class ArticlesController extends AppController
{
    public function view()
    {
        $this->viewBuilder()
            ->setClassName('Json')
            ->setOption('serialize', 'response');
        $this->set(['response' => []]);
    }
}
