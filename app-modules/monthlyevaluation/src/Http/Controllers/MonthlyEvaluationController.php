<?php

namespace Modules\Monthlyevaluation\Http\Controllers;

use Throwable;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Validator;
use Modules\Employee\Models\Employee;
use Modules\Monthlyevaluation\Models\Sub_Categories;
use Modules\Monthlyevaluation\Models\MonthlyEvaluation;
use Exception;
class MonthlyEvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = MonthlyEvaluation::all();
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
    public function store(Request $request) :JsonResponse//create KRA/KPI
    {
        $data = $request->all();
        try {
            $created = MonthlyEvaluation::create($data);
            return formatAsJson(true,'Appraisal created', $data, 200);
        } catch (\Exception $e) {
           throw new Exception($e->getMessage());  
            return formatAsJson(false, $e->getMessage(), "Error Occured", 400);
        }

    }

    public function throwMe($e)
    {
        throw new Exception($e->getMessage());  
    }

    public function getEmployeeKPI(Request $request) :JsonResponse
    {
        //check employee is active and exists
        $emp_details = Employee::where('id', (int) $request->employee_id)->where('status',1)->first();
        if(checkNotEmpty($emp_details)){
            $eval = MonthlyEvaluation::where('employee_id',(int)$request->employee_id)
                                        ->whereMonth('created_at', Carbon::now()->month)->get();
            return formatAsJson(true,"KPIs for this employee this month", $eval, 200);
        }
        return formatAsJson(false,'KPIs not set yet for this month', $eval, 200);

    }

    public function getFullEval(Request $request) :JsonResponse
    {
        $emp_details = Employee::where('id', (int) $request->employee_id)->where('status',1)->first();
        if(checkNotEmpty($emp_details)){
            $eval = MonthlyEvaluation::with('subkpi')->where('employee_id',(int)$request->employee_id)
                                        ->whereMonth('created_at', Carbon::now()->month)->get();
            return formatAsJson(true,"KPIs for this employee this month", $eval, 200);
        }
        return formatAsJson(false,'KPIs not set yet for this month', $eval, 200);
    }

    

    public function createSubCategory(Request $request)   //by employee
    {
        $validator = \Validator::make($request->all(), [
            'monthly_evaluation_id' => 'required',
            'task' => 'required'
        ]);
        if($validator->fails())
            return formatAsJson(false,'Some data not filled',[],400);
        try {
            if(Sub_Categories::create($request->all())){
                return successExecution();
            }
        } catch (\Exception $e) {
            return formatAsJson(false,$e->getMessage(),[],400);
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
        //
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
    public function update(Request $request, $id) //Update KPI/KRA by supervisor
    {
       return ( MonthlyEvaluation::where('id', $request->appraisal_id)
                                 ->whereMonth('created_at', Carbon::now()->month)
                                 ->update(['key_result_area'=> $request->key_result_area]) ) 
                                 ? successExecution(): failedExecution($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $eval= MonthlyEvaluation::where('id', $id)->first();
        if(checkNotEmpty($eval)){
            try {
                $eval->delete();
                return formatAsJson(true,'Appraisal deleted', $eval, 200);
            } catch (\Throwable $th) {
                return formatAsJson(false,'An error occured', $data, 200);
            }
        }
        return formatAsJson(false,'Appraisal not found', [], 404);
    }
}
