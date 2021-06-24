<?php

use Modules\Employee\Models\Employee;

if(!function_exists('checkIfNotEmpty')){
    function checkIfNotEmpty($item):bool
    {
        return (!empty($item) && !is_null($item));
    }
}

if(!function_exists('checkNotEmpty')){
    function checkNotEmpty($data){
        return (empty($data) && is_null($data)) ? false : true;
    }
}

if(!function_exists('formatAsJson')){
    function formatAsJson($status=NULL, $message=NULL, $data=NULL, $statusCode=NULL){
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }
}

if(!function_exists('getLoggedInEmployee')){
    function getLoggedInEmployee($info=null){
        switch ($info) {
            case 'name':
                return (string)getUser()->first_name .' '.getUser()->last_name;
                break;
            case 'id':
                return (int)getUser()->id;
                break;
            case 'email':
                return (string)getUser()->email;
                break;
            default:
                return (object)getUser();
                break;
        }
    }
}

if(!function_exists('getUser')){
    function getUser(){
        return Auth::guard('sanctum')->user();
    }
}

if(!function_exists('getUserById')){
    function getUserById($id){
        $user = Employee::where('id',$id)->where('status',1)->first();
       return checkIfNotEmpty($user) ? $user : UserNotFoundResponse($id); 
    }
}

if(!function_exists('failedExecution')){
    function failedExecution($request){
        \Log::info("An Error occured, causer => $request");
        return formatAsJson('Failed to execute, please try again', false, [], 401);
    }
}

if(!function_exists('successExecution')){
    function successExecution(){
        return formatAsJson('Success',true, [], 200);
    }
}





