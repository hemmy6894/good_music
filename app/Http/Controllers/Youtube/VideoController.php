<?php

namespace App\Http\Controllers\Youtube;

use App\Http\Controllers\Controller;
use App\Http\Helpers\RedirectHelper;
use App\Models\Youtube\VideoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    protected $model = VideoModel::class;
    protected $carries = 'video';
    protected $package = 'youtube';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $videos = $this->model::paginate();
        return view($this->package.'.video.index',compact('videos'));
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
        return view($this->package.'.video.create');
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
            'video' => 'required',
        ]);
        $this->carries = $this->model::create([
            'video_id' => $request->video,
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
        $video = $this->model::where('id',$id);
        if(!$video->count()){
            return RedirectHelper::not_found();
        }
        $video = $video->get()[0];
        $disabled = 'disabled';
        return view($this->package.'.video.edit',compact('video','disabled'));
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
        $video = $this->model::where('id',$id);
        if(!$video->count()){
            return RedirectHelper::not_found();
        }
        $video = $video->get()[0];
        return view($this->package.'.video.edit',compact('video'));
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
        $video = $this->model::where('id',$id);
        if(!$video->count()){
            return RedirectHelper::not_found();
        }
        $video = $video->find($id)->update([
            'video_id' => $request->video,
        ]);
        return RedirectHelper::update_sms($video);
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
