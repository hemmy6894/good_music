<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Helpers\DownloadHelper;
use App\Http\Helpers\PaginateHelper;
use App\Http\Helpers\RedirectHelper;
use App\Http\Helpers\WhereHelper;
use App\Models\Auth\FunctionModel;
use Illuminate\Http\Request;

class FunctionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Function = FunctionModel::orderBy('id','ASC');
        $Function = WhereHelper::where_array($Function,['function_name']);
        if(isset($_GET['download'])){
            return $this->download($Function);
        }
        $functions = $Function->paginate(PaginateHelper::per_page());
        $download_link = RedirectHelper::donwnload_url(); 
        return view('function.index',\compact('functions','download_link'));
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
            "function.csv"
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
        return view('function.create');
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
        
        foreach(explode(',',$request->name) as $name){
            $function = FunctionModel::create([
                'function_name' => $name,
            ]);
        }
        return RedirectHelper::create_sms($function->wasRecentlyCreated,'function.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Auth\FunctionModel  $FunctionModel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $Function = FunctionModel::where('id',$id);
        if(!$Function->count()){
            return RedirectHelper::not_found();
        }

        $disabled = "disabled";
        $Function = $Function->get()[0];
        return view('function.edit',compact('function','disabled'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Auth\FunctionModel  $FunctionModel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $Function = FunctionModel::where('id',$id);
        if(!$Function->count()){
            return RedirectHelper::not_found();
        }
        if(isset($_GET['block'])){
            return RedirectHelper::block_user($Function);
        }
        $function = $Function->get()[0];
        return view('function.edit',compact('function'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Auth\FunctionModel  $FunctionModel
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        //
        $Function = FunctionModel::where('id',$id);
        if(!$Function->count()){
            return RedirectHelper::not_found();
        }
        $Function = $Function->update([
            'function_name' => $request->name,
        ]);
        return RedirectHelper::update_sms($Function,'function.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Auth\FunctionModel  $FunctionModel
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }
}
