<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Helpers\DownloadHelper;
use App\Http\Helpers\PaginateHelper;
use App\Http\Helpers\RedirectHelper;
use App\Http\Helpers\WhereHelper;
use App\Models\Auth\RoleModel;
use App\Models\Auth\UserRoleModel;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $role = RoleModel::orderBy('id','ASC');
        $role = WhereHelper::where_array($role,['role_name']);
        if(isset($_GET['download'])){
            return $this->download($role);
        }
        $roles = $role->paginate(PaginateHelper::per_page());
        $download_link = RedirectHelper::donwnload_url(); 
        return view('role.index',\compact('roles','download_link'));
    }

    protected function download($data){
        return DownloadHelper::csv(
            [
                __('words.name')
            ],
            [
                'role_name'
            ],
            $data->get(),
            "role.csv"
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'name' => 'required'
        ]);

        $role = RoleModel::create([
            'role_name' => $request->name,
        ]);
        return RedirectHelper::create_sms($role->wasRecentlyCreated,'role.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Auth\RoleModel  $roleModel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $role = RoleModel::where('id',$id);
        if(!$role->count()){
            return RedirectHelper::not_found();
        }

        $disabled = "disabled";
        $role = $role->get()[0];
        return view('role.edit',compact('role','disabled'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Auth\RoleModel  $roleModel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $role = RoleModel::where('id',$id);
        if(!$role->count()){
            return RedirectHelper::not_found();
        }
        if(isset($_GET['block'])){
            return RedirectHelper::block_user($role);
        }
        $role = $role->get()[0];
        return view('role.edit',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Auth\RoleModel  $roleModel
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        //
        $role = RoleModel::where('id',$id);
        if(!$role->count()){
            return RedirectHelper::not_found();
        }
        $role = $role->update([
            'role_name' => $request->name,
        ]);
        return RedirectHelper::update_sms($role,'role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Auth\RoleModel  $roleModel
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }

    public function display_roles(){
        return view('settings.roles.index');
    }

    public function populate_roles(){
        $data['modelRoles'] = UserRoleModel::user_per_role();
        return view('settings.roles.roles',$data);
    }

    public function change_roles(Request $request){
        $rid = $request->rid;
        $break_down_rid = explode('-',$rid);
        $role = $break_down_rid[1];
        $function_name = $break_down_rid[0];
        $status = $request->status;

        if(UserRoleModel::where('rid','=',$rid)->count()){
            UserRoleModel::where('rid','=',$rid)->update(['status' => $status]);
        }else{
            UserRoleModel::create(
                [
                    'rid' => $rid,
                    'role' => $role,
                    'function_name' => $function_name,
                    'status' => $status
                ]
            );
        }
    }
}
