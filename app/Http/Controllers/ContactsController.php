<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ContactsCreateRequest;
use App\Http\Requests\ContactsUpdateRequest;
use App\Repositories\ContactsRepository;
use App\Validators\ContactsValidator;

/**
 * Class ContactsController.
 *
 * @package namespace App\Http\Controllers;
 */
class ContactsController extends Controller
{
    /**
     * @var ContactsRepository
     */
    protected $repository;

    /**
     * @var ContactsValidator
     */
    protected $validator;

    /**
     * ContactsController constructor.
     *
     * @param ContactsRepository $repository
     * @param ContactsValidator $validator
     */
    public function __construct(ContactsRepository $repository, ContactsValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $contacts = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $contacts,
            ]);
        }

        return view('contacts.index', compact('contacts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ContactsCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ContactsCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $contact = $this->repository->create($request->all());

            $response = [
                'message' => 'Contacts created.',
                'data'    => $contact->toArray(),
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
        $contact = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $contact,
            ]);
        }

        return view('contacts.show', compact('contact'));
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
        $contact = $this->repository->find($id);

        return view('contacts.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ContactsUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ContactsUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $contact = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Contacts updated.',
                'data'    => $contact->toArray(),
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
                'message' => 'Contacts deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Contacts deleted.');
    }
}
