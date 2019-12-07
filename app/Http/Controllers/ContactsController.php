<?php

namespace App\Http\Controllers;
use App\Repositories\ContactsRepository;
use App\Entities\Contacts;
use Illuminate\Http\Request;


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
     * ContactsController constructor.
     *
     * @param ContactsRepository $repository
     */
    public function __construct(ContactsRepository $repository)
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
        $contacts = $this->repository->getListContacts();

        return view('admin.contacts.index', compact('contacts'));
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
        } catch (\Exception $e) {
            session()->flash('msg_fail', trans('message.remove.fail'));
            return redirect()->back();
        }

        session()->flash('msg_success', trans('message.remove.success'));
        return redirect()->back();
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  Request [$request]
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            $data = $request->all();
            $contact = new Contacts();
            foreach($data['contact'] as $key => $value){
                $contact[$key] = $value;
            }
            $contact->save();
            return "ok";
        } catch (\Exception $e) {
            return $e;
            session()->flash('msg_fail', trans('message.add.fail'));
            return redirect()->back();
        }

        session()->flash('msg_success', trans('message.add.success'));
        return redirect()->back();
    }
}
