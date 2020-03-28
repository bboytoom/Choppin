<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use App\Http\Resources\Permission\PermissionResource;
use App\Http\Resources\Permission\PermissionCollection;
use App\Repositories\PermissionRepository;
use App\Models\Permission;

class PermissionController extends Controller
{
    protected $perm;
    private $pages = 10;

    public function __construct(PermissionRepository $perm)
    {
        $this->authorizeResource(Permission::class, 'permission');
        $this->perm = $perm;
    }

    public function index()
    {
        $permission = Permission::where('name', '!=', 'root')->where('name', '!=', 'cliente')->paginate($this->pages);
        return new PermissionCollection($permission);
    }

    public function store(PermissionRequest $request)
    {
        return response(null, $this->perm->createPermission($request));
    }

    public function show(Permission $permission)
    {
        PermissionResource::withoutWrapping();
        return new PermissionResource($permission);
    }

    public function update(PermissionRequest $request, Permission $permission)
    {
        return response(null, $this->perm->updatePermission($request, $permission));
    }

    public function destroy(Permission $permission)
    {
        return response(null, $this->perm->deletePermission($permission));
    }
}
