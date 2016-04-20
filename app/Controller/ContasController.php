<?php
/**
 * Created by PhpStorm.
 * User: sn1007071
 * Date: 13/04/2016
 * Time: 16:08
 */

class ContasController extends AppController {

    public function index() {
        $this->autoRender = false;
/*
        $this->set(array(
            'usuarios' => $usuarios,
            '_serialize' => array('usuarios')
        ));
*/

        $this->Conta->Behaviors->load('Containable');
        $dados = $this->Conta->find('all', array(
            'contain' => array(
                'ContaUsuario' => array(
                    'conditions' => array(
                        'usuario_id' => $this->usuarioId
                    )
                ),
                'TipoConta'
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