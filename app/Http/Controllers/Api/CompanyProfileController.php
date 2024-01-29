<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyProfileResource;
use App\Models\Company_Profile;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class CompanyProfileController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     */
    public function index(){
        $companyprofile = CompanyProfileResource::collection(Company_Profile::get());
        return $this->successResponse($companyprofile, 'ok', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_name'          => ['required'],
            'description'           => ['required'],
            'industry'              => ['required'],
            'location'              => ['required'],
            'intro'                 => ['required'],
            'company_problem'       => ['required'],
            'logo'                  => ['required'],
            'solution'              => ['required'],

        ]);
        $companyprofile = Company_Profile::create($request->all());
        if ($companyprofile) {
            return $this->successResponse(new CompanyProfileResource($companyprofile), 'Company profile created successfully', '', 200);
        } else {
            return $this->errorResponse(null,'the companyprofile not added',401);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $companyprofile = Company_Profile::find($id);
    if ($companyprofile) {
        return $this->successResponse(new CompanyProfileResource($companyprofile), 'ok', 200);
    }
    return $this->errorResponse(null, 'The companyprofile not found', 404);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'company_name'          => ['required'],
            'description'           => ['required'],
            'industry'              => ['required'],
            'location'              => ['required'],
            'intro'                 => ['required'],
            'company_problem'       => ['required'],
            'logo'                  => ['required'],
            'solution'              => ['required'],
         ]);
         $companyprofile=Company_Profile::find($id);
         $companyprofile->update($request->all());
         if ($companyprofile) {
             return $this->successResponse(new CompanyProfileResource($companyprofile), 'the companyprofile update', 200);
         }else {
             return $this->errorResponse(null,'the companyprofile not update',401);
         }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $companyprofile = Company_Profile::find($id);
        if (!$companyprofile) {

            return $this->errorResponse(null, 'this companyprofile not found','',404);
        }
        $companyprofile->delete();

        return $this->successResponse('', 'companyprofile deleted successfully',200);
    }
}
