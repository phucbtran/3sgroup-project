<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\CompanyCreateRequest;
use App\Http\Requests\CompanyOverviewRequest;
use App\Repositories\CompanyRepository;

/**
 * Class CompaniesController.
 *
 * @package namespace App\Http\Controllers;
 */
class CompaniesController extends Controller
{
    /**
     * @var CompanyRepository
     */
    protected $repository;

    /**
     * CompaniesController constructor.
     *
     * @param CompanyRepository $repository
     */
    public function __construct(CompanyRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function overview()
    {
        $company = $this->repository->first();

        if ($indexNameLogo = strrpos($company->logo_dir_path, '/')) {
            $company->logo_name = substr($company->logo_dir_path, $indexNameLogo + 1);
        }

        if ($indexNameDetail = strrpos($company->img_detail_dir_path, '/')) {
            $company->img_detail_name = substr($company->img_detail_dir_path, $indexNameDetail + 1);
        }

        return view('admin.company.overview', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CompanyOverviewRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function overviewUpdate(CompanyOverviewRequest $request, $id)
    {
        dd($request);
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
