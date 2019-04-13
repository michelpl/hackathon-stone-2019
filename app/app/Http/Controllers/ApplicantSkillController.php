<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApplicantSkill;

class ApplicantSkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ApplicantSkill::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $applicantSkill = ApplicantSkill::create($request->all());
        return $applicantSkill;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ApplicantSkill $applicantSkill)
    {
        return $applicantSkill;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ApplicantSkill $applicantSkill)
    {
        $applicantSkill->fill($request->all());
        if (!$applicantSkill->save()) {
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
    public function destroy(ApplicantSkill $applicantSkill)
    {
        if (!$applicantSkill->delete()) {
            return response()->json(['error' => 'Erro ao Deletar'], 500);
        }
        return response()->json(['success' => 'Deletado'], 200);
    }
}
