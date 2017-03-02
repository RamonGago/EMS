<?php

App::uses('AuthComponent', 'Controller/Component');
App::uses('AppModel', 'Model');

class Extension_request extends AppModel {
    
	public $name = 'Extension_request';

	public $validate = array(

        'description' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Se requiere especificar una descripción del documento'
            ),
            'alphaNumericDashUnderscore' => array(
                'rule'    => array('alphaNumericDashUnderscore'),
                'message' => 'La descripción solo puede contener letras, números y guiones bajos'
            )
        ),
        'user_id' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty')
            )
        ),
        'place_id' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty')
            )
        )
    );



    public $belongsTo = array(
        'Alumno'=> array(
            'className'=>'User',
            'foreignKey'=> 'user_id',
            'conditions'=>'',
            'depend' => false // no elimina al usuario si se borra la amplicación de estancia
        ),
        'Place'=> array(
            'className'=>'Place',
            'foreignKey'=> 'place_id',
            'conditions'=>'',
            'depend' => false // no elimina al usuario si se borra la amplicación de estancia
        )

    );

		/**
	 * Before isUniqueUsername
	 * @param array $options
	 * @return boolean
	 */

	public function alphaNumericDashUnderscore($check) {
        // $data array is passed using the form field name as the key
        // have to extract the value to make the function generic
        $value = array_values($check);
        $value = $value[0];

        return preg_match('/^[a-zA-Z0-9_ \-]*$/', $value);
    }
    

}

?>