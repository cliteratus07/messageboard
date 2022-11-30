<?php
App::uses('AppController', 'Controller');
/**
 * Messages Controller
 *
 * @property Message $Message
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class MessagesController extends AppController {
	public function beforeFilter()
	{
		$this->Auth->allow('index');	
		parent::beforeFilter();	
	}
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
	public function index() {
		$user_id = AuthComponent::user('id');
		// var_dump($user_id);
		$data = $this->Message->find('all', $conditions = array(
			'OR' => array(
				array(
					'Message.from_user =' => $user_id,
					'Message.to_user =' => $user_id
				),
				'order' => array('Message.created_at ASC')
		)));
		$this->Message->recursive = 0;
		$this->set('messages', $this->Paginator->paginate());
		$this->set('messages1',$data);
		// pr ($data);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Message->exists($id)) {
			throw new NotFoundException(__('Invalid message'));
		}
		// var_dump($id);
		$data = $this->Message->findById($id);
		$this->loadModel('Reply');
		$replies = $this->Reply->find('all',array(
			'conditions' => array('Reply.message_id =' => $id)
		));
		// pr($replies);
		$options = array('conditions' => array('Message.' . $this->Message->primaryKey => $id));
		$this->set('message', $this->Message->find('first', $options));
		$this->set('message1',$data);
		$this->set('messages2',$replies);
		// pr ($data);

	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Message->create();
			if ($this->Message->save($this->request->data)) {
				$this->Flash->success(__('The message has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The message could not be saved. Please, try again.'));
			}
		}
		$fromUsers = $this->Message->FromUser->find('list');
		$toUsers = $this->Message->ToUser->find('list',array(
			'fields' => array('ToUser.id', 'ToUser.username')
		));
		// var_dump($toUsers);
		$this->set(compact('fromUsers', 'toUsers'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Message->exists($id)) {
			throw new NotFoundException(__('Invalid message'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Message->save($this->request->data)) {
				$this->Flash->success(__('The message has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The message could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Message.' . $this->Message->primaryKey => $id));
			$this->request->data = $this->Message->find('first', $options);
		}
		$fromUsers = $this->Message->FromUser->find('list');
		$toUsers = $this->Message->ToUser->find('list');
		$this->set(compact('fromUsers', 'toUsers'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null, $cascade = true, $callbacks = false) {
		if (!$this->Message->exists($id)) {
			throw new NotFoundException(__('Invalid message'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Message->delete($id)) {
			
		$this->loadModel('Reply');
		$this->Reply->deleteAll(
			[
				'Reply.message_id' => $id, 
			],
			$cascade,
			$callbacks
		);
			$this->Flash->success(__('The message and its replies have been deleted.'));
		} else {
			$this->Flash->error(__('The message could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function search(){
		$this->request->allowMethod('ajax');
		$user_id = AuthComponent::user('id');
		pr ($this->request);
		$keyword = $this->request->query('keyword');
		$query = $this->Message->find('all',[
			'conditions' => ['message LIKE'=>'%'.$keyword.'%'],
			'order' => ['Message.id'=>'DESC'],
			'limit' => 2
		]);
		pr ($query);
		$this->set('messages', $this->paginate($query));
		$this->set('_serialize',['messages']);
	}
}
