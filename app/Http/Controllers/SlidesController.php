<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\SlidesCreateRequest;
use App\Http\Requests\SlidesUpdateRequest;
use App\Repositories\SlidesRepository;
use App\Entities\Slides;
use Illuminate\Support\Facades\Storage;

/**
 * Class SlidesController.
 *
 * @package namespace App\Http\Controllers;
 */
class SlidesController extends Controller
{
    /**
     * @var SlidesRepository
     */
    protected $repository;

    /**
     * SlidesController constructor.
     *
     * @param SlidesRepository $repository
     */
    public function __construct(SlidesRepository $repository)
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
        $slides = $this->repository->all();
        return view('admin.slides.index', compact('slides'));
    }

    /**
     * Create the specified resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function create(Request $request)
    {
        try {
            $data = $request->all();
            $slide = new Slides();

            foreach ($data['slide'] as $key => $value) 
            {
                $slide[$key] = $value;
            }

            if ($files = $request->file('image')) 
            {
                $destinationPath = 'public/images/slides';
                $profileImage = date('d-m-Y-His') . "_" . $files->getClientOriginalName();
                $path = $files->storeAs($destinationPath, $profileImage);
                $url = Storage::url($path);
                $slide->img_dir_path = asset($url);
            }
        
            $slide->save();
            session()->flash('msg_success', trans('message.add.success'));
            return redirect(route('slides.index'));
        } catch (\Exception $e) {
            session()->flash('msg_fail', trans('message.add.fail'));
            return redirect(route('slides.index'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SlidesUpdateRequest  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request,$id)
    {
        try {
            $data = $request->all();
            $slide = Slides::find($id);

            foreach ($data['slide'] as $key => $value) 
            {
                $slide[$key] = $value;
            }
            
            if ($files = $request->file('image')) 
            {
                Storage::disk('public')->delete($slide['img_dir_path']);
                $destinationPath = 'public/images/slides';
                $profileImage = date('d-m-Y-His') . "_" . $files->getClientOriginalName();
                $path = $files->storeAs($destinationPath, $profileImage);
                $url = Storage::url($path);
                $slide->img_dir_path = asset($url);
            }

            $slide->save();
            session()->flash('msg_success', trans('message.edit.success'));
            return redirect(route('slides.index'));
        } catch (\Exception $e) {
            session()->flash('msg_fail', trans('message.edit.fail'));
            return redirect(route('slides.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $slide = Slides::find($id);
            Storage::disk('public')->delete($slide['img_dir_path']);
            $slide->delete();
        } catch (Exception $e) {
            session()->flash('msg_fail', trans('message.remove.fail'));
            return redirect()->back();
        }

        session()->flash('msg_success', trans('message.remove.success'));
        return redirect()->back();
    }
}
