<?php

namespace App\Http\Controllers;

use http\Exception;
use Illuminate\Http\Request;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\CommentsCreateRequest;
use App\Http\Requests\CommentsUpdateRequest;
use App\Repositories\CommentsRepository;
use App\Entities\Comments;

/**
 * Class CommentsController.
 *
 * @package namespace App\Http\Controllers;
 */
class CommentsController extends Controller
{
    /**
     * @var CommentsRepository
     */
    protected $repository;

    /**
     * CommentsController constructor.
     *
     * @param CommentsRepository $repository
     */
    public function __construct(CommentsRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexProductComment()
    {
        $comments = $this->repository->getListComment('0');

        return view('admin.comments.product', compact('comments'));
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
            $comment = new Comments();

            foreach ($data['comment'] as $key => $value) 
            {
                $comment[$key] = $value;
            }
            $comment['status'] = 1;
            $comment->save();
            session()->flash('msg_success', trans('message.add.success'));
            return redirect()->back();
        } catch (\Exception $e) {
            session()->flash('msg_fail', trans('message.add.fail'));
            return redirect()->back();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexNewComment()
    {
        $comments = $this->repository->getListComment('1');

        return view('admin.comments.new', compact('comments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {
        try {
            $this->repository->update($request->only('status'), $id);
        } catch (Exception $e) {
            return response(['msg' => 'fail']);
        }
        return response(['msg' => 'success']);
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
            $this->repository->delete($id);
        } catch (Exception $e) {
            session()->flash('msg_fail', trans('message.remove.fail'));
            return redirect()->back();
        }

        session()->flash('msg_success', trans('message.remove.success'));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroyAll(Request $request)
    {
        try {
            $this->repository->deleteList($request->id);
        } catch (Exception $e) {
            session()->flash('msg_fail', trans('message.remove.fail'));
            return redirect()->back();
        }

        session()->flash('msg_success', trans('message.remove.success'));
        return redirect()->back();
    }
}
