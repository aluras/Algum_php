<?php
App::uses('AppModel', 'Model');

class TipoGrupo extends AppModel{
    public $useTable = 'tipo_grupo';

    public $hasMany = array(
        'Grupo'
    );
} 