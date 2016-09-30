<?php
App::uses('AppModel', 'Model');
App::uses('Conta_padrao', 'Model');
App::uses('ContaUsuario', 'Model');


class Usuario extends AppModel {

    public $hasMany = array(
        'ContaUsuario','GrupoUsuario'
    );
/*
    public function beforeSave($options = array()) {
        if (!isset($this->data[$this->alias]['id'])) {
            $contasPadraoModel = new Conta_padrao();
            $contasPadrao = $contasPadraoModel->find('all');



            $this->data['ContaUsuario'] = array(
                'Conta' => array(
                    'nome' => 'Conta corrente',
                    'tipo_conta_id' => 1
                )
            );


            //throw new Exception(json_encode($this->data));

        }
        return true;
    }

    public function afterSave(boolean $created, array $options = array()){
        if($created){
            $this->data['ContaUsuario'] = array(
                'Conta' => array(
                    'nome' => 'Conta corrente',
                    'tipo_conta_id' => 1
                )
            );

        }
    }
*/
}