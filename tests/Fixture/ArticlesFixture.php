<?php

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class ArticlesFixture extends TestFixture
{
    public $fields = [
        'id' => [
            'type' => 'integer'
        ],
        'user_id' => [
            'type' => 'integer',
        ],
        'title' => [
            'type' => 'string',
            'length' => 255,
            'null' => false,
        ],
        'slug' => [
            'type' => 'string',
            'length' => 191,
            'null' => false,
        ],
        'body' => 'text',
        'published' => [
            'type' => 'integer',
            'default' => '0',
            'null' => false,
        ],
        'created' => 'datetime',
        'modified' => 'datetime',
        '_constraints' => [
            'primary' => [
                'type' => 'primary',
                'columns' => ['id'],
            ],
        ],
    ];
}
