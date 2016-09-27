<?php
/**
 * Created by PhpStorm.
 * User: sn1007071
 * Date: 07/06/2016
 * Time: 12:51
 */
App::uses('TipoGrupo', 'Model');

class GruposController extends AppController{

    public function index() {
        $this->autoRender = false;

        //$this->Grupo->Behaviors->load('Containable');
        /*
        $dados = $this->Grupo->find('all',
            array(
                'conditions' => array(
                    //'id_usuario' => $this->usuarioId
                )
            ));
        */

        $db = $this->Grupo->getDataSource();
        $dados =  $db->fetchAll(
            'SELECT * from grupos Grupo
            INNER JOIN usuarios Usuarios ON Usuarios.id = Grupo.usuario_id
            WHERE Grupo.usuario_id = :usuarioId
            AND Grupo.modified > DATE_ADD(Usuarios.sincronizado,INTERVAL -1 DAY)',

            array('usuarioId' => $this->usuarioId)

        );

        $this->response->body(json_encode($dados));
    }

    public function indexTipoGrupos(){
        $this->autoRender = false;

        $tipoGrupo = new TipoGrupo();
        $dados = $tipoGrupo->find('all');
        $this->response->body(json_encode($dados));

    }

    public function view($id){
        $this->Grupo->Behaviors->load('Containable');
        $dados = $this->Grupo->find('first', array(
            'conditions' => array('Grupo.id' => $id)
        ));

        $this->response->body(json_encode($dados));
    }

    public function add() {
        $this->autoRender = false;
        $this->request->data['usuario_id'] = $this->usuarioId;

        $this->validaDados($this->request->data);

        $this->Grupo->create();
        if ($this->Grupo->saveAssociated($this->request->data)) {
            $this->view($this->Grupo->id);
        } else {
            throw new Exception("Ocorreu um erro.");
        }

    }

    public function edit($id) {
        $this->autoRender = false;

        $this->validaDados($this->request->data);

        $this->Grupo->id = $id;
        if ($dados = $this->Grupo->save($this->request->data)) {
            $this->response->body(json_encode($dados));
        } else {
            throw new Exception("Ocorreu uma erro.");
        }
    }

    private function validaDados($data){
        //verifica tipo conta
        if (!array_key_exists("id_tipo_grupo", $data)){
            throw new Exception("Tipo de categoria inválido.");
        }
        $tipoGrupoModel = new TipoGrupo();
        $tipoGrupo =  $tipoGrupoModel->find('first',
            array(
                'conditions' => array('TipoGrupo.id' => $data['id_tipo_grupo'])
            ));
        if (!$tipoGrupo){
            throw new Exception("Tipo de categoria inválido.");
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

        $this->Grupo->id = $id;
        if ($this->Grupo->save($dados)) {
            $message = 'Saved';
        } else {
            throw new Exception("Ocorreu uma erro.");
        }

    }
} 