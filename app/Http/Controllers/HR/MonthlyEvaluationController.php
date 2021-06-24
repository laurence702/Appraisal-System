<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Model\HR\MonthlyEvaluation;
use App\Models\Model\HR\MonthlyEvaluationCatogory;
use App\Models\Model\HR\MonthlyEvaluationMark;
use Auth;


class MonthlyEvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {

            $data = MonthlyEvaluation::where('employee_id', $request->id)->get();
            if ($data) {
                return response()->json(['data' => $data], 200);
            } else {  
                return response()->json(['error' => 'Error saving record..'], 505);
            }

        } catch (Exception $e) {
            return response()->json(['error' => 'Internal server error'], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

            $data = MonthlyEvaluation::create($request->all());
            if ($data) {
                return response()->json($data, 200);
            } else {  
                return response()->json(['error' => 'Error saving record..'], 505);
            }

        } catch (Exception $e) {
            return response()->json(['error' => 'Internal server error'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        try {

            $data = MonthlyEvaluation::findOrFail($id);
            if ($data) {
                return response()->json($data, 200);
            } else {  
                return response()->json(['error' => 'Data not found..'], 505);
            }

        } catch (Exception $e) {
            return response()->json(['error' => 'Internal server error'], 500);
        }
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {

            $data =  MonthlyEvaluation::where('id',$request->id)
                     ->update(['key_result_area' => $request->key_result_area,
                     'month_of_evaluation' => $request->month_of_evaluation]);
            if ($data) {
                return response()->json($data, 200);
            } else {  
                return response()->json(['error' => 'Update Error '], 401);
            }

        } catch (Exception $e) {
            return response()->json(['error' => 'Internal server error'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MonthlyEvaluation $data)
    {
        try {

            if ($data->delete()) {
                return response()->json(['message' => 'Record has been deleted'],200);
            } else {  
                return response()->json(['error' => 'Error deleting record..'], 505);
            }

        } catch (Exception $e) {
            return response()->json(['error' => 'Internal server error.'], 500);
        }
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCategory(Request $request)
    {
        try {

            $data = MonthlyEvaluationCatogory::create($request->all());
            if ($data) {
                return response()->json($data, 200);
            } else {  
                return response()->json(['error' => 'Error saving record..'], 505);
            }

        } catch (Exception $e) {
            return response()->json(['error' => 'Internal server error'], 500);
        }
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCatgory(Request $request)
    {
        try {
            $data =  MonthlyEvaluationCatogory::where('id',$request->id)
                    ->update(['task' => $request->task]);
            if ($data) {
                return response()->json($data, 200);
            } else {  
                return response()->json(['error' => 'Update Error '], 401);
            }

        } catch (Exception $e) {
            return response()->json(['error' => 'Internal server error'], 500);
        }
    }

}
