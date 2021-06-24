<?php

namespace Modules\Employee\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Modules\Employee\Models\Employee;
use nickdnk\ZeroBounce\Email;
use nickdnk\ZeroBounce\Result;
use nickdnk\ZeroBounce\ZeroBounce;

class EmployeeController extends Controller
{
    public function login(Request $request)
    {
        $validator= \Validator::make($request->all(),[
            'login_info' => 'required',
            'password' => 'required'
        ]);
        if($validator->fails()){
            return array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
        }

        $employee = Employee::where('email', $request->login_info)->where('status',1)->first();
        if(checkNotEmpty($employee))
            if($this->attemptLogin($employee, $request))
                return response()->json([
                    "status" => true,
                    "messge"=> "log in successful",
                    "data" => $employee,
                    "access_token" => $employee->createToken('authToken',['fetch:users'])->plainTextToken,
                    "token_type" => "Bearer"
                ],200);
            return FailedLoginResponse();
        return UserNotFoundResponse($request->login_info);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index() : Object
    {
        $emps = Employee::get()->load(['departments','designation']);
        if(count($emps) > 1){
            $fnArray = array();
                
            foreach($emps as $key => $value){
               unset($value->gross);
               unset($value->leaving_date);
               unset($value->designation_id);
               unset($value->shift_id);
               unset($value->employee_type);
               unset($value->allowed_leave);
               unset($value->salary_type);
               unset($value->monthly_reimbursable);
               unset($value->monthly_salary);
               unset($value->basic_salary);
               unset($value->accomodation_allowance);
               unset($value->percentage_to_achived);
               unset($value->house_rent_allowance);
               unset($value->transportation_allowance);
               unset($value->telephone_allowance);
               unset($value->leave_allowance);
               unset($value->others_allowance);
               unset($value->monthly_target);
               unset($value->smartsaver_date);
               unset($value->smartsaver_percentage);
               unset($value->account_number);
               unset($value->beneficiary_bank);
               unset($value->overtime_1);
               unset($value->overtime_2);
               unset($value->overtime_3);
               unset($value->confirmed_by);
               unset($value->status);
               unset($value->cover);
               unset($value->avatar);
               unset($value->remember_token);
               unset($value->create_by);
               unset($value->updated_by);
               unset($value->date_updated);
               unset($value->create_ip);
               unset($value->login_ip);
               unset($value->last_login_time);
               unset($value->created_at);
               unset($value->updated_at);
              
              array_push($fnArray, $value);
        }
            return formatAsJson(true, 'List of all employees', $emps, 200);
        }
            
        return formatAsJson(false, 'No employee found', $emps, 200);
    }

    public function bulkSaveEmployees()
    {
        $response = Http::get('https://ukdiononline.com/api/allLMSemployees/rw');
        if($response->successful()){
            $res_body = $response['data'];
            $fn = [];
            foreach ($res_body as $key => $value) {
               //Employee::create();
               DB::table('tbl_employees')->insert([$value]);
            }
            if(count(Employee::all()) > 1 ){
                return response()->json([
                    'status' => true,
                    'message'=> "Employees created"
                ]);
            }else{
                return response()->json([
                    'status' => 'failed',
                    'message'=> "Operation failed to create"
                ]);
            }
        }else{
            throw new Exception("Failed to fetch from ERP service");
        }

    }

   
    
    public function attemptLogin(Object $employee, Object  $request) : bool
    {
        return (Hash::check($request->password, $employee->password)) ? true : false;
    }

    public function logout(){
        $user= Auth::guard('sanctum')->user();
        try {
            $killedToken=$user->tokens()->delete();
            if($killedToken){
                return response()->json(['status'=> true,'message'=> 'Logout successful'],200);
            }
        } catch (Exception $e) {
            return response()->json(['status'=> false,'message'=> 'Oops! something went wrong please try again'],400);
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
        $data = $request->json()->all();
        $created = Employee::create($data);
        if($created)
            return formatAsJson(true, 'employee created', $data,200);
        return formatAsJson(false, 'Failed to create','',400);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function forgot_password(Request $request)
    {

        $input = $request->all();
        $rules = array(
            'email' => "required|email",
        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
        } else {
            try {
                $response = Password::sendResetLink($request->only('email'), function (Message $message) {
                    $message->subject($this->getEmailSubject());
                });
                switch ($response) {
                    case Password::RESET_LINK_SENT:
                        return \Response::json(array("status" => 200, "message" => trans($response), "data" => array()));
                    case Password::INVALID_USER:
                        return \Response::json(array("status" => 400, "message" => trans($response), "data" => array()));
                }
            } catch (\Swift_TransportException $ex) {
                $arr = array("status" => 400, "message" => $ex->getMessage(), "data" => []);
            } catch (Exception $ex) {
                $arr = array("status" => 400, "message" => $ex->getMessage(), "data" => []);
            }
        }
        return \Response::json($arr);
    }

    public function testmail()
    {
        // You can modify the timeout using the second parameter. Default is 15.
        $handler = new ZeroBounce('162eec4d19724118afcd92844c77e005', 30);

        $email = new Email(
            // The email address you want to check
            'akaigbokwelaurence@gmail.com', //'123.123.123.123'
        );

        try {

            // Validate the email
            $result = $handler->validateEmail($email);
            
            if ($result->getStatus() === Result::STATUS_VALID) {
                
                // All good
                echo "email is good";
                
                if ($result->isFreeEmail()) {
                    
                    echo "<br/>";
                    echo "Email is free";
                    // Email address is free, such as @gmail.com, @hotmail.com.
                    
                }else{
                    return "email is invalid";
                }
                
                /**
                * The user object contains metadata about the email address
                * supplied by ZeroBounce. All of these may be null or empty
                * strings, so remember to check for that. 
                */
                $user = $result->getUser();
                
                $user->getCountry();
                $user->getRegion();
                $user->getZipCode();
                $user->getCity();
                $user->getGender();
                $user->getFirstName();
                $user->getLastName();
                
            } else if ($result->getStatus() === Result::STATUS_DO_NOT_MAIL) {
                
                // The substatus code will help you determine the exact issue:
                
                switch ($result->getSubStatus()) {
                    
                    case Result::SUBSTATUS_DISPOSABLE:
                    case Result::SUBSTATUS_TOXIC:
                        // Toxic or disposable.
                        break;
                        
                        
                    case Result::SUBSTATUS_ROLE_BASED:
                        // admin@, helpdesk@, info@ etc; not a personal email
                        break;
                    
                    // ... and so on.
                        
                }
                
            } else if ($result->getStatus() === Result::STATUS_INVALID) {
                
                // Invalid email.
                echo "invalid email";
                
            } else if ($result->getStatus() === Result::STATUS_SPAMTRAP) {
                
                // Spam-trap.

                echo "email is spam trapped";
                
            } else if ($result->getStatus() === Result::STATUS_ABUSE) {
                
                // Abuse.
                echo "Abuse";
                
            } else if ($result->getStatus() === Result::STATUS_CATCH_ALL) {
                
                // Address is catch-all; not necessarily a private email.
                echo "address is catch all";
                
            } else if ($result->getStatus() === Result::STATUS_UNKNOWN) {
                
                // Unknown email status.
                echo "unknown email address";
               
            }
            
            /*
             * To find out how to use and react to different status and
             * substatus codes, see the ZeroBounce documentation at:
             * https://www.zerobounce.net/docs/?swift#version-2-v2
             */
        
        } catch (\nickdnk\ZeroBounce\APIError $exception) {
        
           // Something happened. Perhaps a bad API key or insufficient credit.
        
        }
        
    }

    public function bubbleSort()
    {   
        $arr = [99,18,1,52,61,2,23,65,44,7,6,34];
         
        $length = count($arr);
        $comparisons = 0;
        for($i = 0; $i <  $length; $i++) { 
            for ($j = 0; $j < $length - 1 ; $j++) { 
                $comparisons++;
                if($arr[$j] > $arr[$j+1]){
                    $tmp = $arr[$j + 1];
                    $arr[$j+1] = $arr[$j];
                    $arr[$j] = $tmp;
                }
            }
        }
        echo $comparisons."<br>";
        return $arr;
        //echo $sorted= bubbleSort($unsorted_arr)."<br>";
    
    }
}