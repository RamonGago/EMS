<?php

App::uses('AuthComponent', 'Controller/Component');
App::uses('AppModel', 'Model');

class Destination extends AppModel {
    
	public $name = 'Destination';

	public $validate = array(
        'country' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Se requiere especificar el pais de destino'
            ),
            'letters' => array(
                'rule' =>  array('custom', '/^[A-Za-zÁáÉéÍíÓóÚúÑñ]*$/'),
                'message' => 'El nombre del país solo debe contener letras'
            )
        ),
        'university' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Se requiere especificar de la Universidad de destino'
            ),
            'letters' => array(
                'rule' =>  array('custom', '/^[A-Za-zÁáÉéÍíÓóÚúÑñ]*$/'),
                'message' => 'El nombre de la Universidad solo debe contener letras'
            )
        ),
        'description' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Se requiere especificar una descripción del destino'
            ),
            'alphaNumericDashUnderscore' => array(
                'rule'    => array('alphaNumericDashUnderscore'),
                'message' => 'La descripción solo puede contener letras, números y guiones bajos'
            )
        ),
        'places' => array(
            'notEmpty' => array(
                'rule' => array('notBlank'),
                'message' => 'Número de plazas obligatorio',
                'allowEmpty' => false
            ),
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Solo debe contener números'
            )
        ),
        'contact_person' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Se requiere especificar los datos de la persona de contacto'
            ),
            'alphaNumericDashUnderscore' => array(
                'rule'    => array('alphaNumericDashUnderscore'),
                'message' => 'La descripción solo puede contener letras, números y guiones bajos'
            )
        ),
        'destination_requirements' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Se requiere especificar los requisitos de la universidad de destino'
            ),
            'alphaNumericDashUnderscore' => array(
                'rule'    => array('alphaNumericDashUnderscore'),
                'message' => 'La descripción de los requisitos sólo puede contener letras, números y guiones bajos'
            )
        ),
        'origin_requirements' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Se requiere especificar los requisitos de la universidad de origen'
            ),
            'alphaNumericDashUnderscore' => array(
                'rule'    => array('alphaNumericDashUnderscore'),
                'message' => 'La descripción de los requisitos sólo puede contener letras, números y guiones bajos'
            )
        )
    );


    public $hasMany = array(
    'Places'=> array(
        'className'=>'Place',
        'foreignKey'=> 'destination_id',
        'conditions'=>'',
        'depend' => true //elimina todas las plazas relacionados con el destino si lo llegamos a eliminar
        )
    );


    public $hasAndBelongsToMany = array(
        'Alumno' => array(
			'className' => 'User',
            'joinTable' => 'places',
            'foreignKey' => 'destination_id',
            'associationForeignKey' => 'user_id',
			'unique' => 'keepExisting'
        )
    );

	
	public function alphaNumericDashUnderscore($check) {
        // $data array is passed using the form field name as the key
        // have to extract the value to make the function generic
        $value = array_values($check);
        $value = $value[0];

        return preg_match('/^[a-zA-Z0-9_ \-]*$/', $value);
    }

}

?>