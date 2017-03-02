<?php

App::uses('AuthComponent', 'Controller/Component');
App::uses('AppModel', 'Model');

class Learning_agreement extends AppModel {
    
	public $name = 'Learning_agreement';

	public $validate = array(
        'destination_subjects' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Se requiere especificar las asignaturas de la universidad de destino'
            ),
            'alphaNumericDashUnderscore' => array(
                'rule'    => array('alphaNumericDashUnderscore'),
                'message' => 'El nombre de las asignaturas sólo puede contener letras, números y guiones bajos'
            )
        ),
        'origin_subjects' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Se requiere especificar las asignaturas de la universidad de origen'
            ),
            'alphaNumericDashUnderscore' => array(
                'rule'    => array('alphaNumericDashUnderscore'),
                'message' => 'El nombre de las asignaturas sólo puede contener letras, números y guiones bajos'
            )
        ),
        'duration' => array(
            'notEmpty' => array(
                'rule' => array('notBlank'),
                'message' => 'Duración obligatoria',
                'allowEmpty' => false
            ),
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'La duración solo debe contener números'
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
            'depend' => false // no elimina al usuario si se borra el contrato de estudios
        ),
        'Place'=> array(
            'className'=>'Place',
            'foreignKey'=> 'place_id',
            'conditions'=>'',
            'depend' => false // no elimina al usuario si se borra el contrato de estudios
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