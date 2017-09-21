<?php

namespace SisFin\Http\Controllers\Api;

use SisFin\Criteria\FindBetweenDateBRCriteria;
use SisFin\Presenters\BillSerializerPresenter;
use SisFin\Criteria\FindByValueBRCriteria;
use SisFin\Http\Controllers\Controller;
use SisFin\Http\Controllers\Response;
use SisFin\Http\Requests;
use SisFin\Http\Requests\BillPayRequest;
use SisFin\Http\Requests\BillReceiveRequest;
use SisFin\Repositories\BillReceiveRepository;
use Illuminate\Http\Request;


class BillReceivesController extends Controller
{
    use BillControllerTrait;

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
        $searchParam = config('repository.criteria.params.search');
        $search = $request->get($searchParam);
        $this->repository->setPresenter(BillSerializerPresenter::class);
        $this->repository
            ->pushCriteria(new FindBetweenDateBRCriteria($search, 'date_due'))
            ->pushCriteria(new FindByValueBRCriteria($search));

        $bills = $this->repository->paginate();

        return $bills;
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
        return response()->json($bankAccount, 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  BillPayRequest $request
     * @param  string $id
     *
     * @return Response
     */
    public function update(BillReceiveRequest $request, $id)
    {
        $bankAccount = $this->repository->update($request->all(), $id);
        return response()->json($bankAccount, 200);
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
        $this->repository->delete($id);
        return response()->json([], 204);
    }
}
