<?php
/**
 * Created by PhpStorm.
 * User: sn1007071
 * Date: 13/04/2016
 * Time: 16:08
 */
App::uses('TipoConta', 'Model');


class ContasController extends AppController {

    public function index() {
        $this->autoRender = false;

        //throw new Exception("Ocorreu uma erro.");
        //$this->Conta->Behaviors->load('Containable');
/*
        $db = $this->Conta->getDataSource();
        $dados =  $db->fetchAll(
            'SELECT * from contas Conta
            INNER JOIN conta_usuarios ContaUsuario ON ContaUsuario.conta_id = Conta.id
            INNER JOIN usuarios Usuarios ON Usuarios.id = ContaUsuario.usuario_id
            WHERE (SELECT COUNT(*) FROM conta_usuarios cu WHERE cu.conta_id = Conta.id AND cu.usuario_id = :usuarioId) > 0
            AND Conta.modified > DATE_ADD(Usuarios.sincronizado,INTERVAL -1 DAY)',

            array('usuarioId' => $this->usuarioId)

        );
*/

        $dados = $this->Conta->find('all',
            array(
                'joins' => array(
                    array(
                        'table' => 'conta_usuarios',
                        'alias' => 'ContaUsuario',
                        'conditions' => array('ContaUsuario.conta_id = Conta.id')
                    )
                ),
                'recursive' => 2,
                'conditions' => array(
                    'ContaUsuario.usuario_id' => $this->usuarioId
                )
            ));

        $this->response->body(json_encode($dados));
    }

    public function indexTipoContas(){
        $this->autoRender = false;

        $tipoConta = new TipoConta();
        $dados = $tipoConta->find('all');
        $this->response->body(json_encode($dados));

    }

    public function view($id){
        $this->Conta->Behaviors->load('Containable');
        $dados = $this->Conta->find('first', array(
            'conditions' => array('Conta.id' => $id)
        ));

        $this->response->body(json_encode($dados));
    }

    public function add() {
        $this->autoRender = false;
        $this->request->data['ContaUsuario'] = array(
            array(
                'usuario_id' => $this->request->data['usuario_id']
            )
        );

        $this->validaDados($this->request->data);

        $this->Conta->create();
        if ($this->Conta->saveAssociated($this->request->data)) {
            $this->view($this->Conta->id);
        } else {
            throw new Exception("Ocorreu uma erro.");
        }

    }

    public function edit($id) {
        $this->autoRender = false;

        $this->validaDados($this->request->data);

        $this->Conta->id = $id;
        if ($dados = $this->Conta->save($this->request->data)) {
            $this->response->body(json_encode($dados));
        } else {
            throw new Exception("Ocorreu uma erro.");
        }
    }

    private function validaDados($data){
        //verifica tipo conta
        if (!array_key_exists("tipo_conta_id", $data)){
            throw new Exception("Tipo de conta inválido.");
        }
        $tipoContaModel = new TipoConta();
        $tipoConta =  $tipoContaModel->find('first',
            array(
                'conditions' => array('TipoConta.id' => $data['tipo_conta_id'])
            ));
        if (!$tipoConta){
            throw new Exception("Tipo de conta  inválido.");
        }

        //verifica valores
        /*
        if (!array_key_exists("saldo_inicial", $data)){
            throw new Exception("Saldo inicial inválido.");
        }
        if (!is_numeric($data['saldo_inicial'])){
            throw new Exception("Saldo inicial inválido.");
        }
        */
        if (!array_key_exists("saldo", $data)){
            throw new Exception("Saldo inválido.");
        }
        if (!is_numeric($data['saldo'])){
            throw new Exception("Saldo inválido.");
        }

        //verifica nome
        if ($data['nome'] == ''){
            throw new Exception("Nome inválido.");
        }

        return true;
    }

    public function delete($id){
        $this->autoRender = false;

        $dados['excluido'] = 1;

        $this->Conta->id = $id;
        if ($this->Conta->save($dados)) {
            $message = 'Saved';
        } else {
            throw new Exception("Ocorreu uma erro.");
        }

    }
} 