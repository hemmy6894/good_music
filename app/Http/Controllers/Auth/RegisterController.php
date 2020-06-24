<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Helpers\DownloadHelper;
use App\Http\Helpers\PaginateHelper;
use App\Http\Helpers\RedirectHelper;
use App\Http\Helpers\WhereHelper;
use App\Models\Auth\DepartmentModel;
use App\Models\Auth\EmployeeStatusModel;
use App\Models\Auth\GenderModel;
use App\Models\Auth\RoleModel;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use BPDF as PDF;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
    }

    public function index(){
        $users = User::orderBy('id','ASC');
        $users = WhereHelper::where_array($users,['lname','fname','sname','national_id']);
        if(isset($_GET['download'])){
            return $this->download($users);
        }

        if(isset($_GET['payslip'])){
            $pdf = PDF::loadView('pages.payslip');
            return $pdf->stream();
        }
        $users = $users->paginate(PaginateHelper::per_page(2));
        $download_link = RedirectHelper::donwnload_url(); 
        $payslip = RedirectHelper::payslip(); 
        return view('settings.user.index',compact('users','download_link','payslip'));
    }

    protected function download($users){
        return DownloadHelper::csv(
            [
                __('words.name'),
                __('words.email'),
                __('words.department'),
            ],
            [
                'fname,lname,sname',
                'email',
                ['departments','name'],
            ],
            $users->get(),
            "users.csv"
        );
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'surnname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $request)
    {
        $departments = DepartmentModel::active()->get();
        $genders = GenderModel::active()->get();
        $statuses = EmployeeStatusModel::active()->get();
        $roles = RoleModel::active()->get();
        return view('settings.user.create',compact('departments','genders','statuses','roles'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function store(Request $request)
    {
        $this->validate($request,[
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'gender' => ['required', 'string'],
            'department' => ['required', 'string'],
            'status' => ['required', 'string'],
            'role' => ['required', 'string'],
        ]);
        $data = $request->all();
        $user = User::create([
            'fname' => $data['first_name'],
            'lname' => $data['last_name'],
            'sname' => $data['surname'],
            'email' => $data['email'],
            'gender' => $data['gender'],
            'department_id' => $data['department'],
            'employee_status' => $data['status'],
            'roles' => $data['role'],
            'password' => Hash::make($data['password']),
        ]);
       return RedirectHelper::create_sms($user->wasRecentlyCreated);
    }

    public function show($id){
        $user = User::where('id',$id);
        if(!$user->count()){
            return RedirectHelper::not_found();
        }

        //die($user->get());
        $disabled = "disabled";
        $departments = DepartmentModel::all();
        $genders = GenderModel::all();
        $statuses = EmployeeStatusModel::all();
        $roles = RoleModel::all();
        $user = $user->get()[0];
        return view('settings.user.show',compact('user','departments','genders','statuses','roles','disabled'));
    }


    public function edit($id){
        $user = User::where('id',$id);
        if(!$user->count()){
            return RedirectHelper::not_found();
        }

        if(isset($_GET['block'])){
            return $this->block_user($user);
        }
        
        //die($user->get());
        $departments = DepartmentModel::all();
        $genders = GenderModel::all();
        $statuses = EmployeeStatusModel::all();
        $roles = RoleModel::all();
        $user = $user->get()[0];
        return view('settings.user.edit',compact('user','departments','genders','statuses','roles'));
    }

    protected function block_user($user){
        if(!empty($_GET['block'])){
            $block = $_GET['block'];
            if($block){
                $block = 0;
            }else{
                $block = 1;
            }
        }else{
            $block = 1; 
        }
        $user->update(['status' => $block]);
        if($block){
            $sms = __('words.successfull_blocked');
        }else{
            $sms = __('words.successfull_unblocked');
        }
        return RedirectHelper::back_error($sms,__('words.successfully'),'success');
    }

    protected function update($id,Request $request)
    {
        $user = User::where('id',$id);
        if(!$user->count()){
            return RedirectHelper::not_found();
        }
        $data = $request->all();
        if(isset($_GET['ids'])){
            $user = $user->update(
                [
                    'employee_no' => $request->employee_no,
                    'pension_no' => $request->pension_no,
                    'national_id' => $request->national_id,
                    'joined_date' => $request->joined_date,
                ]
            );
        }else if(isset($_GET['bank'])){
            $basic = str_replace(',','',$request->basic_salary);
            if(!is_numeric($basic)){
                return RedirectHelper::back_error(__('words.not_numeric'),__('words.failed'),'danger');
            }
            $user = $user->update(
                [
                    'bank_name' => $request->bank_name,
                    'account_name' => $request->account_name,
                    'account_no' => $request->account_no,
                    'basic_salary' => $basic
                ]
            );
        }else{
            $this->validate($request,[
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'surname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'gender' => ['required', 'string'],
                'department' => ['required', 'string'],
                'status' => ['required', 'string'],
                'role' => ['required', 'string'],
            ]);
            $user = $user->update(
                [
                    'fname' => $data['first_name'],
                    'lname' => $data['last_name'],
                    'sname' => $data['surname'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'dob' => $data['dob'],
                    'post_address' => $data['post_address'],
                    'gender' => $data['gender'],
                    'department_id' => $data['department'],
                    'employee_status' => $data['status'],
                    'roles' => $data['role'],
                    //'password' => Hash::make($data['password']),
                ]
            );
        }
       return RedirectHelper::update_sms($user);
    }
}
