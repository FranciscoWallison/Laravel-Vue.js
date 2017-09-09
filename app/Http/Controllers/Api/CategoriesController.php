<?php

namespace CodeFin\Http\Controllers\Api;

use Illuminate\Http\Request;

use CodeFin\Http\Controllers\Controller;
use CodeFin\Http\Requests;
use CodeFin\Http\Requests\CategoryRequest;
use CodeFin\Repositories\CategoryRepository;
use CodeFin\Criteria\FindByNameCriteria;
use CodeFin\Criteria\FindByLikeAgencyCriteria;


class CategoriesController extends Controller
{

    /**
     * @var CategoryRepository
     */
    protected $repository;

    public function __construct(CategoryRepository $repository)
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

        $categories = $this->repository->paginate();

        return  $categories;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CategoryRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        dd('deucerto');
        $category = $this->repository->create($request->all());

        return response()->json($category, 201);
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
        $category = $this->repository->find($id);

        return response()->json($category);

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

        $category = $this->repository->find($id);

        return view('categories.edit', compact('category'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  CategoryRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = $this->repository->update($request->all(), $id);

        return response()->json($category);
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
