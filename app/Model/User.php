<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
// App::uses('AuthComponent', 'Controller/Component');
/**
 * User Model
 *
 * @property Reply $Reply
 */
class User extends AppModel {

	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$passwordHasher = new BlowfishPasswordHasher();
			$this->data[$this->alias]['password'] = $passwordHasher->hash(
				$this->data[$this->alias]['password']
			);
			// $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);

		}
		return true;
	}
/**
 * Display field
 *
 * @var string
 */

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'username' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Username is required.',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'5 to 20 characters' => array(
				'rule' => array('between', 5, 30),
				'message' => 'Username must be between 5 - 20 characters',
			),	
			'isUnique' => array(
				'rule' => array('isUnique'),
				'message' => 'Username is already taken',
			),
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Invalid Email',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'isUnique' => array(
				'rule' => array('isUnique'),
				'message' => 'Email is already taken',
			),
		),
		'password' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Please enter password',
				'allowEmpty' => false,
				// 'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'Match password' => array(
				'rule' => array('matchPassword'),
				'message' => 'Your passwords do not match',
			),
			
		),
		'password_confirm' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Please confirm your password',
				'allowEmpty' => false,
				// 'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
			
		// 'image' => array(
		// 		// 'rule' => array('chkImageExtension'),
		// 		'message' => 'Please Upload Valid Image.'
		// ),
	);

	public function matchPassword($data) {
		if ($data['password'] == $this->data['User']['password_confirm']){
			return true;
		}
		$this->invalidate('password_confirm','Your passwords do not match');
		return false;
	}

	// public function chkImageExtension($data) {
	// 	$return = true; 
	// 	// var_dump('hi', $data);
	// 	if($data['image'] != ''){
	// 		 $fileData   = pathinfo($data['image']);
	// 		 $ext        = $fileData['extension'];
	// 		 $allowExtension = array('gif', 'jpeg', 'png', 'jpg');
 
	// 		 if(in_array($ext, $allowExtension)) {
	// 			 $return = true; 
	// 		 } else {
	// 			 $return = false;
	// 		 }   
	// 	 } else {
	// 		 $return = false; 
	// 	 }   
 
	// 	 return $return;
	//  } 
	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */

}
