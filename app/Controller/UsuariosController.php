<?php
/**
 * Created by PhpStorm.
 * User: sn1007071
 * Date: 23/03/2016
 * Time: 10:13
 */

class UsuariosController extends AppController {

    public $components = array('RequestHandler');

    public function opauth_complete() {
        debug($this->data);
    }

    public function index() {
        $this->autoRender = false;
        $usuarios = $this->Usuario->find('all');
        $this->set(array(
            'usuarios' => $usuarios,
            '_serialize' => array('usuarios')
        ));
        $this->response->body(json_encode($usuarios));
    }

    public function add() {
        $this->autoRender = false;

        if (!$this->request->data){
            $this->response->body('Error');
        }

        $usuario =  $this->Usuario->find('first',
                        array(
                            'conditions' => array('Usuario.email' => $this->request->data['email'])
                        ));

        if(!$usuario){
            $this->Usuario->create();
            if ($usuario = $this->Usuario->save($this->request->data)) {
                $message = 'Saved';
            } else {
                $message = 'Error';
            }
        }

        $this->response->body(json_encode($usuario));
    }
}