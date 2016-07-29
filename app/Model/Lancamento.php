<?php
App::uses('AppModel', 'Model');

class Lancamento extends AppModel {
    public $useTable = 'lancamentos';

    public $belongsTo = array(
        'Grupo' => array(
            'foreignKey' => 'grupo_id'
        ),
        'Conta' => array(
            'foreignKey' => 'conta_id'
        )
    );
} 