<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 10/04/2016
 * Time: 16:27
 */

class AppExceptionHandler {
    public static function handle($error) {
        $jsonError[] = array(
                "erro" => array(
                    "mensagem" => $error->getMessage()
                )
        );

        echo json_encode($jsonError);
    }
}