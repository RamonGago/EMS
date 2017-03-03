<?php

App::uses('AuthComponent', 'Controller/Component');
App::uses('AppModel', 'Model');

class User extends AppModel {
    
	public $name = 'User';

	public $validate = array(
        'username' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Usuario obligatorio',
				'allowEmpty' => false
            ),
			'between' => array( 
				'rule' => array('between', 5, 15), 
				'required' => true, 
				'message' => 'El usuario debe contener entre 5 y 15 caracteres'
			),
			 'unique' => array(
				'rule'    => array('isUniqueUsername'),
				'message' => 'Usuario en uso'
			),
			'alphaNumericDashUnderscore' => array(
				'rule'    => array('alphaNumericDashUnderscore'),
				'message' => 'El nombre de usuario solo puede contener letras, números y guiones bajos'
			)
        ),
        'name' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Se requiere especificar el nombre'
            ),
            'letters' => array(
                'rule' =>  array('custom', '/^[A-Za-zÁáÉéÍíÓóÚúÑñ]*$/'),
                'message' => 'El nombre solo debe contener letras'
            )
        ),
        'surname' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Se requiere especificar el nombre'
            ),
            'letters' => array(
                'rule' =>  array('custom', '/^[A-Za-zÁáÉéÍíÓóÚúÑñ]*$/'),
                'message' => 'El nombre solo debe contener letras'
            )
        ),
        'dni' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'DNI obligatorio',
                'allowEmpty' => false
            ),
            'letters' => array(
                'rule'    => array('custom', '/^[0-9ABCDEFGHJKLMNPQRSTVWXYZ]*$/'),
                'message' => 'El DNI debe contener 8 dígitos y una letra (mayúscula)'
            )
        ),
        'address' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Dirección obligatoria',
                'allowEmpty' => false
            )
        ),
        'phone' => array(
            'notEmpty' => array(
                'rule' => array('notBlank'),
                'message' => 'Teléfono obligatorio',
                'allowEmpty' => false
            ),
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'El curso solo debe contener números'
            )
        ),
        'birthdate' => array(
            'notEmpty' => array(
                'rule' => array('notBlank'),
                'message' => 'Fecha de nacimiento obligatoria',
                'allowEmpty' => false
            ),
            'numeric' => array(
                'rule' => array('custom', '/^[1-31/1-12/1980-2005]*$/'),
                'message' => 'Formato de fecha DD/MM/AAAA'
            )
        ),
        'faculty' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Se requiere especificar el nombre de la facultad'
            ),
            'letters' => array(
                'rule' =>  array('custom', '/^[A-Za-zÁáÉéÍíÓóÚúÑñ]*$/'),
                'message' => 'El nombre de la facultad solo debe contener letras'
            )
        ),
        'course' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Se requiere especificar el curso'
            ),
            'numeric' => array(
                'rule' => array('custom', '/^[1-9]*$/'),
                'message' => 'El curso solo debe contener un dígito entre 1 y 9'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'Contraseña obligatoria'
            ),
			'min_length' => array(
				'rule' => array('minLength', '6'),  
				'message' => 'La contraseña debe tener al menos 6 caracteres'
			)
        ),
		
		'password_confirm' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'Repita la contraseña'
            ),
			 'equaltofield' => array(
				'rule' => array('equaltofield','password'),
				'message' => 'Ambas contraseñas deben coincidir'
			)
        ),
		
		'email' => array(
			'required' => array(
				'rule' => array('email', true),    
				'message' => 'Introduzca un email válido'
			),
			 'unique' => array(
				'rule'    => array('isUniqueEmail'),
				'message' => 'Email en uso',
			),
			'between' => array( 
				'rule' => array('between', 6, 60), 
				'message' => 'El email debe contener entre 6 y 60 caracteres'
			)
		),
		'password_update' => array(
			'min_length' => array(
				'rule' => array('minLength', '6'),   
				'message' => 'La contraseña debe contener al menos 6 caracteres'
			)
        ),
		'password_confirm_update' => array(
			 'equaltofield' => array(
				'rule' => array('equaltofield','password_update'),
				'message' => 'Ambas contraseñas deben coincidir'
			)
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('Admin_ORI', 'Admin_SEC', 'Coordinador', 'Alumno')),
                'message' => 'Introduzca un rol válido',
                'allowEmpty' => false
            )
        )
    );


    public $hasMany = array(
    'Documents'=> array(
        'className'=>'Document',
        'foreignKey'=> 'user_id',
        'conditions'=>'',
        'depend' => true //elimina todos los documentos relacionados con el usuario si lo llegamos a eliminar
    ),
    'Learning_agreements'=> array(
        'className'=>'Learning_agreements',
        'foreignKey'=> 'user_id',
        'conditions'=>'',
        'depend' => true //elimina todos los documentos relacionados con el usuario si lo llegamos a eliminar
    )
    );


    public $hasOne = array(
        'Extension_request'=> array(
            'className'=>'Extension_request',
            'foreignKey'=> 'user_id',
            'conditions'=>'',
            'depend' => true //elimina todos los documentos relacionados con el usuario si lo llegamos a eliminar
        ),
        'Resignation'=> array(
            'className'=>'Resignation',
            'foreignKey'=> 'user_id',
            'conditions'=>'',
            'depend' => true //elimina todos los documentos relacionados con el usuario si lo llegamos a eliminar
        ),
        'Place'=> array(
            'className'=>'Place',
            'foreignKey'=> 'user_id',
            'conditions'=>'',
            'depend' => true //elimina todos los documentos relacionados con el usuario si lo llegamos a eliminar
        )
    );

    public $hasAndBelongsToMany = array(
        'Destination' => array(
            'className' => 'Destination',
            'joinTable' => 'places',
            'foreignKey' => 'user_id',
            'associationForeignKey' => 'destination_id',
            'unique' => 'keepExisting'
        )
    );
		/**
	 * Before isUniqueUsername
	 * @param array $options
	 * @return boolean
	 */
	function isUniqueUsername($check) {

		$username = $this->find(
			'first',
			array(
				'fields' => array(
					'User.id',
					'User.username'
				),
				'conditions' => array(
					'User.username' => $check['username']
				)
			)
		);

		if(!empty($username)){
			if($this->data[$this->alias]['id'] == $username['User']['id']){
				return true; 
			}else{
				return false; 
			}
		}else{
			return true; 
		}
    }

	/**
	 * Before isUniqueEmail
	 * @param array $options
	 * @return boolean
	 */
	function isUniqueEmail($check) {

		$email = $this->find(
			'first',
			array(
				'fields' => array(
					'User.id'
				),
				'conditions' => array(
					'User.email' => $check['email']
				)
			)
		);

		if(!empty($email)){
			if($this->data[$this->alias]['id'] == $email['User']['id']){
				return true; 
			}else{
				return false; 
			}
		}else{
			return true; 
		}
    }
	
	public function alphaNumericDashUnderscore($check) {
        // $data array is passed using the form field name as the key
        // have to extract the value to make the function generic
        $value = array_values($check);
        $value = $value[0];

        return preg_match('/^[a-zA-Z0-9_ \-]*$/', $value);
    }
	
	public function equaltofield($check,$otherfield) 
    { 
        //get name of field 
        $fname = ''; 
        foreach ($check as $key => $value){ 
            $fname = $key; 
            break; 
        } 
        return $this->data[$this->name][$otherfield] === $this->data[$this->name][$fname]; 
    } 

	/**
	 * Before Save
	 * @param array $options
	 * @return boolean
	 */
	 public function beforeSave($options = array()) {
		// hash our password
		if (isset($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}
		
		// if we get a new password, hash it
		if (isset($this->data[$this->alias]['password_update'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password_update']);
		}
	
		// fallback to our parent
		return parent::beforeSave($options);
	}

}

?>