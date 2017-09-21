<?php

namespace SisFin\Http\Controllers\Admin;

use Illuminate\Http\Request;

use SisFin\Http\Requests;
use SisFin\Http\Controllers\Controller;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use SisFin\Http\Requests\BankCreateRequest;
use SisFin\Http\Requests\BankUpdateRequest;
use SisFin\Repositories\BankRepository;
use SisFin\Events\BankCreatedEvent;
use SisFin\Models\Bank;



class BanksController extends Controller
{

    /**
     * @var BankRepository
     */
    protected $repository;

    public function __construct(BankRepository $repository)
    {
        $this->repository = $repository;
        $this->repository->skipPresenter(true);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banks = $this->repository->paginate(5);

        // if (request()->wantsJson()) {

        //     return response()->json([
        //         'data' => $banks,
        //     ]);
        // }


        return view('admin.banks.index', compact('banks'));
    }

    public function create()
    {
        return view('admin.banks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BankCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(BankCreateRequest $request)
    {
        $data = $request->all();      
        $bank = $this->repository->create($data);

        // if ($request->wantsJson())
        // {

        //     $response = [
        //         'message' => 'Bank created.',
        //         'data'    => $bank->toArray(),
        //     ];

        //     return response()->json($response);
        // }

        return redirect()->route('admin.banks.index');

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

        $bank = $this->repository->find($id);

        return view('admin.banks.edit', compact('bank'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  BankUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(BankUpdateRequest $request, $id)
    {


        $bank = $this->repository->update($request->all(), $id);


        // if ($request->wantsJson())
        // {
        //     $response = [
        //         'message' => 'Bank updated.',
        //         'data'    => $bank->toArray(),
        //     ];

        //     return response()->json($response);
        // }

        return redirect()->route('admin.banks.index');

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

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Bank deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->route('admin.banks.index');
    }
}
