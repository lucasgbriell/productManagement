<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /*
    * @OA\Tag(
    *     name="Authentication"
    * )
    */

    /**
     * @OA\Post(
     *      path="/api/auth/login",
     *      summary="Obtain user token",
     *      tags={"Authentication"},
     *      description="This API helps you to log in and get user token.<br><br>Demo user created<br>Email: lucasgabrielhonorio@gmail.com<br>Password:password",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      ),
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *            mediaType="application/json",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="email", type="string", format="email"),
     *               @OA\Property(property="password", type="string")
     *            )
     *           )
     *       ),
     * )
    */

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

   
    /**
     * @OA\Post(
     *      path="/api/auth/me",
     *      summary="Obtain user logged information",
     *      tags={"Authentication"},
     *      description="This API helps you to get more information about user logged in",
     *      security={{"bearerAuth": {}}},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      ),
     * )
    */
    public function me()
    {
        return response()->json(auth()->user());
    }

     /**
     * @OA\Post(
     *      path="/api/auth/logout",
     *      summary="Log user out",
     *      tags={"Authentication"},
     *      description="This API helps you to log out",
     *      security={{"bearerAuth": {}}},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      ),
     * )
    */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

     /**
     * @OA\Post(
     *      path="/api/auth/refresh",
     *      summary="Refresh Token",
     *      tags={"Authentication"},
     *      description="This API helps you to refresh user token",
     *      security={{"bearerAuth": {}}},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      ),
     * )
    */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }


    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}