<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\NewsRepository;
use Illuminate\Support\Facades\Storage;
use App\Entities\News;
use App\Entities\Comments;
use Illuminate\Support\Str;


/**
 * Class NewsController.
 *
 * @package namespace App\Http\Controllers;
 */
class NewsController extends Controller
{
    /**
     * @var NewsRepository
     */
    protected $repository;

    /**
     * NewsController constructor.
     *
     * @param NewsRepository $repository
     */
    public function __construct(NewsRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = $this->repository->all();
        return view('admin.news.index', compact('news'));
    }

    /**
     * Create the specified resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $news = new News();

            foreach ($data['news'] as $key => $value) 
            {
                $news[$key] = $value;
            }
       
            if ($files = $request->file('image')) 
            {
                $destinationPath = 'public/images/news';
                $profileImage = date('d-m-Y-His') . "_" . $files->getClientOriginalName();
                $path = $files->storeAs($destinationPath, $profileImage);
                $url = Storage::url($path);
                $news->img_dir_path = asset($url);
            }
            $news->num_sort = 1;
            $news->slug = Str::slug($data['news']['title_name']);
            $news->save();
            session()->flash('msg_success', trans('message.add.success'));
            return redirect(route('news.index'));
        } catch (\Exception $e) {
            session()->flash('msg_fail', trans('message.add.fail'));
            return redirect(route('news.index'));
        }
    }

    /**
     * Create the specified resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function getNewsByID(Request $request){
        try {
            $news = News::find($request->id);
            return view('admin.news.edit', compact('news'));
        } catch (\Exception $e) {
            session()->flash('msg_fail', trans('message.edit.fail'));
            return redirect(route('news.index'));
        }        
    }

    /**
     * Create the specified resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function update(Request $request)
    {
        try {
            $data = $request->all();
            $news = News::find($request->id);

            foreach ($data['news'] as $key => $value) 
            {
                $news[$key] = $value;
            }
       
            if ($files = $request->file('image')) 
            {
                $destinationPath = 'public/images/news';
                $profileImage = date('d-m-Y-His') . "_" . $files->getClientOriginalName();
                $path = $files->storeAs($destinationPath, $profileImage);
                $url = Storage::url($path);
                $news->img_dir_path = asset($url);
            }
            $news->slug = Str::slug($data['news']['title_name']);
            $news->num_sort = 1;
            $news->save();
            session()->flash('msg_success', trans('message.add.success'));
            return redirect(route('news.index'));
        } catch (\Exception $e) {
            session()->flash('msg_fail', trans('message.add.fail'));
            return redirect(route('news.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        try {
            $news = News::find($id);
            Storage::disk('public')->delete($news['img_dir_path']);
            $news->delete();
        } catch (\Exception $e) {
            session()->flash('msg_fail', trans('message.remove.fail'));
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = News::where('status', '1')->find($id);
        if($news)
        $newsTopFile = News::select('id', 'title_name', 'slug', 'meta_title', 'img_dir_path')
                                    ->where('status','1')
                                    ->orderBy('id','desc')
                                    ->take(5)
                                    ->get();
        $comments = Comments::where([['status', '=', '0'], ['post_id', '=', $news['id']]])->get();
        return view('public.news', ['news' => $news, 'newsTopFile' => $newsTopFile, 'comments' => $comments]);
    }
}
