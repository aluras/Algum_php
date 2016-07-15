<?php
App::uses('AppModel', 'Model');

class Grupo extends AppModel{
    public $useTable = 'grupo_usuarios';

    public $belongsTo = array(
        'TipoGrupo' => array(
            'foreignKey' => 'id_tipo_grupo'
        )
    );
} 