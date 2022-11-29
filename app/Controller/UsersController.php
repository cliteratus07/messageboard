<?php
App::uses('AppController', 'Controller');

App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class UsersController extends AppController {
	public function beforeFilter()
	{
		$this->Auth->allow('register','welcome');	
		
		date_default_timezone_set('Asia/Manila');
		parent::beforeFilter();
	}
/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Flash');

/**
 * index method
 *
 * @return void
 */
	public function welcome(){

	}

	public function register() {
		// var_dump($this->request->data);
		if($this->Session->check('Auth.User')){
			$this->redirect(array('controller' => 'messages', 'action' => 'index'));
		}

		if ($this->request->is('post')) {
			$this->User->create();

			$this->request->data['User']['last_login'] = date("Y-m-d H:i:s");
			$this->request->data['User']['created_at'] = date("Y-m-d H:i:s");
			$this->request->data['User']['image']  = 'avatar-no-pic.png';
			// $this->request->data['User']['password'] = AuthComponent::password($this->request->data['User']['password']);

			if ($this->User->save($this->request->data)) {
				// $this->redirect(array('controller' => 'users', 'action' => 'welcome'));
				if($this->Auth->login()) {
					$this->redirect(array('controller' => 'users', 'action' => 'welcome'));
				}
			} else {
				$this->Session->setFlash(__('The user could not be created. Please, try again.'));
			}
        }
	}

	public function login() {
		if($this->Session->check('Auth.User')){
			$this->redirect(array('controller' => 'messages', 'action' => 'index'));
		}
		if($this->request->is('post')) {
			// $this->request->data['User']['password'] = AuthComponent::password($this->request->data['User']['password']);
			// $passwordHasher = new BlowfishPasswordHasher();
			// $this->request->data['User']['password'] = $passwordHasher->hash(
			// 	$this->request->data['User']['password']
			// );
			// var_dump($this->request->data);
			if($this->Auth->login()) {
				$id = AuthComponent::user('id');
				$this->request->data['User']['id'] = $id;
				$this->request->data['User']['last_login'] = date("Y-m-d H:i:s");
				$this->User->save($this->request->data);

				$this->redirect(array('controller' => 'messages', 'action' => 'index'));
			} else {
				$this->Flash->error(__('Invalid email or password, try again'));
			}
		}
	}

	public function logout() {
		$this->Auth->logout();
		$this->redirect('/pages');
	}

	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}

	public function profile(){
		$user = $this->User->findById(AuthComponent::user('id'));
		// var_dump($user);
		$this->set('user',$user);
		
	}


	public function editview($id = null){
		
		$id = AuthComponent::user('id');
		$user = $this->User->findById($id);

		$birthdate = date('m/d/Y', strtotime($user['User']['birthdate']));
		$this->set(compact('birthdate'));

		if ($this->request->is('post') || $this->request->is('put')) {

			$frmData = $this->request->data['User'];
			if ($this->request->data['User']['image']['name'] != '')
			{
				
				
				$fileData   = pathinfo($this->request->data['User']['image']['name']);
			 $ext        = $fileData['extension'];
			 $allowExtension = array('gif', 'jpeg', 'png', 'jpg');
 
			 if(in_array($ext, $allowExtension)) {
				$tmp = $frmData['image']['tmp_name'];
	
				//Get the data from form
				$hash = rand();
				$date = date("Ymd");
				$image = $date.$hash."-".$frmData['image']['name'];
				
				//Path to store upload image
				$target = WWW_ROOT.'img'.DS;
				$target = $target.basename($image);
	
				if(move_uploaded_file($tmp, $target)) {
					$this->request->data['User']['image'] = $image;
				}
			 } else {
				$this->request->data['User']['image'] = AuthComponent::user('image');
			 }  

			
			}
			else
			{
				$this->request->data['User']['image'] = AuthComponent::user('image');
			}
			$this->Session->write('Auth.User', $this->request->data['User']);
			$birthdate = date("y-m-d", strtotime($frmData['birthdate']));

			$this->request->data['User']['birthdate'] = $birthdate;

			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been updated'));
				$this->redirect(array('action' => 'profile'));
			}else{
				$this->Session->setFlash(__('Unable to update your user.'));
			}
		}

		if (!$this->request->data) {
			$this->request->data = $user;
		}

		
		// $user = $this->User->findById(AuthComponent::user('id'));
		// $user['User']['created_at'] = date('F j\, Y h:i:s', strtotime($user['User']['created_at']));
		// $user['User']['last_login'] = date('F j\, Y h:i:s', strtotime($user['User']['last_login']));

		// $this->set(compact('user'));
		// var_dump($user);

	}
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}


/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			$this->request->data['User']['password'] = AuthComponent::password($this->request->data['User']['password']);
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete($id)) {
			$this->Flash->success(__('The user has been deleted.'));
		} else {
			$this->Flash->error(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
