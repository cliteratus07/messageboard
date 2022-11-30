<?php
App::uses('AppController', 'Controller');
/**
 * Replies Controller
 *
 * @property Reply $Reply
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class RepliesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Flash');

/**
 * index method
 *
 * @return void
 */
	public function index($id) {
		var_dump($id);
		$this->Reply->recursive = 0;
		$this->set('replies', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Reply->exists($id)) {
			throw new NotFoundException(__('Invalid reply'));
		}
		$options = array('conditions' => array('Reply.' . $this->Reply->primaryKey => $id));
		$this->set('reply', $this->Reply->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->autoRender = false;
		$this->request->allowMethod('ajax','POST', 'GET');
		$user_id = AuthComponent::user('id');
		if ($this->request->is('post')) {
			
		pr ($this->request->data);
		$this->request->data['Reply']['user_id'] = $this->request->data['userid'];
		$this->request->data['Reply']['message_id'] = $this->request->data['messageid'];
		$this->request->data['Reply']['reply'] = $this->request->data['messagereply'];
			$this->Reply->create();
			if ($this->Reply->save($this->request->data)) {
				$this->Flash->success(__('The reply has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The reply could not be saved. Please, try again.'));
			}
		}
		// $messages = $this->Reply->Message->find('list');
		// $users = $this->Reply->User->find('list');
		// $this->set(compact('messages', 'users'));
		
		$this->redirect($this->referer());
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Reply->exists($id)) {
			throw new NotFoundException(__('Invalid reply'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Reply->save($this->request->data)) {
				$this->Flash->success(__('The reply has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The reply could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Reply.' . $this->Reply->primaryKey => $id));
			$this->request->data = $this->Reply->find('first', $options);
		}
		$messages = $this->Reply->Message->find('list');
		$users = $this->Reply->User->find('list');
		$this->set(compact('messages', 'users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->Reply->exists($id)) {
			throw new NotFoundException(__('Invalid reply'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Reply->delete($id)) {
			$this->Flash->success(__('The reply has been deleted.'));
		} else {
			$this->Flash->error(__('The reply could not be deleted. Please, try again.'));
		}
		$this->redirect($this->referer());
	}
}
