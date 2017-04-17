<?php

namespace FlexCMS\BasicCMS\Classes;

use \Log;
// use AuthGateway;
use \Config;

class RequestGateway extends AuthGateway {

	protected $address = null;
	protected $ws_address = null;

    public function __construct(){
        // echo env('REMOTE_API'); die();
        $this->address = env('REMOTE_API','http://hhapi.demo.flexitech.io/v1.1');
        $this->ws_address = env('REMOTE_API', 'http://hhapi.demo.flexitech.io/v1.1');
    }

    public function getServerAddress()
    {
        return $this->address;
    }

    public function getClientIp()
    {
         return '127.0.0.1';
    }


    public function getSocketServerAddress()
    {
        return $this->ws_address;
    }

    private function sanitizeUri($uri){
        return str_replace('$', '/', $uri);
    }

    private function response($res, $resp){
        $encodedResp = $resp;

        try{
            $encodedResp = json_decode($encodedResp, true);

        }
        catch(\Exception $e){
        }
        $result = array(
            'headers' => curl_getinfo( $res ),
            'responseText' => $encodedResp
        );
        curl_close( $res );

        // Check unauthorized requested
        if (isset($result['responseText']['result'])){
            if ($result['responseText']['result'] === 'Your request is not authorized'){
                AuthGateway::logout();
            }
        }
        
        return $result;
    }

    private function translateHeaders($header){
        if (AuthGateway::isLogin()){
            $user = AuthGateway::user();
            $header['Authorization'] = 'Bearer ' . $user['access_token'];
        }

        if (Config::get('meem.useXForwardFor') == true){
            $header['X-Forwarded-For'] = \Request::getClientIp();    
        }

        if (!isset($header['Content-Type'])){
            $header['Content-Type'] = 'application/json';
        }

        // 'YzUzYzcxNjJkODhjMWEzZGZjNWE4Yzc2MWNkYTZkYzU5MTllZDJhOTYyMmFkZDY1ZDUwZGIwMjI4YTNkYzFhNQ==';
        // if (!isset($header['X-HH-Request-ID'])){
        $header['X-GT-Request-ID'] = 'MGUwMTIwZDEyNmYzZTA4ZDI5ZGFkYzcxZWFmMjhhOGU1MDU3OWNjNzRmZDA1ZWUzZjkyZmU5NTc0OWI1ZjE4Nw==';
        // }

        if (!isset($header['X-GT-Connect-ID'])){
            $header['X-GT-Connect-ID'] = base64_encode(\Session::getId());
        }
        // $header['X-HH-Request-ID'] = 'ZDZmY2FhZWZjMmNhOGNmOWM4MGVkMTZhYjhmMWE0ZjdjOWZjMmI1M2VhYzEwZDlhYzIyNzEwZWRmZjAzNThmYw==';
        // $header['X-HH-Connect-ID'] = Config::get('meem.sm_api_token');

        // echo '<pre>'. print_r($header,true).'</pre>'; die();

        $result = array();
        foreach($header as $key => $value){
            if ($key == 'key'){
                $result[] = 'X-GT-Sign-Key: ' . $value;
            }
            else{
                $result[] = $key . ': ' . $value;    
            }
            
        }
        return $result;
    }

    /**
     * Do Get Request to Gateway
     */
    public function get($uri, $headers = array()){

        $uri = $this->getServerAddress() . $this->sanitizeUri($uri);

        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $uri,
            CURLOPT_USERAGENT => 'GoTukTuk',
            CURLOPT_HTTPHEADER => $this->translateHeaders($headers),
            CURLOPT_SSL_VERIFYPEER => false
        ));
        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        return $this->response($curl, $resp);
    }

    /**
     * Do Post Request
     */
    public function post($uri, $data, $headers = array()){
        $uri = $this->getServerAddress() . $this->sanitizeUri($uri);
        // Get cURL resource
        $curl = curl_init();
        \Log::info($this->translateHeaders($headers));
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $uri,
            CURLOPT_USERAGENT => 'GoTukTuk',
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => $this->translateHeaders($headers),
            CURLINFO_HEADER_OUT => true,
            CURLOPT_SSL_VERIFYPEER => false
        ));

        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        return $this->response($curl, $resp);
    }

    /**
     * Do Put Request
     */
    public function put($uri, $data, $headers = array()){
        $uri = $this->getServerAddress() . $this->sanitizeUri($uri);
        // Get cURL resource
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $uri,
            CURLOPT_USERAGENT => 'GoTukTuk',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => $this->translateHeaders($headers),
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_SSL_VERIFYPEER => false
        ));
        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        return $this->response($curl, $resp);
    }

    /**
     * Do Delete Request
     */
    public function delete($uri, $data, $headers = array()){
        $uri = $this->getServerAddress() . $this->sanitizeUri($uri);
        // Get cURL resource
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $uri,
            CURLOPT_USERAGENT => 'GoTukTuk',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => $this->translateHeaders($headers),
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_SSL_VERIFYPEER => false
        ));
        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        return $this->response($curl, $resp);
    }

    /**
     * Do any request
     */
    public function any($method, $url, $data = array(), $headers = array()){
        $curl = curl_init();
        switch ($method) {
            case 'DELETE':                
                curl_setopt_array($curl, array(
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => $url,
                    CURLOPT_USERAGENT => 'GoTukTuk',
                    CURLOPT_POSTFIELDS => json_encode($data),
                    CURLOPT_HTTPHEADER => $this->translateHeaders($headers),
                    CURLOPT_CUSTOMREQUEST => 'DELETE',
                    CURLOPT_SSL_VERIFYPEER => false
                ));
                break;
            case 'PUT': 
                curl_setopt_array($curl, array(
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => $url,
                    CURLOPT_USERAGENT => 'GoTukTuk',
                    CURLOPT_POSTFIELDS => json_encode($data),
                    CURLOPT_HTTPHEADER => $this->translateHeaders($headers),
                    CURLOPT_CUSTOMREQUEST => 'PUT',
                    CURLOPT_SSL_VERIFYPEER => false
                ));
                break;
            case 'POST':   
                curl_setopt_array($curl, array(
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => $url,
                    CURLOPT_USERAGENT => 'GoTukTuk',
                    CURLOPT_POST => 1,
                    CURLOPT_POSTFIELDS => $data,
                    CURLOPT_HTTPHEADER => $this->translateHeaders($headers),
                    CURLINFO_HEADER_OUT => true,
                    CURLOPT_SSL_VERIFYPEER => false
                ));
                break;
            case 'GET':
                curl_setopt_array($curl, array(
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => $url,
                    CURLOPT_USERAGENT => 'GoTukTuk',
                    CURLOPT_HTTPHEADER => $this->translateHeaders($headers),
                    CURLOPT_SSL_VERIFYPEER => false
                ));
            break;
        }
        $resp = curl_exec($curl);
        return $this->response($curl, $resp);
    }


    public function chkEmptyResponse($result){

        if($result['responseText']['result']){

        }

    }


}
