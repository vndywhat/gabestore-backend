<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegistrationRequest;
use App\Services\Auth\RegistrationService;
use Illuminate\Http\JsonResponse;

class RegistrationController extends Controller
{
    public function registration(UserRegistrationRequest $request, RegistrationService $registrationService): JsonResponse
    {
        $result = $registrationService->registration($request->except(['agreement']));

        return response()->json($result, $result['statusCode']);
    }
}
