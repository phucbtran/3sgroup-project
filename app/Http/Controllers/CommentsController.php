<?php

namespace App\Http\Controllers;

use http\Exception;
use Illuminate\Http\Request;

use App\Repositories\CommentsRepository;

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexCooperationComment()
    {
        $comments = $this->repository->getListComment('2');

        return view('admin.comments.cooperation', compact('comments'));
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
}
