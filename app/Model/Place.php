<?php

App::uses('AuthComponent', 'Controller/Component');
App::uses('AppModel', 'Model');

class Place extends AppModel {
    
	public $name = 'Place';

	public $validate = array(
        'user_id' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty')
            )
        ),
        'destination_id' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty')
            )
        )
    );

    public $hasOne = array(
        'Extension_request'=> array(
            'className'=>'Extension_request',
            'foreignKey'=> 'place_id',
            'conditions'=>'',
            'depend' => true //elimina todos relacionados con el usuario si lo llegamos a eliminar
        ),
        'Resignation'=> array(
            'className'=>'Resignation',
            'foreignKey'=> 'place_id',
            'conditions'=>'',
            'depend' => true //elimina todos los documentos relacionados con el usuario si lo llegamos a eliminar
        )
    );


    public $belongsTo = array(
        'Alumno'=> array(
            'className'=>'User',
            'foreignKey'=> 'user_id',
            'conditions'=>'',
            'depend' => false // no elimina al documento si se borra el plazo
        ),
        'Destination'=> array(
            'className'=>'Destination',
            'foreignKey'=> 'destination_id',
            'conditions'=>'',
            'depend' => false // no elimina al documento si se borra el plazo
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