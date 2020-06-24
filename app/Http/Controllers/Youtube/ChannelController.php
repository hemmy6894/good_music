<?php

namespace App\Http\Controllers\Youtube;

use App\Http\Controllers\Controller;
use App\Http\Helpers\RedirectHelper;
use App\Models\Youtube\ChannelModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChannelController extends Controller
{
    protected $model = ChannelModel::class;
    protected $carries = 'channel';
    protected $package = 'youtube';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $channels = $this->model::paginate();
        return view($this->package.'.channel.index',compact('channels'));
    }

    public function index_api()
    {
        //
        return $this->model::get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view($this->package.'.channel.create');
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
            'channel' => 'required',
        ]);
        $this->carries = $this->model::create([
            'channel_id' => $request->channel,
            'user_id' => Auth::user()->id,
        ]);
        return RedirectHelper::create_sms($this->carries);
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
        $channel = $this->model::where('id',$id);
        if(!$channel->count()){
            return RedirectHelper::not_found();
        }
        $channel = $channel->get()[0];
        $disabled = 'disabled';
        return view($this->package.'.channel.edit',compact('channel','disabled'));
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
        $channel = $this->model::where('id',$id);
        if(!$channel->count()){
            return RedirectHelper::not_found();
        }
        $channel = $channel->get()[0];
        return view($this->package.'.channel.edit',compact('channel'));
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
        $channel = $this->model::where('id',$id);
        if(!$channel->count()){
            return RedirectHelper::not_found();
        }
        $channel = $channel->find($id)->update([
            'channel_id' => $request->channel,
        ]);
        return RedirectHelper::update_sms($channel);
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
}
