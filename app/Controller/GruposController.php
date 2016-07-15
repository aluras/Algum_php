<?php
/**
 * Created by PhpStorm.
 * User: sn1007071
 * Date: 07/06/2016
 * Time: 12:51
 */

class GruposController extends AppController{

    public function index() {
        $this->autoRender = false;

        $this->Grupo->Behaviors->load('Containable');

        $dados = $this->Grupo->find('all',
            array(
                'conditions' => array(
                    'id_usuario' => $this->usuarioId
                )
            ));

        $this->response->body(json_encode($dados));
    }
} 