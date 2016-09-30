<?php

App::uses('TipoGrupo', 'Model');
App::uses('TipoConta', 'Model');

class UsuariosController extends AppController {

    public $components = array('RequestHandler');

    public function index() {
        $this->autoRender = false;
        $dados = $this->Usuario->find('first', array(
            'conditions' => array('Usuario.id' => $this->usuarioId),
            'recursive' => 2
        ));

        $tipoGrupo = new TipoGrupo();
        $dadosTipoGrupo= $tipoGrupo->find('all');
        $dados["TipoGrupo"] = $dadosTipoGrupo;

        $tipoConta = new TipoConta();
        $dadosTipoConta = $tipoConta->find('all');
        $dados["TipoConta"] = $dadosTipoConta;

        $this->response->body(json_encode($dados));
    }

    public function edit($id) {
        $this->autoRender = false;

        $d = DateTime::createFromFormat('d/m/Y', $this->request->data['sincronizado']);
        $this->request->data['sincronizado'] = $d->format('Y-m-d');

        $this->Usuario->id = $id;
        if ($dados = $this->Usuario->save($this->request->data)) {
            $this->response->body(json_encode($dados));
        } else {
            throw new Exception("Ocorreu uma erro.");
        }
    }

    public function add() {
        require_once 'Google/autoload.php';

        $data = $this->request->input('json_decode');

        $this->autoRender = false;

        $this->response->body($this->email);
    }
}