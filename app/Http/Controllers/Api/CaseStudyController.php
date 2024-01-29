<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Case_StudyRequest;
use App\Http\Resources\Case_StudyResource;
use App\Models\Case_Study;
use App\Traits\ApiResponse;
use App\Http\Controllers\Controller;


class CaseStudyController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $casestudies = Case_StudyResource::collection(Case_Study::get());
        return $this->successResponse($casestudies, ' successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Case_StudyRequest $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'category' => 'required',
            'logo' => 'required',
            'company_name' => 'required',
            'order' => 'required',

        ]);
        $casestudy = Case_Study::create($request->all());
        if ($casestudy) {
            return $this->successResponse(new Case_StudyResource($casestudy), 'the casestudy created successfully');
        } else {
            return $this->errorResponse('the casestudy not added',401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Case_Study  $case_Study
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $casestudy = Case_Study::find($id);
    if ($casestudy) {
        return $this->successResponse(new Case_StudyResource($casestudy), 'casestudy Successfully');
    }
    return $this->errorResponse('The casestudy is not found',401);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Case_Study  $case_Study
     * @return \Illuminate\Http\Response
     */
    public function update(Case_StudyRequest $request,$id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
             'category' => 'required',
             'logo' => 'required',
             'company_name' => 'required',
             'order' => 'required',
         ]);
         $casestudy=Case_Study::find($id);
         $casestudy->update($request->all());
         if ($casestudy) {
             return $this->successResponse(new Case_StudyResource($casestudy), 'the casestudy update');
         }else {
             return $this->errorResponse('The casestudy is not update',401);
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Case_Study  $case_Study
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $casestudy = Case_Study::find($id);
        if (!$casestudy) {

            return $this->errorResponse(null, 'this casestudy not found','',404);
        }
        $casestudy->delete();

        return $this->successResponse('', 'casestudy deleted successfully','',200);
    }
}
