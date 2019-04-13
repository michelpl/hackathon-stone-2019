<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    public $fillable = [
        'title',
        'description'
    ];

    public function skills()
    {
        return $this->belongsToMany('App\Models\Skill', 'job_skills');
    }

    public function positions()
    {
        return $this->belongsToMany('App\Models\Position', 'job_positions');
    }

    public function jobSkills()
    {
        return $this->hasMany('App\Models\JobSkill');
    }

    public function jobPositions()
    {
        return $this->hasMany('App\Models\JobPosition');
    }
}
