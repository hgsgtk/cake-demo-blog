<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Inquiries Controller
 *
 * @property \App\Model\Table\InquiriesTable $Inquiries
 *
 * @method \App\Model\Entity\Inquiry[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InquiriesController extends AppController
{
    /**
     * @inheritDoc
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->Auth->allow();
    }


    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $inquiries = $this->paginate($this->Inquiries);

        $this->set(compact('inquiries'));
    }

    /**
     * View method
     *
     * @param string|null $id Inquiry id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $inquiry = $this->Inquiries->get($id, [
            'contain' => []
        ]);

        $this->set('inquiry', $inquiry);
    }

    /**
     * inquiry page
     *
     * @return \Cake\Http\Response|null
     */
    public function add()
    {
        $inquiry = $this->Inquiries->newEntity();

        if ($this->request->is('post')) {
            $inquiry = $this->Inquiries->patchEntity($inquiry, $this->request->getData());
            $inquiry->client_ip = $this->request->clientIp();
            if (!$this->Inquiries->save($inquiry)) {
                $this->Flash->error(__('The inquiry could not be saved. Please, try again.'));
            }

            return $this->redirect(['action' => 'index']);
        }

        $this->set(compact('inquiry'));
    }
}
