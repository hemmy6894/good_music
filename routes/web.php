<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::middleware(
        [
            'auth',
            'blocked'
        ]
    )->group(function(){
    Route::get('/home', 'HomeController@index')->name('home');
    // Route::post('/register_user', 'Auth\RegisterController@store')->name('register_user');
    // Route::get('/user_create', 'Auth\RegisterController@create')->name('user_create');
    // Route::get('/user_edit/{id}', 'Auth\RegisterController@edit')->name('user_edit');
    // Route::get('/user_show/{id}', 'Auth\RegisterController@show')->name('user_show');
    // Route::put('/user_update/{id}', 'Auth\RegisterController@update')->name('user_update');

    Route::resources(
        [
            'user' => 'Auth\RegisterController',
            'department' => 'User\DepartmentController',
            'status' => 'User\EmployeeStatusController',
            'gender' => 'User\GenderController',
            'role' => 'User\RoleController',
            'function' => 'User\FunctionController',
            'variable' => 'Helpers\VariableController',
            'video' => 'Youtube\VideoController',
            'channel' => 'Youtube\ChannelController',
        ]
    );

    ///Roles Routes
    Route::get('/roles_settings', 'User\RoleController@display_roles')->name('roles_settings');
    Route::get('/populate_roles', 'User\RoleController@populate_roles')->name('populate_roles');
    Route::post('/change_roles', 'User\RoleController@change_roles')->name('change_roles');


    Route::get('clear_pending_mail','ClearMailController@index')->name('clear_pending_mail');
});

use App\Models\Auth\UserRoleModel;
View::composer(["*"], function($view){
    $roles = UserRoleModel::roles();

    ////Notifications
    $months = array(
                    1 => "January",
                    2 => "February",
                    3 => "March",
                    4 => "April",
                    5 => "May",
                    6 => "June",
                    7 => "July",
                    8 => "August",
                    9 => "September",
                    10 => "October",
                    11 => "November",
                    12 => "December"
                );

    $months_short = array(
                    1 => "Jan",
                    2 => "Feb",
                    3 => "Mar",
                    4 => "Apr",
                    5 => "May",
                    6 => "Jun",
                    7 => "Jul",
                    8 => "Aug",
                    9 => "Sep",
                    10 => "Oct",
                    11 => "Nov",
                    12 => "Dec"
                );      

    $call_model_sms = function($header,$body,$type){
        ?>
            <script type="text/javascript">
                $(document).ready(function(){
                    call_model("<?=$header;?>", "<?=$body;?>", "<?=$type;?>");

                    function call_model(title, body, type){
                        $("#errorModelButton").click();
                        $("#largeModalLabel").html(title);
                        $("#body_sms").html(body);
                        $("#body_sms").addClass('alert alert-'+type);
                    }
                });
            </script>
        <?php
    };

    $name = Route::currentRouteName();
    $validation = false;
    if(array_key_exists($name,$roles)){
        if(!$roles[$name] == 1){
            $validation = true;
        }
    }else{
        $validation = true;
    }
    if($name == "home"){
        $validation = false;
        $name = "dashboard";
    }
    $view->with([
                'view_months' => $months, 
                'view_months_short' => $months_short, 
                'call_model_sms' => $call_model_sms,
                'navigation' => $roles, 
                'authorization' => $validation, 
                'page_name' => $name, 
                'date_viewer' => function($date){
                                    $date = date_create($date);
                                    return date_format($date ,'d/m/Y');
                                },
                'money_view' => function($money){
                        if(!is_numeric($money)){
                            $money = "NuN";
                        }else{
                            $money = number_format($money);
                        }
                        return $money;
                    },
                'color' => function($color){
                        $bg = "white";
                        if($color == "" || $color == "white"){
                            $bg = "black";
                        }
                        return "background:$color;color:$bg;";
                    }
                ]);
});
