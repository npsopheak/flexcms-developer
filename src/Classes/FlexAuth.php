<?php

namespace FlexCMS\BasicCMS\Classes;

use \Agent;
use \Log;
use \Session;
use \Cookie; 
use \Meta; 
use \Cache;
use \View;
/*
    FlexAuth control the session store of the login user
*/
class FlexAuth {

    private $token = null;
    protected $tokenProperty = null;

    public function __construct(){
        $tokenProperty = config('flexcms.api.token_property');
        $this->tokenProperty = $tokenProperty;
    }

    public function login($key = 'user', $userData){
        Session::put($key, $userData);
    }

    public function update($key = 'user', $closure = null){
        if ($this->isLogin()){
            $data = $this->get($key);    
            if ($closure != null){
                $data = $closure($data);
            }
            $this->login($data);
        }        
    }

    public function updateInfo($key = 'user', $closure = null){
        if ($this->isLogin()){
            $data = $this->get($key);    
            if ($closure != null){
                $data = $closure($data);
            }
            $this->login($key, $data);
        }        
    }

    public function get($key = 'user'){
        return Session::get($key);
    }

    public function getProperty($properties, $key = 'user', $user = null){

        if (!$this->isLogin()){
            return '';
        }

        if ($user == null){
            $user = $this->get($key);
        }
  
        $split = explode('.', $properties);
        $value = '';
        if (count($split) <= 0){
            return '';
        }
        $value = $split[0];
        unset($split[0]);
        if (!isset($user[$value])){
            return '';
        }
        if (is_array($user[$value]) && count($split) > 0){
            return $this->getProperty(implode('.', $split), $user[$value]);
        }
        else{
            return $user[$value];
        }

    }

    public function isLogin($key = 'user', $closure = null){
        $user = $this->get($key);
        if ($closure){
            $checkValue = $closure($user);
            return $checkValue;
        }
        else{
            if (is_array($user)){
                return true;
            }
        }
        return false;
    }

    public function logout($key = 'user'){
        Session::forget($key);
        // Session::flush();
    }

    // public function checkRole($userRole){
    //     $chk = false;
    //     if(AuthGateway::isLogin()){
    //         $profile = AuthGateway::user();
    //         return $profile['role']['name'] == $userRole;
    //     }
    //     return $chk;   
    // }

}
