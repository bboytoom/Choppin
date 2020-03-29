<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AdministratorRequest;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\UserCollection;
use App\Repositories\AdministratorRepository;
use App\User;

class AdministratorController extends Controller
{
    protected $user;
    private $pages = 10;

    public function __construct(AdministratorRepository $user)
    {
        $this->authorizeResource(User::class, 'administration');
        $this->user = $user;
    }

    public function index()
    {
        $admin = User::where('type', 'staff')->paginate($this->pages);
        return new UserCollection($admin);
    }

    public function store(AdministratorRequest $request)
    {
        return response(null, $this->user->createAdministrator($request));
    }

    public function show(User $administration)
    {
        UserResource::withoutWrapping();
        return new UserResource($administration);
    }

    public function update(AdministratorRequest $request, User $administration)
    {
        return response(null, $this->user->updateAdministrator($request, $administration));
    }

    public function destroy(User $administration)
    {
        return response(null, $this->user->deleteAdministrator($administration));
    }
}
