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

        //$this->Conta->Behaviors->load('Containable');

        $db = $this->Conta->getDataSource();
        $dados =  $db->fetchAll(
            'SELECT * from contas Conta
            INNER JOIN conta_usuarios ContaUsuario ON ContaUsuario.conta_id = Conta.id
            WHERE ContaUsuario.usuario_id = :usuarioId',

            array('usuarioId' => $this->usuarioId)

        );
        /*
        $dados = $this->Conta->find('all',
            array(
                'joins' => array(
                    array(
                        'table' => 'conta_usuarios',
                        'alias' => 'ContaUsuario',
                        'conditions' => array('ContaUsuario.conta_id = Conta.id',
                                            'ContaUsuario.usuario_id' => $this->usuarioId)
                    )
                ),
                'conditions' => array(
                    'ContaUsuario.usuario_id' => $this->usuarioId,
                    'Conta.id' => 91
                )
            ));
        */
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