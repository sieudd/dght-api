<?php

namespace GGPHP\Contribute\Http\Controllers;

use GGPHP\Contribute\Http\Requests\ContributeCreateRequest;
use GGPHP\Contribute\Http\Requests\ContributeUpdateRequest;
use GGPHP\Contribute\Repositories\Contracts\ContributeRepository;
use GGPHP\Core\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContributeController extends Controller
{
    /**
     * @var $contributeRepository
     */
    protected $contributeRepository;

    /**
     * UserController constructor.
     * @param ContributeRepository $contributeRepository
     */
    public function __construct(ContributeRepository $contributeRepository)
    {
        $this->contributeRepository = $contributeRepository;
    }

    /**
     * Store a newly created resoucre in storage
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContributeCreateRequest $request)
    {
        $contribute = $this->contributeRepository->create($request->all());

        return $this->success($contribute, trans('lang::messages.common.createSuccess'), ['code' => Response::HTTP_CREATED]);
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
        $contribute = $this->contributeRepository->find($id);

        return $this->success($contribute, trans('lang::messages.common.getInfoSuccess'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = config('constants.SEARCH_VALUES_DEFAULT.LIMIT');
        if ($request->has('limit')) {
            $limit = $request->limit;
        }

        if ($limit == config('constants.SEARCH_VALUES_DEFAULT.LIMIT_ZERO')) {
            $contribute = $this->contributeRepository->all();
        } else {
            $contribute = $this->contributeRepository->paginate($limit);
        }

        return $this->success($contribute, trans('lang::messages.common.getListSuccess'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  string $id
     *
     * @return Response
     */
    public function update(ContributeUpdateRequest $request, $id)
    {
        $contribute = $this->contributeRepository->update($request->all(), $id);

        return $this->success($contribute, trans('lang::messages.common.modifySuccess'));
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
        $this->contributeRepository->delete($id);

        return $this->success([], trans('lang::messages.common.deleteSuccess'), ['code' => Response::HTTP_NO_CONTENT, 'isShowData' => false]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function approval($id, Request $request)
    {
        $contribute = $this->contributeRepository->approval($id, $request->all());

        return $this->success($contribute, trans('lang::messages.common.modifySuccess'));
    }

}
