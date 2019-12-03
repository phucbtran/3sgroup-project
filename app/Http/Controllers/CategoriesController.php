<?php

namespace App\Http\Controllers;

use http\Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Requests\CategoriesCreateRequest;
use App\Http\Requests\CategoriesUpdateRequest;
use App\Repositories\CategoriesRepository;

/**
 * Class CategoriesController.
 *
 * @package namespace App\Http\Controllers;
 */
class CategoriesController extends Controller
{
    /**
     * @var CategoriesRepository
     */
    protected $repository;

    /**
     * CategoriesController constructor.
     *
     * @param CategoriesRepository $repository
     */
    public function __construct(CategoriesRepository $repository)
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
        $categories = $this->repository
            ->orderBy('group_id')
            ->orderBy('cat_parent_id')
            ->orderBy('num_sort')
            ->all()
        ;

        $parentCategories = $this->repository->findByField('cat_parent_id', null);

        return view('admin.categories.index', compact('categories', 'parentCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CategoriesCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriesCreateRequest $request)
    {
        try {
            if (empty($request->cat_parent_id)) {
                $statement = DB::select("show table status like 'categories'");
                $groupId = response()->json(['id' => $statement[0]->Auto_increment])->getData('id')['id'];
            } else {
                $groupId = $request->cat_parent_id;
            }

            $request->offsetSet('cat_parent_id', null);
            $request->offsetSet('group_id', $groupId);
            $request->offsetSet('slug', Str::slug($request->name, '-'));
            $this->repository->create($request->except('id'));

            session()->flash('msg_success', trans('message.add.success'));
            return redirect()->back();
        } catch (\Exception $e) {
            session()->flash('msg_fail', trans('message.add.fail'));
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CategoriesUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(CategoriesUpdateRequest $request, $id)
    {
        try {
            if (empty($request->cat_parent_id)) {
                $groupId = $id;
            } else {
                $groupId = $request->cat_parent_id;
            }
            $request->offsetSet('group_id', $groupId);
            $request->offsetSet('slug', Str::slug($request->name, '-'));
            $this->repository->update($request->except('id'), $id);

            session()->flash('msg_success', trans('message.edit.success'));
            return redirect()->back();
        } catch (\Exception $e) {
            session()->flash('msg_fail', trans('message.edit.fail'));
            return redirect()->back();
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
