<?php

namespace App\Http\Controllers;

use App\Models\ApplicantPosition;
use App\Models\ApplicantSkill;
use Illuminate\Http\Request;
use App\Models\Applicant;

class ApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Applicant::all()->load('applicantSkills')->load('applicantPositions');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $applicant = Applicant::create($request->all());


        foreach ($request->skills as $skill) {
            $applicantSkill = new ApplicantSkill();
            $applicantSkill->fill($skill);
            $applicantSkill->applicant_id = $applicant->id;
            $applicantSkill->save();
        }

        foreach ($request->positions as $position) {
            $applicantPosition = new ApplicantPosition();
            $applicantPosition->fill($position);
            $applicantPosition->applicant_id = $applicant->id;
            $applicantPosition->save();
        }

        return $applicant->load('applicantSkills')->load('applicantPositions');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Applicant $applicant)
    {
        return $applicant->load('applicantSkills')->load('applicantPositions');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Applicant $applicant)
    {
        $applicant->fill($request->all());
        if (!$applicant->save()) {
            return response()->json(['error' => 'Erro ao Salvar'], 500);
        }
        return response()->json(['success' => 'updated'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Applicant $applicant)
    {
        if (!$applicant->delete()) {
            return response()->json(['error' => 'Erro ao Deletar'], 500);
        }
        return response()->json(['success' => 'Deletado'], 200);
    }
}
