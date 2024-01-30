<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\FooterRequest;
use App\Http\Resources\FooterResource;
use App\Models\footer;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $footer = FooterResource::collection(footer::get());
        return $this->successResponse($footer, 'ok', 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FooterRequest $request)
    {
        $request->validate([
            'logo'     => ['required'],
            'path'     => ['required'],
            'link'     => ['required']

        ]);
        $footer = footer::create($request->all());
        if ($footer) {
            return $this->successResponse(new FooterResource($footer), 'the footer created successfully', 200);
        } else {
            return $this->errorResponse(null,'the footer not added',401);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $footer = footer::find($id);
    if ($footer) {
        return $this->successResponse(new FooterResource($footer), 'ok', 200);
    }
    return $this->errorResponse(null, 'The footer not found', 404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'logo'     => ['required'],
            'path'     => ['required'],
            'link'     => ['required']
         ]);
         $footer=footer::find($id);
         $footer->update($request->all());
         if ($footer) {
             return $this->successResponse(new FooterResource($footer), 'the footer update', 200);
         }else {
             return $this->errorResponse(null,'the footer not update',401);
         }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $footer = footer::find($id);
        if (!$footer) {

            return $this->errorResponse(null, 'this footer not found',404);
        }
        $footer->delete();

        return $this->successResponse('', 'footer deleted successfully',200);
    }
}
