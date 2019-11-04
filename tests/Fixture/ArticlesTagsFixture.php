<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * Class ArticlesTagsFixture
 * @package App\Test\Fixture
 */
class ArticlesTagsFixture extends TestFixture
{
    /**
     * @var array
     */
    public $fields = [
        'article_id' => ['type' => 'integer', 'null' => false],
        'tag_id' => ['type' => 'integer', 'null' => false],
        '_constraints' => [
            'unique_tag' => ['type' => 'primary', 'columns' => ['article_id', 'tag_id']],
            'tag_id_fk' => [
                'type' => 'foreign',
                'columns' => ['tag_id'],
                'references' => ['tags', 'id'],
                'update' => 'cascade',
                'delete' => 'cascade',
            ],
        ],
    ];

    /**
     * @var array
     */
    public $records = [
        [
            'article_id' => 1,
            'tag_id' => 1,
        ],
        [
            'article_id' => 1,
            'tag_id' => 2,
        ],
    ];
}
