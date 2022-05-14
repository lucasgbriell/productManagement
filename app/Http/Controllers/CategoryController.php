<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\ProductRequest;
use App\Repositories\CategoryRepository;

class CategoryController extends Controller
{
    public $category;
    
    public function __construct(CategoryRepository $category){
        $this->category = $category;
    }

    /*
    * @OA\Tag(
    *     name="Categories"
    * )
    */

    /**
     * @OA\Get(
     *      path="/api/categories",
     *      summary="List all product categories",
     *      tags={"Categories"},
     *      description="This API lets you retrieve all product categories",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      ),
     * )
     */

    public function index(){
        $categories = $this->category->getAll();
        return response()->json($categories);
    }

    /**
     * @OA\Get(
     *      path="/api/categories/{id}",
     *      summary="Retrieve a product category",
     *      tags={"Categories"},
     *      description="This API lets you retrieve a product category by id",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      ),
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Unique identifier for the resource",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         style="form"
     *     ),
     * )
     */

    public function show(Int $id){
        return response()->json($this->category->getOne($id));
    }

    /**
     * @OA\Post(
     *      path="/api/categories",
     *      summary="Create a product category",
     *      tags={"Categories"},
     *      description="This API helps you to create a new product category",
     *      security={{ "bearerAuth": { }}},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      ),
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *            mediaType="application/json",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="description", type="string"),
     *               @OA\Property(property="is_active", type="boolean")
     *            )
     *           )
     *       ),
     * )
    */

    public function store(CategoryRequest $request){
        $newProduct = $request->all();
        return response()->json($this->category->store($newProduct));
    }

    /**
     * @OA\Put(
     *      path="/api/categories/{id}",
     *      summary="Update a product category",
     *      tags={"Categories"},
     *      description="This API lets you make changes to a product category",
     *      security={{ "bearerAuth": { }}},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      ),
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Unique identifier for the resource",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         style="form"
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *            mediaType="application/json",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="description", type="string"),
     *               @OA\Property(property="is_active", type="boolean")
     *            )
     *           )
     *      ),
     * )
     */

    public function update(CategoryRequest $request, Int $id){
        $newProduct = $request->all();
        return response()->json($this->category->update($id, $newProduct));
    }

    /**
     * @OA\Delete(
     *      path="/api/categories/{id}",
     *      summary="Delete a product category",
     *      tags={"Categories"},
     *      description="This API helps you delete a product category",
     *      security={{ "bearerAuth": { }}},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      ),
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Unique identifier for the resource",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         style="form"
     *     ),
     *     @OA\PathItem (
     *     ),
     * )
     */

    public function destroy(Int $id){
        return response()->json(['deleted' => $this->category->destroy($id)]);
    }
}
