<?php
require __DIR__.'/db-class.php';

class Swapi extends DataBase {
    // Curl params
    private $handler    = "";
    private $url        = '';
    private $info       = [];
    private $data       = [];
    private $method     = 'get';
    public $content     = '';

    //Set the url 
    public function url( $url = '' ){
        $this->url = $url;
        return $this;
    }

    //Set data inputs to send 
    public function data( $data = [] ){
        $this->data = $data;
        return $this;
    }

    //Set request method (defaults to get)
    public function method( $method = 'get' ){
        $this->method = $method;
        return $this;
    }

    //Function to send our request
    //For this example = only request
    public function send(){
        try{
            if( $this->handler == null ){
                $this->handler = curl_init( );
            }
            switch( strtolower( $this->method ) ){
                case 'post':
                    curl_setopt_array ( $this->handler , [
                        CURLOPT_URL => $this->url,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_POST => count($this->data),
                        CURLOPT_POSTFIELDS => http_build_query($this->data),
                    ] );
                break;
                case 'put':
                    curl_setopt_array ( $this->handler , [
                        CURLOPT_URL => $this->url,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_CUSTOMREQUEST => 'PUT',
                        CURLOPT_POSTFIELDS => http_build_query($this->data),
                    ] );
                break;
                case 'delete':
                    curl_setopt_array ( $this->handler , [
                        CURLOPT_URL => $this->url,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_CUSTOMREQUEST => 'DELETE',
                        CURLOPT_POSTFIELDS => http_build_query($this->data),
                    ] );
                break;                    
                default:
                    curl_setopt_array ( $this->handler , [
                        CURLOPT_URL => $this->url,
                        CURLOPT_RETURNTRANSFER => true,
                    ] );
                break;
            }

            curl_setopt_array($this->handler , [
                $this->handler, CURLOPT_HEADER, true,
            ]);

            $this->content = curl_exec ( $this->handler );
            $this->info = curl_getinfo( $this->handler,CURLINFO_HTTP_CODE );   
        }catch( Exception $e ){
            die( $e->getMessage() );
        }
    }
    // Get Info of response
    public function info () {
        return $this->info;
    }

    //Function to close the connection curl
    public function close(){	
        curl_close ( $this->handler );
        $this->handler = null;  
    }
}
