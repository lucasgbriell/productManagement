<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
*    @OA\Info(
*       title="Product Management",
*       version="1.0.0",
*       description="Project Management is a simple project to manage products via API REST.<br>This is allow product to be created, updated and deleted using request in JSON format and standard HTTP verbs.<br>Bellow, you can check the docs out and learn how to use.",
*    )
*    @OA\SecurityScheme(
*       type="http",
*       scheme="bearer",
*       securityScheme="bearerAuth"
*     )
*/

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
