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
		$this->loadModel('User');
		$this->loadModel('Reply');
		$this->loadModel('Message');

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
		// SELECT id, MAX(message) AS last_message FROM replies WHERE from_user = 12 AND to_user = 13 OR from_user = 13 AND to_user = 12 GROUP BY id ORDER BY created_at DESC LIMIT 1
		$user_id = AuthComponent::user('id');
		// var_dump($user_id);
		$users = $this->User->query('Select id, username, image from Users');
		$data = $this->Message->query('Select * from Messages
		WHERE from_user = ' . $user_id . ' OR to_user = ' . $user_id
		. ' ORDER BY created_at DESC LIMIT 2');
		// $this->Message->recursive = 0;
		// $this->set('messages', $this->Paginator->paginate());
		$this->set('messages1',$data);
		$this->set('users',$users);
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
		$users = $this->User->query('Select id, username, image from Users');
		// $this->loadModel('Reply');
		$replies = $this->Reply->query('SELECT r.id, r.message_id, r.user_id, r.reply, r.created_at, u.image 
		FROM replies AS r LEFT JOIN users AS u ON r.user_id=u.id ORDER BY r.created_at DESC'
		);
		// pr($replies);
		$options = array('conditions' => array('Message.' . $this->Message->primaryKey => $id));
		$this->set('message', $this->Message->find('first', $options));
		$this->set('message1',$data);
		$this->set('messages2',$replies);
		$this->set('users',$users);
		// pr ($data);
		// pr ($replies);
		// pr ($users);

	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		// pr($this->request);
		if ($this->request->is('post')) {
			$this->Message->create();
			$this->request->data['Message']['to_user'] = $this->request->data['Message']['users'];
			$to_user = $this->request->data['Message']['to_user'];
			$from_user = $this->request->data['Message']['from_user'];
			var_dump($to_user, $from_user);
			$check = $this->Message->query('SELECT EXISTS(SELECT * FROM Messages WHERE ( from_user = '. $to_user 
			. ' AND to_user = ' . $from_user . ') OR (from_user = ' . $from_user 
			. ' AND to_user = ' . $to_user . ')) AS result');
			$message_id = $this->Message->query('SELECT id FROM Messages WHERE ( from_user = '. $to_user 
			. ' AND to_user = ' . $from_user . ') OR (from_user = ' . $from_user 
			. ' AND to_user = ' . $to_user . ')');
			// $check = $this->Message->query('Select * from Messages');
			pr($check[0][0]['result']);
			pr($message_id);
			// var_dump($check[0][0]['result']);
			if($check[0][0]['result'] == 0)
			{
			if ($this->Message->save($this->request->data)) {
				$this->Flash->success(__('The message has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The message could not be saved. Please, try again.'));
			}
			}
			else
			{
				// $this->loadModel('Reply');
				// $this->request->data['Reply']['last_message'] = 1;
				$this->request->data['Reply']['message_id'] = $message_id[0]['Messages']['id'];
				$this->request->data['Reply']['user_id'] = $this->request->data['Message']['from_user'];
				$this->request->data['Reply']['reply'] = $this->request->data['Message']['message'];
				// pr($this->request);
				if ($this->Reply->save($this->request->data)) {
					$this->Flash->success(__('The message has been saved.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Flash->error(__('The message could not be saved. Please, try again.'));
				}
			}
			// if ($this->Message->save($this->request->data)) {
			// 	$this->Flash->success(__('The message has been saved.'));
			// 	return $this->redirect(array('action' => 'index'));
			// } else {
			// 	$this->Flash->error(__('The message could not be saved. Please, try again.'));
			// }
		}
		
		// $this->loadModel('User');
		$data = $this->User->find('list', array(
				'fields' => array('id', 'username')
			));
		$this->set('users',$data);
		// $fromUsers = $this->Message->FromUser->find('list');
		// $toUsers = $this->Message->ToUser->find('list',array(
		// 	'fields' => array('ToUser.id', 'ToUser.username')
		// ));
		// var_dump($toUsers);
		// $this->set(compact('fromUsers', 'toUsers'));
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
		$this->layout = false;
		// $this->autoRender = false;
		// $this->request->allowMethod('ajax');
		// pr($this->request);
		if ($this->request['data']['keyword'] != '') {
		$user_id = AuthComponent::user('id');
		$keyword = $this->request['data']['keyword'];
		$query = $this->Message->query("SELECT * FROM Messages 
		WHERE (message LIKE '%" . $keyword . "%') 
		AND (from_user = " . $user_id . " OR to_user = " . $user_id . ") 
		ORDER BY created_at DESC");

		$users = $this->User->query('Select id, username, image from Users');

		// pr ($query);
		// $this->set('messages', $this->paginate($query));
		// $this->set('_serialize',['messages']);
		$this->set('messages1',$query);
		$this->set('users',$users);
		}
		else
		{
					// SELECT id, MAX(message) AS last_message FROM replies WHERE from_user = 12 AND to_user = 13 OR from_user = 13 AND to_user = 12 GROUP BY id ORDER BY created_at DESC LIMIT 1
		$user_id = AuthComponent::user('id');
		// var_dump($user_id);
		$users = $this->User->query('Select id, username, image from Users');
		$data = $this->Message->query('Select * from Messages
		WHERE from_user = ' . $user_id . ' OR to_user = ' . $user_id
		. ' ORDER BY created_at DESC');
		// $this->Message->recursive = 0;
		// $this->set('messages', $this->Paginator->paginate());
		$this->set('messages1',$data);
		$this->set('users',$users);
		}
	}

	public function loadmore($limit = null){
				// SELECT id, MAX(message) AS last_message FROM replies WHERE from_user = 12 AND to_user = 13 OR from_user = 13 AND to_user = 12 GROUP BY id ORDER BY created_at DESC LIMIT 1
				// $this->layout = false;
				// $this->autoRender = false;
				// $this->request->allowMethod('ajax');
				// pr($limit);
		$this->layout = false;
		if ($limit > 0) {
						// SELECT id, MAX(message) AS last_message FROM replies WHERE from_user = 12 AND to_user = 13 OR from_user = 13 AND to_user = 12 GROUP BY id ORDER BY created_at DESC LIMIT 1
		$user_id = AuthComponent::user('id');
		// var_dump($user_id);
		$users = $this->User->query('Select id, username, image from Users');
		$data = $this->Message->query('Select * from Messages
		WHERE from_user = ' . $user_id . ' OR to_user = ' . $user_id
		. ' ORDER BY created_at DESC LIMIT ' . $limit);
		$this->Message->recursive = 0;
		$this->set('messages', $this->Paginator->paginate());
		$this->set('messages1',$data);
		$this->set('users',$users);
				}
				else
				{
				
				// $user_id = AuthComponent::user('id');
				// var_dump($user_id,$limit);
				// $limit = $this->request['data']['limit'];
				// // var_dump($user_id);
				// $users = $this->User->query('Select id, username, image from Users');
				// $data = $this->Message->query("Select * from Messages
				// WHERE from_user = " . $user_id . " OR to_user = " . $user_id
				// . " ORDER BY created_at DESC LIMIT 2");
				// // $this->Message->recursive = 0;
				// // $this->set('messages', $this->Paginator->paginate());
				// $this->set('messages1',$data);
				// $this->set('users',$users);
				// pr ($data);
				}
	}
}
