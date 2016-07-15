<?php
/**
 * Created by PhpStorm.
 * User: sn1007071
 * Date: 13/04/2016
 * Time: 16:08
 */
App::uses('ContaUsuario', 'Model');

class ContasController extends AppController {

    public function index() {
        $this->autoRender = false;

        //$this->Conta->Behaviors->load('Containable');

        $dados = $this->Conta->find('all',
            array(
                'joins' => array(
                    array(
                        'table' => 'conta_usuarios',
                        'alias' => 'ContaUsuario',
                        'conditions' => array('ContaUsuario.conta_id = Conta.id')
                    )
                ),
                'conditions' => array(
                    'ContaUsuario.usuario_id' => $this->usuarioId
                )
            ));

        $this->response->body(json_encode($dados));
    }

    public function view($id){
        $this->Conta->Behaviors->load('Containable');
        $dados = $this->Conta->find('first', array(
            'conditions' => array('Conta.id' => $id)
        ));

        $this->response->body(json_encode($dados));
    }

} 