<?php

namespace App\Http\Controllers;

use http\Exception;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UsersCreateRequest;
use App\Http\Requests\UsersUpdateRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Repositories\UsersRepository;
use App\Entities\Users;

class UsersController extends Controller
{
    /**
     * @var UsersRepository
     */
    protected $usersRepository;

    /**
     * UsersController constructor.
     *
     * @param UsersRepository $usersRepository
     */
    public function __construct(UsersRepository $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->usersRepository->all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UsersCreateRequest  $request
     * @return Response
     */
    public function create(UsersCreateRequest $request)
    {
        try {
            $password = bcrypt($request->password);
            $request->offsetSet('password', $password);
            $this->usersRepository->create($request->except('id'));

            session()->flash('msg_success', trans('message.add.success'));
            return redirect(route('user.index'));
        } catch (\Exception $e) {
            session()->flash('msg_fail', trans('message.add.fail'));
            return redirect(route('user.index'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UsersUpdateRequest  $request
     * @param  int  $id
     * @return Response
     */
    public function update(UsersUpdateRequest $request, $id)
    {
        try {
            if (empty($request->password)) {
                $this->usersRepository->update($request->except('id', 'password'), $id);
            } else {
                $password = bcrypt($request->password);
                $request->offsetSet('password', $password);
                $this->usersRepository->update($request->except('id'), $id);
            }
            session()->flash('msg_success', trans('message.edit.success'));
            return redirect(route('user.index'));
        } catch (\Exception $e) {
            session()->flash('msg_fail', trans('message.edit.fail'));
            return redirect(route('user.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $this->usersRepository->delete($id);
        } catch (Exception $e) {
            session()->flash('msg_fail', trans('message.remove.fail'));
            return redirect()->back();
        }

        session()->flash('msg_success', trans('message.remove.success'));
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProfileUpdateRequest  $request
     * @return Response
     */
    public function updateProfile(ProfileUpdateRequest $request)
    {
        try {
            $id = Auth::id();
            if (empty($request->password)) {
                $this->usersRepository->update($request->only('full_name'), $id);
            } else {
                $password = bcrypt($request->password);
                $request->offsetSet('password', $password);
                $this->usersRepository->update($request->only('full_name', 'password'), $id);
            }
            session()->flash('msg_success', trans('message.edit.success'));
            return redirect()->back();
        } catch (\Exception $e) {
            session()->flash('msg_fail', trans('message.edit.fail'));
            return redirect()->back();
        }
    }
}
