<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Helpers\DownloadHelper;
use App\Http\Helpers\PaginateHelper;
use App\Http\Helpers\RedirectHelper;
use App\Http\Helpers\WhereHelper;
use App\Models\Auth\EmployeeStatusModel;
use Illuminate\Http\Request;

class EmployeeStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $status = EmployeeStatusModel::orderBy('id','ASC');
        $status = WhereHelper::where_array($status,['name']);
        if(isset($_GET['download'])){
            return $this->download($status);
        }
        $statuses = $status->paginate(PaginateHelper::per_page());
        $download_link = RedirectHelper::donwnload_url(); 
        return view('status.index',\compact('statuses','download_link'));
    }

    protected function download($data){
        return DownloadHelper::csv(
            [
                __('words.name')
            ],
            [
                'name'
            ],
            $data->get(),
            "status.csv"
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
        return view('status.create');
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

        $status = EmployeeStatusModel::create([
            'name' => $request->name,
        ]);
        return RedirectHelper::create_sms($status->wasRecentlyCreated,'status.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Auth\EmployeeStatusModel  $employeeStatusModel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $status = EmployeeStatusModel::where('id',$id);
        if(!$status->count()){
            return RedirectHelper::not_found();
        }

        $disabled = "disabled";
        $status = $status->get()[0];
        return view('status.edit',compact('status','disabled'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Auth\EmployeeStatusModel  $employeeStatusModel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $status = EmployeeStatusModel::where('id',$id);
        if(!$status->count()){
            return RedirectHelper::not_found();
        }
        if(isset($_GET['block'])){
            return RedirectHelper::block_user($status);
        }
        $status = $status->get()[0];
        return view('status.edit',compact('status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Auth\EmployeeStatusModel  $employeeStatusModel
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        //
        $status = EmployeeStatusModel::where('id',$id);
        if(!$status->count()){
            return RedirectHelper::not_found();
        }
        $status = $status->update([
            'name' => $request->name,
        ]);
        return RedirectHelper::update_sms($status,'status.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Auth\EmployeeStatusModel  $employeeStatusModel
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }
}
