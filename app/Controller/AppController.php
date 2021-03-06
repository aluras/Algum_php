<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');
App::uses('Usuario', 'Model');
App::uses('Conta', 'Model');
App::uses('Conta_padrao', 'Model');
App::uses('Grupo', 'Model');
App::uses('GrupoUsuario', 'Model');
App::uses('Grupo_padrao', 'Model');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public $REST = false;
    public $email = '';
    public $nomeUsuario = '';
    public $usuarioId = 0;

    function beforeFilter()
    {
        $this->layout = "";

        if($this->name != "CakeError"){
            try {



                require_once 'Google/autoload.php';
                $token = $this->request->header('Application-Authorization');

                if (!$token){
                    throw new Exception("Ops, sem autorização!");
                }

                $client = new Google_Client();
                $google_client_id = '48636432617-l6duqf4jpe3irph355fas92mqfcimfmr.apps.googleusercontent.com';
                $client->setClientId($google_client_id);

                $ticket = $client->verifyIdToken($token);

                $data = $ticket->getAttributes();

                $this->email = $data['payload']['email'];
                $this->nomeUsuario = $data['payload']['name'];

                $usuarioModel = new Usuario();
                //$usuarioModel->Behaviors->load('Containable');
                $usuario =  $usuarioModel->find('first',
                    array(
                        'conditions' => array('Usuario.email' => $this->email)
                        //'conditions' => array('Usuario.email' => 'andrelrs80@gmail.com')
                    ));

                if(!$usuario) {
                    $usuario = $usuarioModel->create();
                    $usuario['email'] = $this->email;
                    $usuario['nome'] = $this->nomeUsuario;

                    $d = date('Y-m-d');
                    $usuario['sincronizado'] = $d;

                    if (!$usuario = $usuarioModel->save($usuario)) {
                        throw new Exception("Erro ao registrar o usuario");
                    }
                }

                if(!isset($usuario["ContaUsuario"]) || count($usuario["ContaUsuario"])==0) {
                    $contasPadraoModel = new Conta_padrao();
                    $contasPadrao = $contasPadraoModel->find('all');

                    foreach($contasPadrao as $contaPadrao){
                        $contaModel = new Conta();
                        $conta = $contaModel->create();
                        $conta['Conta']['nome'] = $contaPadrao['Conta_padrao']['nome'];
                        $conta['Conta']['tipo_conta_id'] = $contaPadrao['Conta_padrao']['tipo_conta_id'];
                        $conta['Conta']['usuario_id'] = $usuario["Usuario"]["id"];
                        $conta['ContaUsuario'] = array(
                            array(
                                'usuario_id' => $usuario["Usuario"]["id"],
                                'aceita' => 1
                            )
                        );
                        if (!$contaModel->saveAssociated($conta)) {
                            throw new Exception("Erro ao registrar contas");
                        }

                    }

                }

                if(!isset($usuario["GrupoUsuario"]) || count($usuario["GrupoUsuario"])==0) {
                    $gruposModel = new Grupo();
                    $gruposPadrao = $gruposModel->find('all',
                        array(
                            'conditions' => array(
                                'padrao' => 1
                            )
                        ));

                    foreach($gruposPadrao as $grupoPadrao){
                        $grupoUsuarioModel = new GrupoUsuario();
                        $grupoUsuario = $grupoUsuarioModel->create();
                        $grupoUsuario['GrupoUsuario']['grupo_id'] = $grupoPadrao['Grupo']['id'];
                        $grupoUsuario['GrupoUsuario']['usuario_id'] = $usuario["Usuario"]["id"];
                        $grupoUsuario['GrupoUsuario']['aceito'] = 1;
                        if (!$grupoUsuarioModel->save($grupoUsuario)) {
                            throw new Exception("Erro ao registrar grupos");
                        }

                    }

                }

                //throw new Exception(json_encode($usuario));
                $this->usuarioId = $usuario["Usuario"]["id"];


                //throw new Exception("meu deus");
                //$this->usuarioId = 31;
            }catch (Exception $e){
                throw new Exception("Erro: " . $e->getMessage());
            }


        }




        // Add additional checks here to support other formats
        if (isset($this->request->params['ext']) &&
            ($this->request->params['ext'] == 'json'))
        {
            $this->REST = 'json';
        }
        $this->set('REST', $this->REST);
    }

}
