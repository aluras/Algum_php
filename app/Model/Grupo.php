<?php
App::uses('AppModel', 'Model');

class Grupo extends AppModel{
    public $useTable = 'grupos';

    public $belongsTo = array(
        'TipoGrupo' => array(
            'foreignKey' => 'id_tipo_grupo'
        ),
        'Usuario' => array(
            'foreignKey' => 'usuario_id'
        )
    );

} 