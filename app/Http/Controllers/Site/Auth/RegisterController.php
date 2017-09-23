<?php

namespace SisFin\Http\Controllers\Site\Auth;

use SisFin\Http\Controllers\Controller;
use SisFin\Http\Requests\UserRegisterRequest;
use SisFin\Repositories\Interfaces\ClientRepository;
use SisFin\Repositories\Interfaces\UserRepository;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var ClientRepository
     */
    private $clientRepository;

    /**
     * RegisterController constructor.
     * @param UserRepository $userRepository
     * @param ClientRepository $clientRepository
     */
    public function __construct(UserRepository $userRepository, ClientRepository $clientRepository)
    {
        $this->userRepository = $userRepository;
        $this->clientRepository = $clientRepository;
    }

    public function create()
    {
        return view('site.auth.register');
    }

    public function store(UserRegisterRequest $request)
    {
        $clientData = $request->get('client');
        $client = $this->clientRepository->create($clientData);

        $data = $request->except('client');
        $data['client_id'] = $client->id;
        $user = $this->userRepository->create($data);

        Auth::loginUsingId($user->id);
        return redirect()->route('site.subscriptions.create');
    }
}