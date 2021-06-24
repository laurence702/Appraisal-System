<?php

namespace Modules\Hr\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Hr\Models\Designation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DesignationController extends Controller
{
    public function DesignationforLMS()
    {
        $designations = Designations::all()->toarray();
        return response()->json([
            'status' => true,
            'data' => $designations
            ]);
    }

    public function bulksaveDesignations()
    {
        $response = Http::get('https://ukdiononline.com/api/alldesignations');
        if($response->successful()){
            $res_body = $response['data'];
            $fn = [];
            foreach ($res_body as $key => $value) {
               Designation::create($value);
               //creating in a loop
            }
            if(count(Designation::all()) > 1 ){
                return response()->json([
                    'status' => true,
                    'message'=> "Designations created"
                ],200);
            }else{
                return response()->json([
                    'status' => 'failed',
                    'message'=> "Operation failed to create"
                ],400);
            }
        }else{
            throw new Exception("Cant find designations from external service");
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $this->validate($request, [
                'title' => 'required',
                'status' => 'required'
            ]);

            $title = $request->input('title');
            $description = $request->input('description');
            $status = $request->input('status');

            $designation = new Designation;
            $designation->title = $title;
            $designation->description = $description;
            $designation->status = $status;
            $result = $designation->save();
            if($result){
                
            }

            return redirect('/designations/create');

        } catch (ModelNotFoundException $e) {
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Http\Models\Admin\Designations  $designations
     * @return \Illuminate\Http\Response
     */
    public function show(Designations $designations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Http\Models\Admin\Designations  $designations
     * @return \Illuminate\Http\Response
     */
    public function edit(Designations $designations, $id=NULL)
    {

        try {
            if(is_null($id)){ return redirect('/designations'); }

            $data['designation'] = $designations->findOrFail($id);
            return view('admin.designations.edit', $data);
            
        } catch (ModelNotFoundException $e) {
           return redirect('/designations'); 
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Http\Models\Admin\Designations  $designations
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Designations $designations, $id = NULL)
    {
        try {

            if(is_null($id)){ return redirect('/designations'); }

            $this->validate($request, [
                'title' => 'required',
                'status' => 'required'
            ]);

            $title = $request->input('title');
            $description = $request->input('description');
            $status = $request->input('status');

            $designation = $designations->findOrFail($id);
            $designation->title = $title;
            $designation->description = $description;
            $designation->status = $status;
            $result = $designation->save();
            if($result){
                $request->session()->flash('msg', __('admin/designations.update'));
            }
            return redirect('/designations/edit/'.$id);

        } catch (ModelNotFoundException $e) {
            return redirect('/designations'); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Models\Admin\Designations  $designations
     * @return \Illuminate\Http\Response
     */
    public function destroy(Designations $designations, $id)
    {
        try {
            if(is_null($id)){ return redirect('/designations'); }

            $designation = $designations->findOrFail($id);
            $result = $designations->destroy($designation->id);
            if($result){
                session()->flash('msg', __('admin/designations.remove'));
            }

            return redirect('/designations');

        } catch (ModelNotFoundException $e) {
            return redirect('/designations');
        }
    }
}
