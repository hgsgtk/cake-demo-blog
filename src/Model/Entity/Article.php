<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Class Article
 * @package App\Model\Entity
 */
class Article extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
        'slug' => false,
    ];
}
