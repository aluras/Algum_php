<?php
/**
 * Created by PhpStorm.
 * User: sn1007071
 * Date: 23/03/2016
 * Time: 10:13
 */

class UsuariosController extends AppController {

    public $components = array('RequestHandler');

    public function index() {
        $this->autoRender = false;
        $usuarios = $this->Usuario->find('first', array(
            'conditions' => array('Usuario.id' => $this->usuarioId)
        ));
        $this->set(array(
            'usuarios' => $usuarios,
            '_serialize' => array('usuarios')
        ));
        $this->response->body(json_encode($usuarios));
    }

    public function add() {
        require_once 'Google/autoload.php';

       // if (!$this->request->data){
        //    $this->response->body('Error');
       // }

        //$email = $this->request->data['email'];
       // $token = $this->request->data['idToken'];

        //$client = new Google_Client();

        //$ticket = $client->verifyIdToken($token);
        //if ($ticket) {
        //  $data = $ticket->getAttributes();
        //}

        $this->autoRender = false;

/*
        $usuario =  $this->Usuario->find('first',
                        array(
                            'conditions' => array('Usuario.email' => $email)
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
*/
        $this->response->body($this->email);
    }
}