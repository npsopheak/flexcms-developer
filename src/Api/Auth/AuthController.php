<?php

namespace FlexCMS\BasicCMS\Api\Auth;

use Validator;
use \Input;
use \Response;
use App\Http\Controllers\Controller;

abstract class AuthController extends Controller
{

    protected function ok($content, $code = null, $options = null, $status = 200){
        $result = [
            'result' => $content,
            'options' => $options,
            'code' => $code,
            'error' => null
        ];
        return response($result, $status)
                  ->header('Content-Type', 'application/json');
    }

    protected function error($content, $error_type = 'general', $code = null, $options = null, $status = 400){

        $result = [
            'result' => $content,
            'options' => $options,
            'code' => $code ? $code : $status,
            'error' => $error_type
        ];

        return response($result, $status)
                  ->header('Content-Type', 'application/json');
    }

    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('api.guest', ['except' => 'getLogout']);
    }
    
    /***
     * Login via dashboard database access
     */
    abstract public function login(Request $request = null);

    abstract public function logout(Request $request = null);

    /***
     * Login via API call
     */

    abstract public function apiLogin(Request $request = null);

    abstract public function apiLogout(Request $request = null);
}
