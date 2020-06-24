<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Helpers\DownloadHelper;
use App\Http\Helpers\PaginateHelper;
use App\Http\Helpers\RedirectHelper;
use App\Http\Helpers\WhereHelper;
use App\Models\Auth\DepartmentModel;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $departments = DepartmentModel::orderBy('id','ASC');
        $departments = WhereHelper::where_array($departments,['name']);
        if(isset($_GET['download'])){
            return $this->download($departments);
        }
        $departments = $departments->paginate(PaginateHelper::per_page());
        $download_link = RedirectHelper::donwnload_url(); 
        return view('department.index',\compact('departments','download_link'));
    }

    protected function download($users){
        return DownloadHelper::csv(
            [
                __('words.department')
            ],
            [
                'name'
            ],
            $users->get(),
            "departments.csv"
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
        return view('department.create');
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

        $dept = DepartmentModel::create([
            'name' => $request->name,
        ]);
        return RedirectHelper::create_sms($dept->wasRecentlyCreated,'department.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Auth\DepartmentModel  $departmentModel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $department = DepartmentModel::where('id',$id);
        if(!$department->count()){
            return RedirectHelper::not_found();
        }

        $disabled = "disabled";
        $department = $department->get()[0];
        return view('department.edit',compact('department','disabled'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Auth\DepartmentModel  $departmentModel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $department = DepartmentModel::where('id',$id);
        if(!$department->count()){
            return RedirectHelper::not_found();
        }
        if(isset($_GET['block'])){
            return RedirectHelper::block_user($department);
        }
        $department = $department->get()[0];
        return view('department.edit',compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Auth\DepartmentModel  $departmentModel
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        //
        $department = DepartmentModel::where('id',$id);
        if(!$department->count()){
            return RedirectHelper::not_found();
        }
        $dept = $department->update([
            'name' => $request->name,
        ]);
        return RedirectHelper::update_sms($dept,'department.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Auth\DepartmentModel  $departmentModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(DepartmentModel $departmentModel)
    {
        //
    }
}
