<?php
App::uses('AppModel', 'Model');

class GrupoUsuario extends AppModel {
    public $belongsTo = array(
        'Grupo'
    );
} 