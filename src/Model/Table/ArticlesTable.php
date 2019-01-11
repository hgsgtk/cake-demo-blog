<?php

namespace App\Model\Table;

use Cake\Event\Event;
use Cake\ORM\Entity;
use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Utility\Text;
use Cake\Validation\Validator;

/**
 * Class ArticlesTable
 * @package App\Model\Table
 *
 * @property TagsTable $Tags
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
        $this->belongsToMany('Tags');
    }

    /**
     * @param Event $event Cake event
     * @param Entity $entity ORM Entity
     * @param array $options option parameters
     *
     * @return void
     */
    public function beforeSave($event, $entity, $options)
    {
        if ($entity->tag_string) {
            $entity->tags = $this->_buildTags($entity->tag_string);
        }

        if ($entity->isNew() && !$entity->slug) {
            $sluggedTitle = Text::slug($entity->title);
            $entity->slug = substr($sluggedTitle, 0, 191);
        }
    }

    /**
     * @param string $tagString value set tag_string
     *
     * @return array
     */
    protected function _buildTags(string $tagString): array
    {
        $newTags = array_map('trim', explode(',', $tagString));
        $newTags = array_filter($newTags);
        $newTags = array_unique($newTags);

        $out = [];
        $query = $this->Tags->find()
            ->where(['Tags.title IN' => $newTags]);

        foreach ($query->extract('title') as $existing) {
            $index = array_search($existing, $newTags);
            if ($index !== false) {
                unset($newTags[$index]);
            }
        }
        foreach ($query as $tag) {
            $out[] = $tag;
        }
        foreach ($newTags as $tag) {
            $out[] = $this->Tags->newEntity(['title' => $tag]);
        }

        return $out;
    }

    /**
     * @param Validator $validator Cake Validator
     *
     * @return Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->notBlank('title')
            ->minLength('title', 10)
            ->maxLength('title', 255)
            ->notBlank('body')
            ->minLength('body', 10);

        return $validator;
    }

    /**
     * @param Query $query Cake Query object
     * @param array $options query options
     *
     * @return Query
     */
    public function findTagged(Query $query, array $options)
    {
        $columns = [
            'Articles.id', 'Articles.user_id', 'Articles.title',
            'Articles.body', 'Articles.published', 'Articles.created',
            'Articles.slug',
        ];
        $query = $query
            ->select($columns)
            ->distinct($columns);

        if (empty($options['tags'])) {
            $query->leftJoinWith('Tags')
                ->where(['Tags.title IS' => null]);
        } else {
            $query->innerJoinWith('Tags')
                ->where(['Tags.title IN' => $options['tags']]);
        }

        return $query->group(['Articles.id']);
    }
}
