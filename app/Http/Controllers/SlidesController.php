<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\SlidesCreateRequest;
use App\Http\Requests\SlidesUpdateRequest;
use App\Repositories\SlidesRepository;

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
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $slides = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $slides,
            ]);
        }

        return view('slides.index', compact('slides'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SlidesCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(SlidesCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $slide = $this->repository->create($request->all());

            $response = [
                'message' => 'Slides created.',
                'data'    => $slide->toArray(),
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
        $slide = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $slide,
            ]);
        }

        return view('slides.show', compact('slide'));
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
        $slide = $this->repository->find($id);

        return view('slides.edit', compact('slide'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SlidesUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(SlidesUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $slide = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Slides updated.',
                'data'    => $slide->toArray(),
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
                'message' => 'Slides deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Slides deleted.');
    }
}
