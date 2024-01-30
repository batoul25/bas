<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\FileRequest;
use App\Http\Resources\FileResource;
use App\Models\File;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class FileController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $file = FileResource::collection(File::get());
        return $this->successResponse($file, 'ok', 200);
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
    public function store(FileRequest $request)
    {
        $request->validate([

            'name' => ['required'],
            'date' => ['required'],
            'size' => ['required'],
            'type' => ['required'],
        ]);
        $file = File::create($request->all());
        if ($file) {
            return $this->successResponse(new FileResource($file), 'file created successfully', 200);
        } else {
            return $this->apiResponse(null,'the file not added',401);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $file = File::find($id);
    if ($file) {
        return $this->successResponse(new FileResource($file), 'ok', 200);
    }
    return $this->apiResponse(null, 'The file not found', 404);
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
             'name' => 'required',
             'date' => 'required',
             'size' => 'required',
             'type' => 'required',

         ]);
         $file=File::find($id);
         $file->update($request->all());
         if ($file) {
             return $this->successResponse(new FileResource($file), 'the file update', 200);
         }else {
             return $this->errorResponse(null,'the file not update',401);
         }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $file = File::find($id);
        if (!$file) {

            return $this->errorResponse(null, 'this file not found','',404);
        }
        $file->delete();

        return $this->successResponse('', 'file deleted successfully',200);
    }
}
