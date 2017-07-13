<?php

namespace FlexCMS\BasicCMS\Classes;

use \Agent;
use \Log;
use \Session;
use \Cookie; 
use \Meta; 
use \Cache;
use \View;

class AuthGateway {

    

    public function login($userData){
        Session::put('user', $userData);
    }

    public function update($data){
        if ($this->isLogin()){
            $user = $this->user();    
            $data['access_token'] = $user['access_token'];
            $this->login($data);
        }        
    }

    public function updateInfo($data){
        if ($this->isLogin()){
            $user = $this->user();    
            $user['profile']['photo'] = $data;
            $this->login($user);
        }        
    }

    public function updateToken($data){
        if ($this->isLogin()){
            $user = $this->user();    
            $user['access_token'] = $data;
            $this->login($user);
        }        
    }

    public function user(){
        $user = Session::get('user');
        // echo '<pre>'.print_r(json_encode( $user) ,true).'</pre>'; die();
        return $user;
    }

    public function userIgnoreToken(){
        if ($this->isLogin()){
            $user = Session::get('user');
            unset($user['access_token']);
            return $user;            
        }
    }

    public function getProperty($properties, $user = null){

        if (!$this->isLogin()){
            return '';
        }

        if ($user == null){
            $user = $this->user();
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

    public function isLogin(){
        $user = $this->user();
        if ( is_array($user) && isset($user['_id']) && isset($user['access_token']) ){
            return true;
        }
        else{
            return false;
        }
    }

    public function logout(){
        Session::forget('user');
        // Session::flush();
    }

    public function checkRole($userRole){
        $chk = false;
        if(AuthGateway::isLogin()){
            $profile = AuthGateway::user();
            return $profile['role']['name'] == $userRole;
        }
        return $chk;   
    }

    /* ADMIN PART */

    public function isAdminLogin(){
        $user = $this->admin();
        if ( is_array($user) && isset($user['_id']) && isset($user['access_token']) ){
            return true;
        }
        else{
            return false;
        }
    }


    public function loginAdmin($userData){
        Session::put('admin', $userData);
    }

    public function updateAdmin($data){
        if ($this->isAdminLogin()){
            $user = $this->admin();    
            $data['access_token'] = $user['access_token'];
            $this->login($data);
        }        
    }

    public function updateAdminToken($data){
        if ($this->isAdminLogin()){
            $user = $this->admin();    
            $user['access_token'] = $data;
            $this->login($user);
        }        
    }

    public function admin(){
        $user = Session::get('admin');
        // echo '<pre>'.print_r(json_encode( $user) ,true).'</pre>'; die();
        return $user;
    }

    public function userAdminIgnoreToken(){
        if ($this->isAdminLogin()){
            $user = Session::get('admin');
            unset($user['access_token']);
            return $user;            
        }
    }

    public function getPropertyAdmin($properties, $user = null){

        if (!$this->isAdminLogin()){
            return '';
        }

        if ($user == null){
            $user = $this->admin();
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

    public function logoutAdmin(){
        Session::forget('admin');
        // Session::flush();
    }

    public function checkRoleAdmin($userRole){
        $chk = false;
        if(AuthGateway::isAdminLogin()){
            $profile = AuthGateway::admin();
            return $profile['role']['name'] == $userRole;
        }
        return $chk;   
    }

    /* END ADMIN PART */

    public function checkUserAdmin(){
        return $this->checkRole('admin');
    }

    public function checkUserMerchant(){
        return $this->checkRole('merchant');
    }

}
