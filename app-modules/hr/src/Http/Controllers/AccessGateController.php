<?php

namespace Modules\Hr\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Modules\Employee\Models\Employee;
use Spatie\Permission\Models\Permission;

class AccessGateController extends Controller
{
    
    public function createRole(Request $request)
    {
        try {
            $role = Role::create(['name' => $request->name]);
            return successExecution();
        } catch (\Exception $e) {
            return failedExecution($request);
        } 
    }

    public function createPermission(Request $request)
    {
        try {
            $role = Permission::create(['name' => $request->name]);
            return successExecution();
        } catch (\Exception $e) {
            return failedExecution($request);
        } 
    }

    public function grantPermission(Request $request)
    {
        $validator= \Validator::make($request->all(),[
            'userId' => 'required|integer',
            'permission' => 'required'
        ]);
        if($validator->fails()){
            return array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
        }
        $user = getUserById($request->userId);
        //return $user->can($request->permission);
        $action = $user->givePermissionTo((string)$request->permission);
        if($action)
            return successExecution();
        return failedExecution($request);
    }

    public function assignRoleToUser(Request $request) //userId,role,assigner
    {
        $validator= \Validator::make($request->all(),[
            'userId' => 'required|integer',
            'role' => 'required'
        ]);
        if($validator->fails()){
            return array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
        }
        $user = Employee::where('id',$request->userId)->first();
        $action = $user->assignRole($request->role);
        if($action){
            return successExecution();
        }
        return failedExecution($request);
    }
}
