<?php

namespace App\Http\Controllers\Helpers;

use App\Http\Controllers\Controller;
use App\Http\Helpers\DownloadHelper;
use App\Http\Helpers\PaginateHelper;
use App\Http\Helpers\RedirectHelper;
use App\Http\Helpers\WhereHelper;
use App\Models\Helpers\VariableModel;
use Illuminate\Http\Request;

class VariableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $variable = VariableModel::orderBy('id','ASC');
        $variable = WhereHelper::where_array($variable,['name']);
        if(isset($_GET['download'])){
            return $this->download($variable);
        }
        $variables = $variable->paginate(PaginateHelper::per_page());
        $download_link = RedirectHelper::donwnload_url(); 
        return view('variable.index',\compact('variables','download_link'));
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
            "Variable.csv"
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
        return view('variable.create');
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

        $variable = VariableModel::create([
            'name' => $request->name,
            'body' => $request->body,
        ]);
        return RedirectHelper::create_sms($variable->wasRecentlyCreated,'variable.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Auth\VariableModel  $variableModel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $variable = VariableModel::where('id',$id);
        if(!$variable->count()){
            return RedirectHelper::not_found();
        }

        $disabled = "disabled";
        $variable = $variable->get()[0];
        return view('variable.edit',compact('variable','disabled'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Auth\VariableModel  $variableModel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $variable = VariableModel::where('id',$id);
        if(!$variable->count()){
            return RedirectHelper::not_found();
        }
        if(isset($_GET['block'])){
            return RedirectHelper::block_user($variable);
        }
        $variable = $variable->get()[0];
        return view('variable.edit',compact('variable'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Auth\VariableModel  $variableModel
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        //
        $variable = VariableModel::where('id',$id);
        if(!$variable->count()){
            return RedirectHelper::not_found();
        }
        $variable = $variable->update([
            'name' => $request->name,
            'body' => $request->body,
        ]);
        return RedirectHelper::update_sms($variable,'variable.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Auth\VariableModel  $variableModel
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }
}
