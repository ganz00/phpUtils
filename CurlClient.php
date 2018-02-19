<?php
namespace Lkt\utils;

use Lkt\utils\Response;

/**
 *
 * @author landry.kateu
 */
class  CurlClient {

/**
 *
 * @var string
 */
private  $url ;

/**
 *
 * @var array();
 */
private $_options  ; 


function __construct() {
    $this->addCurl();
    $this->_options = [ /*CURLOPT_RETURNTRANSFER*/19913 => true, /*CURLOPT_VERBOSE*/41 => 1];
    
}

/**
 * 
 * @param array() $header of the request
 * @opts String  $givenOpt option of the curl request
 */
public  function getMethod($header ){
   
    $ch = curl_init();
        
    $this->_options[CURLOPT_HTTPHEADER] = $header;
        
    curl_setopt_array($ch,$this->_options);
    
    try { 
        
        $result=curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $time = curl_getinfo($ch, CURLINFO_CONNECT_TIME );
        $error = curl_error($ch);
        
        if(curl_exec($ch) === false)
        {
            $retour = new Response($status_code,$result,$time,$error);
        } else {
            $retour = new Response($status_code, $result,$time); 
        }
    } catch (Exception $ex) {
        $retour = new Response(-1, curl_error($ch), null , $ex);
    }
    curl_close ($ch);
    
    return $retour;
    
}


/**
 * 
 * @param array() $header
 * @param array() $body
 * @param array() $givenOpt 
 */
public function PostMethod($header  , $body) {
        
    $ch = curl_init();
      
    $opts = $this->_options;
    
    $opts[CURLOPT_HTTPHEADER] = $header;
    
    $opts[CURLOPT_POST] = true;
    
    $opts[CURLOPT_POSTFIELDS] = $body;
        
    curl_setopt_array($ch,$opts);
            
    $result=curl_exec($ch);
	$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $time = curl_getinfo($ch, CURLINFO_CONNECT_TIME );
    $error = curl_error($ch);
    
        if($result == false)
        {
            $retour = new Response($status_code,$result, $error,$time);
            
        } else {
            $retour = new Response($status_code, $result); 
        }
    curl_close ($ch);
    
    return $retour;
    
}

/**
 * 
 * @param array() $header
 * @param array() $body
 * @param array() $givenOpt options of the request
 */
public function PutMethod($header , $body) {
 
    
    $ch = curl_init();
    
    $opts = $this->_options;
    
    $opts[CURLOPT_HTTPHEADER] = $header;

    $opts[CURLOPT_HEADER] = false;

    $opts[CURLOPT_POSTFIELDS] = $body;
        
    curl_setopt_array($ch,$opts);

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            
    $result = curl_exec($ch);


    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $time = curl_getinfo($ch, CURLINFO_CONNECT_TIME );
    $error = null;
    
    if(curl_errno($ch)){
       $error = curl_error($ch);
       $message = curl_strerror(curl_errno($ch)) ;
    }

    if($result == false)
        {
            $retour = new Response($status_code,$result,$time,$error);
            
        } else {
            $retour = new Response($status_code, $result); 
        }
    
    curl_close ($ch);
    
    return $retour;
    
}


/**
 * 
 * @param array() $header
 * @param array() $givenOpt
 *
 */
 public function DeleteMethod($header) {
         
    $ch = curl_init();
    
    $opts = $this->_options;
    
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
    
    $opts[CURLOPT_HTTPHEADER] = $header;
        
    curl_setopt_array($ch,$opts);
    
    try {
        
        $result=curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $time = curl_getinfo($ch, CURLINFO_CONNECT_TIME );
                
        if(curl_exec($ch) === false)
        {
            $retour = new Response($status_code,$result, $error,$time);
        } else {
            $retour = new Response($status_code, $result); 
        }
    } catch (Exception $ex) {
        $retour = new Response(-1, curl_error($ch), null , $ex);
    }
    curl_close ($ch);
    
    return $retour;
}


/**
 * @param string $url
 * @return $this
 */
public function setUrl($url) {

    $this->_options[10002] = $url;

    return $this;   
}

/**
 * @param integer $key
 * @return string $val
 */
public function addOption($key,$val) {
    
     $this->_options[$key] = $val;
     
     return $this;
}

private function addCurl(){

    if( ! function_exists('curl_version')){
        load_curl();
    }

}


}
