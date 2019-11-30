<?php

namespace App\Http\Controllers;

use http\Exception;

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
        $contacts = $this->repository->getListContacts();
        $title = 'Liên hệ';

        return view('admin.contacts.index', compact('contacts', 'title'));
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
