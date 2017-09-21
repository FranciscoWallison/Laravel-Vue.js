<?php

namespace SisFin\Http\Controllers\Api;

use SisFin\Http\Controllers\Controller;
use SisFin\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use SisFin\Http\Requests\BankAccountCreateRequest;
use SisFin\Http\Requests\BankAccountUpdateRequest;
use SisFin\Repositories\BankAccountRepository;
use SisFin\Criteria\FindByNameCriteria;
use SisFin\Criteria\FindByLikeAgencyCriteria;
use Illuminate\Http\Request;


class BankAccountsController extends Controller
{

    /**
     * @var BankAccountRepository
     */
    protected $repository;

    public function __construct(BankAccountRepository $repository)
    {
        $this->repository = $repository;
    }

    public function lists()
    {
        return $this->repository->skipPresenter()->all(['id','name','account']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = (int)$request->get('limit', null);
        $limit = $limit > 0 ? $limit : null;
        return $this->repository->paginate($limit);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BankAccountCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(BankAccountCreateRequest $request)
    {
        $bankAccount = $this->repository->create($request->all());

        return response()->json($bankAccount, 201);
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
        $bankAccount = $this->repository->find($id);

        return response()->json($bankAccount);

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $bankAccount = $this->repository->find($id);

        return view('bankAccounts.edit', compact('bankAccount'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  BankAccountUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(BankAccountUpdateRequest $request, $id)
    {
        $bankAccount = $this->repository->update($request->all(), $id);

        return response()->json($bankAccount);
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
        $deleted = $this->repository->delete($id);

        return response()->json([],204);
    }
}
