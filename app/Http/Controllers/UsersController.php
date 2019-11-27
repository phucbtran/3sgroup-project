<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\UsersCreateRequest;
use App\Http\Requests\UsersUpdateRequest;
use App\Repositories\UsersRepository;
use App\Validators\UsersValidator;
use Auth;
use App\Entities\Users;

class UsersController extends Controller
{
    protected $repository;

    protected $validator;

    public function __construct(UsersRepository $repository, UsersValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    public function index()
    {
        $users = Users::all();
        return view('admin.users.index', compact('users'));
    }

    public function create(Request $request)
    {
        try {
            $user = new Users();
            $data = $request->all();
            foreach ($data['user'] as $key => $value) {
                $user[$key] = $value;
            }
            $user->save();
            return $user;
            return redirect()->back()->with(['status'=>'true','msg'=>'Thêm thành công']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['status'=>'false','msg'=>'Thêm thất bại !']);
        }
    }


    public function show($id)
    {
        $user = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $user,
            ]);
        }

        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = $this->repository->find($id);

        return view('users.edit', compact('user'));
    }

    public function update(Request $request)
    {
        try {
            $id = $request->id;
            $user = Users::find($id);
            $data = $request->all();
            foreach ($data['user'] as $key => $value) {
                $user[$key] = $value;
            }
            $user->save();
            return redirect()->back()->with(['status'=>'true','msg'=>'Cập nhật thành công']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['status'=>'false','msg'=>'Cập nhật thất bại !']);
        }
    }

    public function destroy($id)
    {
        $deleted = Users::where('id',$id)->first();
        $deleted->delete();
        if ($deleted) {
            return redirect()->back()->with(['status'=>'success','msg'=>'Xóa thành công !']);
        }
        return redirect()->back()->with(['status'=>'false','msg'=>'Xóa thất bại !']);
    }
}
