<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\User;
use App\Model\Table\ArticlesTable;

/**
 * Class ArticlesController
 * @package App\Controller
 * @property ArticlesTable Articles
 */
class ArticlesController extends AppController
{
    /**
     * @return void
     *
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Paginator');
        $this->loadComponent('Flash');

        $this->Auth->allow(['tags']);
    }

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
     * @param string $slug article slug
     *
     * @return void
     */
    public function view($slug = null)
    {
        $article = $this->Articles->findBySlug($slug)->firstOrFail();
        $this->set(compact('article'));
    }

    /**
     * @return \Cake\Http\Response|null
     */
    public function add()
    {
        $article = $this->Articles->newEmptyEntity();
        if ($this->request->is('post')) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());

            $article->set('user_id', $this->Auth->user('id'));

            if ($this->Articles->save($article)) {
                $this->Flash->success(__('Your article has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your article.'));

        }
        $tags = $this->Articles->Tags->find('list');

        $this->set(compact('tags'));
        $this->set(compact('article'));
    }

    /**
     * @param string $slug slug of article
     *
     * @return \Cake\Http\Response|null
     */
    public function edit($slug)
    {
        $article = $this->Articles
            ->findBySlug($slug)
            ->contain('Tags')
            ->firstOrFail();
        if ($this->request->is(['post', 'put'])) {
            $this->Articles->patchEntity($article, $this->request->getData(), [
                'accessibleFields' => ['user_id' => false]
            ]);
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('Your article has been updated.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update your article.'));
        }
        $tags = $this->Articles->Tags->find('list');

        $this->set(compact('tags'));
        $this->set(compact('article'));
    }

    /**
     * @param string $slug slug in url parameter
     *
     * @return \Cake\Http\Response|null
     */
    public function delete($slug)
    {
        $this->request->allowMethod(['post', 'delete']);

        $article = $this->Articles->findBySlug($slug)->firstOrFail();
        if (!$this->Articles->delete($article)) {
            $this->log('Error while deleting article');

            $this->Flash->error(__('It is failed to delete {0} article.', $article->title));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->success(__('The {0} article has been deleted.', $article->title));

        return $this->redirect(['action' => 'index']);
    }

    /**
     * @param mixed ...$tags tags in url parameters
     *
     * @return mixed
     */
    public function tags(...$tags)
    {
        $articles = $this->Articles->find('tagged', [
            'tags' => $tags,
        ]);

        $this->set([
            'articles' => $articles,
            'tags' => $tags,
        ]);
    }

    /**
     * @param User $user login user
     *
     * @return bool
     */
    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        if (in_array($action, ['add', 'tags'])) {
            return true;
        }

        $slug = $this->request->getParam('pass.0');
        if (!$slug) {
            return false;
        }

        $article = $this->Articles->findBySlug($slug)->first();

        return $article->user_id === $user['id'];
    }
}
