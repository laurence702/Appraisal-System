<?php

if(!function_exists('FailedLoginResponse')){
    function FailedLoginResponse(){
        return formatAsJson(false, 'Access Denied, please check your login details and try again', [], 401);
    }
}

if(!function_exists('UserNotFoundResponse')){
    function UserNotFoundResponse($info){
        return formatAsJson(false, "User $info not found", [], 404);
    }
}
