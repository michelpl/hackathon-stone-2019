<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    protected $fillable = [
        "first_name",
        "last_name",
        "profile_url",
        "image_url",
        "phone_numbers",
        "email",
        "linkedin_id"
    ];

    public function applicantSkills()
    {
        return $this->hasMany(ApplicantSkill::class);
    }

    public function applicantPositions()
    {
        return $this->hasMany(ApplicantPosition::class);
    }
}
