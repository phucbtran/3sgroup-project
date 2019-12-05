<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ImgActivitiesCreateRequest;
use App\Http\Requests\ImgActivitiesUpdateRequest;
use App\Repositories\ImgActivitiesRepository;

/**
 * Class ImgActivitiesController.
 *
 * @package namespace App\Http\Controllers;
 */
class ImgActivitiesController extends Controller
{
    /**
     * @var ImgActivitiesRepository
     */
    protected $repository;

    /**
     * ImgActivitiesController constructor.
     *
     * @param ImgActivitiesRepository $repository
     */
    public function __construct(ImgActivitiesRepository $repository)
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
        $imgActivities = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $imgActivities,
            ]);
        }

        return view('imgActivities.index', compact('imgActivities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ImgActivitiesCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ImgActivitiesCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $imgActivity = $this->repository->create($request->all());

            $response = [
                'message' => 'ImgActivities created.',
                'data'    => $imgActivity->toArray(),
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
        $imgActivity = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $imgActivity,
            ]);
        }

        return view('imgActivities.show', compact('imgActivity'));
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
        $imgActivity = $this->repository->find($id);

        return view('imgActivities.edit', compact('imgActivity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ImgActivitiesUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ImgActivitiesUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $imgActivity = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'ImgActivities updated.',
                'data'    => $imgActivity->toArray(),
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
                'message' => 'ImgActivities deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'ImgActivities deleted.');
    }
}
