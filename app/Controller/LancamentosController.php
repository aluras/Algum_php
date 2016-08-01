<?php
/**
 * Created by PhpStorm.
 * User: sn1007071
 * Date: 28/07/2016
 * Time: 12:31
 */
App::uses('Grupo', 'Model');
App::uses('Conta', 'Model');

class LancamentosController extends AppController {

    public function index() {
        $this->autoRender = false;

        $dados = $this->Lancamento->find('all',
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
                ),
                'order' => array('Lancamento.id'),
                'contain' => 'Lancamento'
            ));

        $this->response->body(json_encode($dados));
    }

    public function add() {
        $this->autoRender = false;

        //verifica data
        if (!array_key_exists("date", $this->request->data)){
            throw new Exception("Data inválida");
        }
        $d = DateTime::createFromFormat('d/m/Y', $this->request->data['date']);

        if( !$d || !($d->format('d/m/Y') === $this->request->data['date'])){
            throw new Exception("Data inválida");
        }
        $this->request->data['data'] = $d->format('Y-m-d');

        //verifica valor
        if (!array_key_exists("valor", $this->request->data)){
            throw new Exception("Valor inválido.");
        }
        if (!is_numeric($this->request->data['valor'])){
            throw new Exception("Valor inválido.");
        }

        //verifica grupo
        if (!array_key_exists("grupo_id", $this->request->data)){
            throw new Exception("Grupo inválido.");
        }
        $grupoModel = new Grupo();
        $grupo =  $grupoModel->find('first',
            array(
                'conditions' => array('Grupo.id' => $this->request->data['grupo_id'])
            ));
        if (!$grupo){
            throw new Exception("Grupo inválido.");
        }

        //verifica conta
        if (!array_key_exists("conta_id", $this->request->data)){
            throw new Exception("Conta inválida.");
        }
        $contaModel = new Conta();
        $conta =  $contaModel->find('first',
            array(
                'joins' => array(
                    array(
                        'table' => 'conta_usuarios',
                        'alias' => 'ContaUsuario',
                        'conditions' => array('ContaUsuario.conta_id = Conta.id')
                    )
                ),
                'conditions' => array(
                    'Conta.id' => $this->request->data['conta_id']
                    ,'ContaUsuario.usuario_id' => $this->usuarioId)
            ));
        if (!$conta){
            throw new Exception("Conta inválida.");
        }


        $this->Lancamento->create();
        if ($dados = $this->Lancamento->save($this->request->data)) {
            $this->response->body(json_encode($dados));
        } else {
            throw new Exception("Ocorreu uma erro.");
        }



    }
} 