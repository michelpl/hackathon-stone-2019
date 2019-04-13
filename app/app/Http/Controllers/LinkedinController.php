<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LinkedinController extends Controller
{

    public function auth() 
    {
        $provider = app('linkedin-provider');

        $token = $provider->getAccessToken('authorization_code', [
            'code' => $_GET['code']
        ]);

        $member = $provider->withResourceOwnerVersion(2)->getResourceOwner($token);

        $profile = $provider->getResourceOwnerDetailsUrl($token);
        dd($member->getFirstName()['localized']['pt_BR'], $member->getLastName()['localized']['pt_BR']);
        //@todo save user collected data
        //Nome: $member->getFirstName()['localized']['pt_BR']
        //Sobrenome: $member->getLastName()['localized']['pt_BR']
        // maybe needs change the object that have 
    }

    public function login()
    {
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
        }        
    }
}
