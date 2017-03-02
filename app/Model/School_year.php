<?php

App::uses('AuthComponent', 'Controller/Component');
App::uses('AppModel', 'Model');

class School_year extends AppModel {
    
	public $name = 'School_year';

	public $validate = array(
        'date' => array(
            'notEmpty' => array(
                'rule' => array('notBlank'),
                'message' => 'Fecha obligatoria',
                'allowEmpty' => false
            ),
            'numeric' => array(
                'rule' => array('custom', '/^[1-31/1-12/1980-2005]*$/'),
                'message' => 'Formato de fecha DD/MM/AAAA - DD/MM/AAAA'
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
        )
    );



    public $belongsTo = array(
        'User'=> array(
            'className'=>'User',
            'conditions'=>'',
            'depend' => false // no elimina al usuario si se borra el año académico
        )
    );
    

}

?>