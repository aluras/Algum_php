<?php
App::uses('AppModel', 'Model');

class Grupo_padrao extends AppModel{
    public $useTable = 'grupos_padrao';
    public $belongsTo = array(
        'TipoGrupo' => array(
            'foreignKey' => 'id_tipo_grupo'
        )
    );
}