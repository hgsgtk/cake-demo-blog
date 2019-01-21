<?php

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class ArticlesFixture extends TestFixture
{
    public $fields = [
        'id' => [
            'type' => 'integer',
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

    public $records = [
        [
            'user_id' => 1,
            'title' => 'First Published Article',
            'slug' => 'first-published-article',
            'body' => 'First Published Body',
            'published' => 1,
            'created' => '2018-01-07 15:47:01',
            'modified' => '2018-01-07 15:47:02',
        ],
        [
            'user_id' => 1,
            'title' => 'Unpublished Article',
            'slug' => 'unpublished-article',
            'body' => 'Unpublished Article Body',
            'published' => 0,
            'created' => '2018-01-07 15:47:01',
            'modified' => '2018-01-07 15:47:02',
        ],
    ];
}
