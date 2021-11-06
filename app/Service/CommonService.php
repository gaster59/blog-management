<?php

namespace App\Service;

use App\Models\User;

class CommonService
{

    public function checkUserToken($request, $user)
    {
        $result    = [];
        $bearToken = $request->bearerToken();
        if (!$bearToken) {
            $result = [
                'status' => 0,
                'msg'    => 'Please input token',
            ];
            return $result;
        }

        $userObject = $user->where('remember_token', $bearToken)->first();
        if (!$userObject) {
            $result = [
                'status' => 0,
                'msg'    => 'Invalid token',
            ];
            return $result;
        }
        $result = [
            'status' => 1,
            'msg'    => 'Success token',
            'user'   => $userObject,
        ];
        return $result;
    }

    public function sum($a, $b)
    {
        return $a + $b;
    }
}
