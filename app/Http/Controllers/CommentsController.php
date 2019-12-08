<?php

namespace App\Http\Controllers;

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
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $comments = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $comments,
            ]);
        }

        return view('comments.index', compact('comments'));
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
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $comment,
            ]);
        }

        return view('comments.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = $this->repository->find($id);

        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CommentsUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(CommentsUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $comment = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Comments updated.',
                'data'    => $comment->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
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
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Comments deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Comments deleted.');
    }
}
