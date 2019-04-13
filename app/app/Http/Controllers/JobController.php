<?php

namespace App\Http\Controllers;

use App\Models\JobSkill;
use Illuminate\Http\Request;
use App\Models\Job;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return
            Job::all()
                ->load('skills')
                ->load('positions')
                ->load('jobSkills');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $job = Job::create($request->all());
        $job->positions()->attach($request->positions);

        $arraySkills = [];
        foreach($request->skills as $skill) {
            if (isset($skill['skill_id'])) {
                $arraySkills[] =  $skill['skill_id'];
            }
        };
        $job->skills()->attach($arraySkills);

        foreach($request->skills as $skill) {
            $jb = JobSkill::where('skill_id', $skill['skill_id'])->where('job_id', $job->id);
            $newJb = $jb->first();
            $newJb->weight = $skill['weight'];
            $newJb->level = $skill['level'];
            !$newJb->save();
        };

        return $job;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        return
            $job
            ->load('skills')
            ->load('positions')
            ->load('jobSkills');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        $job->fill($request->all());
        if (!$job->save()) {
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
    public function destroy(Job $job)
    {
        if (!$job->delete()) {
            return response()->json(['error' => 'Erro ao Deletar'], 500);
        }
        return response()->json(['success' => 'Deletado'], 200);
    }
}
