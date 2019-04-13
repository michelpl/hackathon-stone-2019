<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Faker\Generator as Faker;

class LinkedinController extends Controller
{

    public function auth() 
    {
        $provider = app('linkedin-provider');

        $token = $provider->getAccessToken('authorization_code', [
            'code' => $_GET['code']
        ]);

        $member = $provider->withResourceOwnerVersion(2)->getResourceOwner($token);

        $applicantData = $this->getFakerApplicant();
        $applicantData['first_name'] = $member->getFirstName()['localized']['pt_BR'];
        $applicantData['last_name'] = $member->getLastName()['localized']['pt_BR'];

        header('Location: '. env('SUCCESS_URL') . "&id=" . $applicantId);
        exit;

        //@todo save user collected data
        //Nome: $member->getFirstName()['localized']['pt_BR']
        //Sobrenome: $member->getLastName()['localized']['pt_BR']
        // maybe needs change the object that have 
    }

    public function getFakerApplicant()
    {
        $faker = \Faker\Factory::create();
        return [
            'profile_url' => $faker->url(),
            'image_url' => $faker->url(),
            'phone_numbers' => $faker->phoneNumber(),
            'email' => $faker->email(),
            'linkedin_id' => $faker->uuid(),
            'applicant_skills' => $this->getRandomSkills(),
            'applicant_positions' => $this->getRandomPositions()
        ];
    }

    public function getRandomSkills()
    {
        $skillsArray = array_rand(
            ["PHP" => 1, "JS" => 2, "C#" => 3, "JAVA" => 4, "CSS" => 5, "HTML" => 5, "MONGO" => 6, "MYSQL" => 7], 3
        );

        $skills = [];
        foreach ($skillsArray as $skill) {
            $skills[] = [
                'name' => $skill,
                'level' =>  rand(1,5),
                'weight' => rand(1,5)
            ];
        }

        return $skills;
    }

    public function getRandomPositions()
    {
        
        $positionsArray = array_rand(
            ["Desenvolvedor" => 1, "Scrum Master" => 2, "Lider Teécnico" => 3, "Caçador" => 3, "CTO" => 4], 3
        );

        $positions = [];
        foreach ($positionsArray as $position) {
            $positions[] = [
                "name" => $position,
                "level" => rand(1,5)
            ];
        }
        return $positions;
    }

    public function login()
    {
        dd($this->getFakerApplicant());
/*
        $provider = app('linkedin-provider');
        
        if (!isset($_GET['code'])) {
            $options = [
                'state' => 'OPTIONAL_CUSTOM_CONFIGURED_STATE',
                'scope' => ['r_liteprofile','r_emailaddress', 'w_member_social'] // array or string
            ];
        
            // If we don't have an authorization code then get one
            $authUrl = $provider->getAuthorizationUrl($options);
            $_SESSION['oauth2state'] = $provider->getState();
            header('Location: '.$authUrl);
            exit;
        }        */
    }
}
