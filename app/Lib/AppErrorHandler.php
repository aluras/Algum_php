<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 09/04/2016
 * Time: 23:19
 */

class AppError {
    public static function handleError($code, $description, $file = null,
                                       $line = null, $context = null) {

        echo 'There has been an error!';
    }
}