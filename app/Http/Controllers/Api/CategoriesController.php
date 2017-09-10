<?php

namespace CodeFin\Http\Controllers\Api;

use Illuminate\Http\Request;

use CodeFin\Http\Controllers\Controller;
use CodeFin\Http\Requests;
use CodeFin\Http\Requests\CategoryRequest;
use CodeFin\Repositories\CategoryRepository;
use CodeFin\Criteria\FindByNameCriteria;
use CodeFin\Criteria\FindByLikeAgencyCriteria;
use CodeFin\Criteria\FindRootCategoriesCriteria;
use CodeFin\Criteria\WithDepthCategoriesCriteria;

class CategoriesController extends Controller
{

    /**
     * @var CategoryRepository
     */
    protected $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
        $this->repository->pushCriteria( new WithDepthCategoriesCriteria());
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository
            ->pushCriteria( new FindRootCategoriesCriteria());
            
        $categories = $this->repository->all();

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
//dd('deu certo');
        $category = $this->repository->skipPresenter()->create($request->all());

        $this->repository->skipPresenter(false);
        $category = $this->repository->find($category->id); // serealizada com a profundade

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

        $category = $this->repository->skipPresenter()->update($request->all(), $id);
        $this->repository->skipPresenter(false);
        $category = $this->repository->find($category->id); // serealizada com a profundade

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
