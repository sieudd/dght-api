<?php

namespace GGPHP\Request\Http\Controllers;

use GGPHP\Core\Http\Controllers\Controller;
use GGPHP\Request\Http\Requests\RequestCreateRequest;
use GGPHP\Request\Http\Requests\RequestUpdateRequest;
use GGPHP\Request\Repositories\Contracts\RequestRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RequestController extends Controller
{
    /**
     * @var $requestRepository
     */
    protected $requestRepository;

    /**
     * UserController constructor.
     * @param RequestRepository $requestRepository
     */
    public function __construct(RequestRepository $requestRepository)
    {
        $this->requestRepository = $requestRepository;
    }

    /**
     * Store a newly created resoucre in storage
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestCreateRequest $request)
    {
        $request = $this->requestRepository->create($request->all());

        return $this->success($request, trans('lang::messages.common.createSuccess'), ['code' => Response::HTTP_CREATED]);
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
        $request = $this->requestRepository->find($id);

        return $this->success($request, trans('lang::messages.common.getInfoSuccess'));
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
            $request = $this->requestRepository->all();
        } else {
            $request = $this->requestRepository->paginate($limit);
        }

        return $this->success($request, trans('lang::messages.common.getListSuccess'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  string $id
     *
     * @return Response
     */
    public function update(RequestUpdateRequest $request, $id)
    {
        $request = $this->requestRepository->update($request->all(), $id);

        return $this->success($request, trans('lang::messages.common.modifySuccess'));
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
        $this->requestRepository->delete($id);

        return $this->success([], trans('lang::messages.common.deleteSuccess'), ['code' => Response::HTTP_NO_CONTENT, 'isShowData' => false]);
    }

}
