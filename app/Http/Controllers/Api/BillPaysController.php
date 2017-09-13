<?php

namespace CodeFin\Http\Controllers\Api;

use Illuminate\Http\Request;

use CodeFin\Http\Controllers\Controller;
use CodeFin\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use CodeFin\Http\Requests\BillPaysCreateRequest;
use CodeFin\Http\Requests\BillPaysUpdateRequest;
use CodeFin\Repositories\BillPayRepository;
use CodeFin\Criteria\FindByNameCriteria;
use CodeFin\Criteria\FindByLikeAgencyCriteria;


class BillPaysController extends Controller
{

    /**
     * @var BillPayRepository
     */
    protected $repository;

    public function __construct(BillPayRepository $repository)
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
        // $this->repository->pushCriteria(new FindByNameCriteria('New Josefina'))
        //                 ->pushCriteria(new FindByLikeAgencyCriteria(4));
        $billPays = $this->repository->paginate(3);

        return  $billPays;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BillPaysCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(BillPaysCreateRequest $request)
    {
        $billPay = $this->repository->create($request->all());

        return response()->json($billPay, 201);
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
        $billPay = $this->repository->find($id);

        return response()->json($billPay);

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

        $billPay = $this->repository->find($id);

        return view('billPays.edit', compact('billPay'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  BillPayUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(BillPayUpdateRequest $request, $id)
    {
        $billPay = $this->repository->update($request->all(), $id);

        return response()->json($billPay);
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
