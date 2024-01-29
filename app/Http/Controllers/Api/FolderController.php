<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\FolderRequest;
use App\Http\Resources\FolderResource;
use App\Models\Folder;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $folder = FolderResource::collection(Folder::get());
        return $this->successResponse($folder, 'ok',200);
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
    public function store(FolderRequest $request)
    {
        $request->validate([
            'name' => 'required',
            'size' => 'required',
            'creation_date' => 'required',
        ]);
        $folder = Folder::create($request->all());
        if ($folder) {
            return $this->successResponse(new FolderResource($folder), 'the folder created successfully',200);
        } else {
            return $this->errorResponse(null,'the folder not added',401);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $folder = Folder::find($id);
    if ($folder) {
        return $this->successResponse(new FolderResource($folder), 'ok', 200);
    }
    return $this->errorResponse(null, 'The folder not found',404);
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
    public function update(FolderRequest $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'size' => 'required',
            'creation_date' => 'required',
         ]);
         $folder=Folder::find($id);
         $folder->update($request->all());
         if ($folder) {
             return $this->successResponse(new FolderResource($folder), 'the folder update', 200);
         }else {
             return $this->errorResponse(null,'the folder not update',401);
         }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $folder = Folder::find($id);
        if (!$folder) {

            return $this->errorResponse(null, 'this folder not found',404);
        }
        $folder->delete();

        return $this->successResponse('', 'folder deleted successfully',200);
    }
}
