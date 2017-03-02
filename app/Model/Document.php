<?php

App::uses('AuthComponent', 'Controller/Component');
App::uses('AppModel', 'Model');

class Document extends AppModel {
    
	public $name = 'Document';

	public $validate = array(
        'type' => array(
            'valid' => array(
                'rule' => array('inList', array('Aceptación de plaza', 'Contrato financiero', 'Ficha de perceptores', 'Aceptación uso de datos', 'Contrato seguro On Campus', 'Contrato de estudios', 'Modificación contrato de estudios', 'Certificado de llegada', 'Ampliación de estancia', 'Renuncia de plaza', 'Certificado de fin de estancia')),
                'message' => 'Introduzca un tipo válido',
                'allowEmpty' => false
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
        'file' => array(
            'uploadError' => array(
                'rule' => 'uploadError',
                'message' => 'Error, intente subir el archivo de nuevo',
                'on' => 'create'
            ),
            'isUnderPhpSizeLimit' => array(
                'rule' => 'isUnderPhpSizeLimit',
                'message' => 'El archivo excede el límite de tamaño de subida'
            ),
            'isValidExtension' => array(
                'rule' => array('isValidExtension', array('pdf'), false),
                'message' => 'El archivo debe ser subido en pdf'
            ),
            'checkUniqueName' => array(
                'rule' => array('checkUniqueName'),
                'message' => 'Debe cambiar el nombre del pdf',
                'on' => 'update'
            )
        ),
        'user_id' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty')
            )
        )
    );



    public $hasOne = array(
        'Deadline'=> array(
            'className'=>'Deadline',
            'foreignKey'=> 'document_id',
            'conditions'=>'',
            'depend' => ''
        )
    );

    public $belongsTo = array(
        'Alumno'=> array(
            'className'=>'Users',
            'foreignKey'=> 'user_id',
            'conditions'=>'',
            'depend' => false // no elimina al usuario si se borra el documento el documento
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