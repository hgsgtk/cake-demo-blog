<?php

namespace App\Model\Table;

use Cake\ORM\Table;

/**
 * Class ArticlesTable
 * @package App\Model\Table
 */
class ArticlesTable extends Table
{
    /**
     * @param array $config config of table
     *
     * @return void
     */
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
    }
}
