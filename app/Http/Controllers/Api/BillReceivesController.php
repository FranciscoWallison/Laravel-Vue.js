<?php

namespace CodeFin\Http\Controllers\Api;

use Illuminate\Http\Request;

use CodeFin\Criteria\FindBetweenDateBRCriteria;
use CodeFin\Criteria\FindByValueBRCriteria;
use CodeFin\Http\Controllers\Controller;
use CodeFin\Http\Controllers\Response;
use CodeFin\Http\Requests;
use CodeFin\Http\Requests\BillReceiveRequest;
use CodeFin\Repositories\BillReceiveRepository;


class BillReceivesController extends Controller
{

    /**
     * @var BillReceiveRepository
     */
    protected $repository;

    public function __construct(BillReceiveRepository $repository)
    {
        $this->repository = $repository;
    }


     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchParam = config('repository.criteria.params.search');// pegando o parametro
        $search = $request->get($searchParam);// nome do parametro
        $this->repository
            ->pushCriteria(new FindBetweenDateBRCriteria($search, 'date_due'))
            ->pushCriteria(new FindByValueBRCriteria($search));
        $billReceives = $this->repository->paginate();

        return $billReceives;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BillReceiveRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(BillReceiveRequest $request)
    {
        $billReceive = $this->repository->skipPresenter()->create($request->all());

        $this->repository->skipPresenter(false);
        return response()->json($billReceive, 201);
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
        $billReceive = $this->repository->find($id);

        return response()->json($billReceive);

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

        $billReceive = $this->repository->find($id);

        return view('BillReceives.edit', compact('BillReceive'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  BillReceiveRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(BillReceiveRequest $request, $id)
    {
        $data = $this->repository->update($request->all(), $id);
        return response()->json($data, 200);
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
