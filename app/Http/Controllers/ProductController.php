<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Repositories\ProductRepository;

class ProductController extends Controller
{
    public $product;
    
    public function __construct(ProductRepository $product){
        $this->product = $product;
    }

    /*
    * @OA\Tag(
    *     name="Products"
    * )
    */

    /**
     * @OA\Get(
     *      path="/api/products",
     *      summary="List all products",
     *      tags={"Products"},
     *      description="This API helps you to view all the products.",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      )
     * )
     */

    public function index(){
        $products = $this->product->getAll();
        return response()->json($products);
    }

    /**
     * @OA\Get(
     *      path="/api/products/{id}",
     *      summary="Retrieve a product",
     *      tags={"Products"},
     *      description="This API lets you retrieve and view a specific product by id.",
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
     *     )
     * )
     */

    public function show(Int $id){
        return response()->json($this->product->getOne($id));
    }

    /**
     * @OA\Post(
     *      path="/api/products",
     *      summary="Create a product",
     *      tags={"Products"},
     *      description="This API helps you to create a new product.",
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
     *                
     *               @OA\Property(property="description", type="string"),
     *               @OA\Property(property="code", type="string"),
     *               @OA\Property(property="reference", type="string"),
     *               @OA\Property(property="quantity", type="integer"),
     *               @OA\Property(property="price", type="number"),
     *               @OA\Property(property="is_active", type="boolean"),
     *               @OA\Property(property="category_id", type="integer", default="null"),
     *               @OA\Property(property="dimension", type="array",
     *                  @OA\Items(type="object",
     *                      @OA\Property(property="name", type="string", description="Size"),
     *                      @OA\Property(property="value", type="string", description="XL")
     *                  )
     *               ),
     *            )
     *           )
     *       ),
     * )
     */

    public function store(ProductRequest $request){
        $product = $request->all();
        return response()->json($this->product->store($product));
    }

    /**
     * @OA\Put(
     *      path="/api/products/{id}",
     *      summary="Update a product",
     *      tags={"Products"},
     *      description="This API helps you to update a product.",
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
     *      ),
     *       @OA\RequestBody(
     *         @OA\MediaType(
     *            mediaType="application/json",
     *            @OA\Schema(
     *               type="object",
     *                
     *               @OA\Property(property="description", type="string"),
     *               @OA\Property(property="code", type="string"),
     *               @OA\Property(property="reference", type="string"),
     *               @OA\Property(property="quantity", type="integer"),
     *               @OA\Property(property="price", type="number"),
     *               @OA\Property(property="is_active", type="boolean"),
     *               @OA\Property(property="category_id", type="integer", default="null"),
     *               @OA\Property(property="dimension", type="array",
     *                  @OA\Items(type="object",
     *                      @OA\Property(property="name", type="string", description="Size"),
     *                      @OA\Property(property="value", type="string", description="XL")
     *                  )
     *               ),
     *            )
     *           )
     *       ),
     * )
     */

    public function update(ProductRequest $request, Int $id){
        $newProduct = $request->all();
        return response()->json($this->product->update($id, $newProduct));
    }

    /**
     * @OA\Delete(
     *      path="/api/products/{id}",
     *      summary="Delete a product",
     *      tags={"Products"},
     *      description="This API helps you delete a product",
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
     * )
     */

    public function destroy(Int $id){
        return response()->json(['deleted' => $this->product->destroy($id)]);
    }
}
