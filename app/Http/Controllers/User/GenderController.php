<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Helpers\DownloadHelper;
use App\Http\Helpers\PaginateHelper;
use App\Http\Helpers\RedirectHelper;
use App\Http\Helpers\WhereHelper;
use App\Models\Auth\GenderModel;
use Illuminate\Http\Request;

class GenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $gender = GenderModel::orderBy('id','ASC');
        $gender = WhereHelper::where_array($gender,['name']);
        if(isset($_GET['download'])){
            return $this->download($gender);
        }
        $genders = $gender->paginate(PaginateHelper::per_page());
        $download_link = RedirectHelper::donwnload_url(); 
        return view('gender.index',\compact('genders','download_link'));
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
            "gender.csv"
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
        return view('gender.create');
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

        $gender = GenderModel::create([
            'name' => $request->name,
        ]);
        return RedirectHelper::create_sms($gender->wasRecentlyCreated,'gender.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Auth\GenderModel  $GenderModel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $gender = GenderModel::where('id',$id);
        if(!$gender->count()){
            return RedirectHelper::not_found();
        }

        $disabled = "disabled";
        $gender = $gender->get()[0];
        return view('gender.edit',compact('gender','disabled'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Auth\GenderModel  $GenderModel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $gender = GenderModel::where('id',$id);
        if(!$gender->count()){
            return RedirectHelper::not_found();
        }
        if(isset($_GET['block'])){
            return RedirectHelper::block_user($gender);
        }
        $gender = $gender->get()[0];
        return view('gender.edit',compact('gender'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Auth\GenderModel  $GenderModel
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        //
        $gender = GenderModel::where('id',$id);
        if(!$gender->count()){
            return RedirectHelper::not_found();
        }
        $gender = $gender->update([
            'name' => $request->name,
        ]);
        return RedirectHelper::update_sms($gender,'gender.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Auth\GenderModel  $GenderModel
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }
}
