<?php

namespace Modules\Hr\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Hr\Models\Department;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class DepartmentController extends Controller
{
    public function allDeptsLMS()
    {
        $depts = Departments::all()->toarray();
        return response()->json([
            'status' => true,
            'data' => $depts
            ]);
    }

    public function bulksaveDepts()
    {     
        $response = Http::get('https://ukdiononline.com/api/alldepts');
        if($response->successful()){
            $res_body = $response['data'];
            $fn = [];
            foreach ($res_body as $key => $value) {
               Department::create($value);
               //creating in a loop
            }
            if(count(Department::all()) > 1 ){
                return response()->json([
                    'status' => true,
                    'message'=> "Departments created"
                ]);
            }else{
                return response()->json([
                    'status' => 'failed',
                    'message'=> "Operation failed to create"
                ]);
            }
        }else{
            return "an error occured";
        }
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   

        $depts = Department::all()->toarray();
        return response()->json([
            'status' => true,
            'data' => $depts
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.departments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'status' => 'required'
        ]);

        $title = $request->input('title');
        $description = $request->input('description');
        $status = $request->input('status');


        $department = new Department;
        $department->title = $title;
        $department->description = $title;
        $department->status = $status;
        $result = $department->save();
        if($result){
            $request->session()->flash('msg', __('admin/departments.added'));
        }
        return redirect('/departments/create');

    }

    /**
     * Display the specified resource.
     *
     * @param  Modules\Hr\Models\Department;  $departments
     * @return \Illuminate\Http\Response
     */
    public function show(Departments $departments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Modules\Hr\Models\Department;  $departments
     * @return \Illuminate\Http\Response
     */
    public function edit(Departments $departments, $id = NULL)
    {

       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Modules\Hr\Models\Department;  $departments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Departments $departments, $id = NULL)
    {
        
        if(is_null($id)){ return response()->json([
            'status'=>false,
            'message'=>'Department Not found'
        ],404); }

        $this->validate($request, [
            'title' => 'required',
            'status' => 'required'
        ]);

        $title = $request->input('title');
        $description = $request->input('description');
        $status = $request->input('status');

        $department = $departments->find($id);
        $department->title = $title;
        $department->description = $description;
        $department->status = $status;
        $result = $department->save();
        if($result){
            return response()->json([
                'status' => true,
                'message' => 'Successful'
            ]);
        }
        return redirect('/departments/edit/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Modules\Hr\Models\Department;  $departments
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departments $departments, $id = NULL)
    {
        if(is_null($id)){ return redirect('admin/departments'); }

        $result = $departments->destroy($id);
        if($result){
            session()->flash('msg', __('admin/departments.remove'));
        }

        return redirect('/departments');
    }
}
