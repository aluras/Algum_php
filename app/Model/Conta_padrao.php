<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 24/04/2016
 * Time: 01:31
 */
App::uses('AppModel', 'Model');

class Conta_padrao extends AppModel{
    public $useTable = 'contas_padrao';
    public $belongsTo = array(
        'TipoConta'
    );
} 