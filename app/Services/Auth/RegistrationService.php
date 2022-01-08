<?php

namespace App\Services\Auth;

use App\Models\User;

class RegistrationService
{
    public function registration(array $validated): array
    {
        $result = [
            'status' => false,
            'statusCode' => 500,
            'message' => trans('errors.unknown'),
        ];

        $user = User::create($validated + ['name' => 'empty']);

        if ($user) {
            $result['status'] = true;
            $result['statusCode'] = 201;
            $result['message'] = trans('messages.registration_success');
        }

        return $result;
    }
}
