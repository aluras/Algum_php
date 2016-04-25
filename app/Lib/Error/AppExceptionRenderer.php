<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 23/04/2016
 * Time: 00:30
 */

// in app/Lib/Error/AppExceptionRenderer.php
App::uses('ExceptionRenderer', 'Error');

class AppExceptionRenderer extends ExceptionRenderer {
    public function error500($error) {
        $message = $error->getMessage();
        $url = $this->controller->request->here();
        $code = ($error->getCode() > 500 && $error->getCode() < 506) ? $error->getCode() : 500;
        $this->controller->response->statusCode($code);
        $this->controller->set(array(
            'name' => h($message),
            'message' => h($message),
            'url' => h($url),
            'error' => $error,
            '_serialize' => array('name', 'message', 'url')
        ));
        $this->_outputMessage('error500');
    }


    public function error400($error) {
        $message = $error->getMessage();
        $url = $this->controller->request->here();
        $this->controller->response->statusCode($error->getCode());
        $this->controller->set(array(
            'name' => h($message),
            'message' => h($message),
            'url' => h($url),
            'error' => $error,
            '_serialize' => array('name', 'message', 'url')
        ));
        $this->_outputMessage('error400');
    }
}