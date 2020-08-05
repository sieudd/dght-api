<?php

namespace GGPHP\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use GGPHP\Users\Repositories\Contracts\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * UserController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * authenticated
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function authenticated(Request $request)
    {
        $user = $this->userRepository->find(Auth::id());
        return $this->success($user, trans('lang::messages.common.getInfoSuccess'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function logout(Request $request)
    {

        $request->user()->token()->revoke();

        return $this->success([], trans('lang::messages.auth.logoutSuccess'), ['isShowData' => false]);
    }
}
