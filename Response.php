<?php

/**
 * Description of Response
 *
 * @author landry.kateu
 */
namespace Lkt\utils;

class Response {
/**
 *
 * @var int 
 */ 
public $codeRetour;
 
/**
 *
 * @var string 
 */
public $datas;

/**
 *
 * @var string 
 */
public $time;

/**
 *
 * @var Exception 
 */
public $exception;


        function __construct($codeRetour, $message, $time = null , $exception = null) {
    $this->codeRetour = $codeRetour;
    $this->message = $message;
    $this->time = $time;
    $this->exception = $exception;
}





}
