<?php

namespace App\Model\Table;

use Cake\Event\Event;
use Cake\ORM\Entity;
use Cake\ORM\Table;
use Cake\Utility\Text;
use Cake\Validation\Validator;

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
        if ($entity->isNew() && !$entity->slug) {
            $sluggedTitle = Text::slug($entity->title);
            $entity->slug = substr($sluggedTitle, 0, 191);
        }
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
}
