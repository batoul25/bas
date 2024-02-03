<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\AdminResource;
use App\Models\Admin;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Requests\AdminRequest;

class AdminController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin = User::all();
        return $this->successResponse($admin, 'ok', 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {
        $$this->validate($request, [
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6',
        ]);

        $admin = Admin::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $admin = Admin::create($request->all());
        if ($admin) {
            return $this->successResponse(new AdminResource($admin), 'the admin created successfully', 200);
        } else {
            return $this->errorResponse('the admin not added',401);
        }
    }
}
