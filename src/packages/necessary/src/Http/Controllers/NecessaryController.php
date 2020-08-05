<?php

namespace GGPHP\Necessary\Http\Controllers;

use GGPHP\Core\Http\Controllers\Controller;
use GGPHP\Necessary\Http\Requests\NecessaryCreateRequest;
use GGPHP\Necessary\Http\Requests\NecessaryUpdateRequest;
use GGPHP\Necessary\Repositories\Contracts\NecessaryRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NecessaryController extends Controller
{
    /**
     * @var $necessaryRepository
     */
    protected $necessaryRepository;

    /**
     * UserController constructor.
     * @param NecessaryRepository $necessaryRepository
     */
    public function __construct(NecessaryRepository $necessaryRepository)
    {
        $this->necessaryRepository = $necessaryRepository;
    }

    /**
     * Store a newly created resoucre in storage
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(NecessaryCreateRequest $request)
    {
        $necessary = $this->necessaryRepository->create($request->all());

        return $this->success($necessary, trans('lang::messages.common.createSuccess'), ['code' => Response::HTTP_CREATED]);
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
        $necessary = $this->necessaryRepository->find($id);

        return $this->success($necessary, trans('lang::messages.common.getInfoSuccess'));
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
            $necessary = $this->necessaryRepository->all();
        } else {
            $necessary = $this->necessaryRepository->paginate($limit);
        }

        return $this->success($necessary, trans('lang::messages.common.getListSuccess'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  string $id
     *
     * @return Response
     */
    public function update(NecessaryUpdateRequest $request, $id)
    {
        $necessary = $this->necessaryRepository->update($request->all(), $id);

        return $this->success($necessary, trans('lang::messages.common.modifySuccess'));
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
        $this->necessaryRepository->delete($id);

        return $this->success([], trans('lang::messages.common.deleteSuccess'), ['code' => Response::HTTP_NO_CONTENT, 'isShowData' => false]);
    }

}
