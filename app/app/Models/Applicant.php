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
}
