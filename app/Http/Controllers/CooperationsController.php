<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\CooperationsCreateRequest;
use App\Http\Requests\CooperationsUpdateRequest;
use App\Repositories\CooperationsRepository;

/**
 * Class CooperationsController.
 *
 * @package namespace App\Http\Controllers;
 */
class CooperationsController extends Controller
{
    /**
     * @var CooperationsRepository
     */
    protected $repository;

    /**
     * CooperationsController constructor.
     *
     * @param CooperationsRepository $repository
     */
    public function __construct(CooperationsRepository $repository)
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
        $cooperations = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $cooperations,
            ]);
        }

        return view('cooperations.index', compact('cooperations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CooperationsCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(CooperationsCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $cooperation = $this->repository->create($request->all());

            $response = [
                'message' => 'Cooperations created.',
                'data'    => $cooperation->toArray(),
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
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cooperation = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $cooperation,
            ]);
        }

        return view('cooperations.show', compact('cooperation'));
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
        $cooperation = $this->repository->find($id);

        return view('cooperations.edit', compact('cooperation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CooperationsUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(CooperationsUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $cooperation = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Cooperations updated.',
                'data'    => $cooperation->toArray(),
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
                'message' => 'Cooperations deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Cooperations deleted.');
    }
}
