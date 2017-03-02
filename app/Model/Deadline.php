<?php

App::uses('AuthComponent', 'Controller/Component');
App::uses('AppModel', 'Model');

class Deadline extends AppModel {
    
	public $name = 'Deadline';

	public $validate = array(
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
        'type' => array(
            'valid' => array(
                'rule' => array('inList', array('10 días', '15 días', '20 días', '1 mes', '2 meses', '3 meses', '6 meses', '10 meses')),
                'message' => 'Introduzca un plazo válido',
                'allowEmpty' => false
            )
        ),
        'document_id' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty')
            )
        )
    );



    public $belongsTo = array(
        'Document'=> array(
            'className'=>'Document',
            'foreignKey'=> 'document_id',
            'conditions'=>'',
            'depend' => false // no elimina al documento si se borra el plazo
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