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
        $endpoint = config('flexcms.api.endpoint');
        $wsEndpoint = config('flexcms.api.web_socket');
        $this->address = $endpoint;
        $this->ws_address = $wsEndpoint;
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
        // Based by user login
        if (AuthGateway::isLogin()){
            $user = AuthGateway::user();
            $header['Authorization'] = 'Bearer ' . $user['access_token'];
        }
        
        if (config('flexcms.api.use_x_forward_for') == true){
            $header['X-Forwarded-For'] = \Request::getClientIp();    
        }

        if (!isset($header['Content-Type'])){
            $header['Content-Type'] = config('flexcms.api.default_content_type');
        }

        if (!isset($header[config('flexcms.system.request_id')])){
            $header[config('flexcms.system.request_id')] = config('flexcms.api.request_id');
        }

        if (!isset($header[config('flexcms.system.session_id')])){
            $header[config('flexcms.system.session_id')] = base64_encode(\Session::getId());
        }

        $result = array();
        foreach($header as $key => $value){
            if ($key == 'key'){
                $result[] = config('flexcms.system.encrypt_key_id') + ': ' . $value;
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
            CURLOPT_USERAGENT => config('flexcms.system.user_agent'),
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
            CURLOPT_USERAGENT => config('flexcms.system.user_agent'),
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
            CURLOPT_USERAGENT => config('flexcms.system.user_agent'),
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
            CURLOPT_USERAGENT => config('flexcms.system.user_agent'),
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
                    CURLOPT_USERAGENT => config('flexcms.system.user_agent'),
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
                    CURLOPT_USERAGENT => config('flexcms.system.user_agent'),
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
                    CURLOPT_USERAGENT => config('flexcms.system.user_agent'),
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
                    CURLOPT_USERAGENT => config('flexcms.system.user_agent'),
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
