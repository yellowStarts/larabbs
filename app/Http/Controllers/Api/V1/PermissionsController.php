<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\PermissionResource;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    public function index(Request $request)
    {
        $permissions = $request->user()->getAllPermissions();

        PermissionResource::wrap('data');
        return PermissionResource::collection($permissions);
    }
}
