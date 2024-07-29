<?php

namespace Modules\User\App\Http\Controllers;

use App\Facades\ResponseJson;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile(Request $request): JsonResponse
    {
        $user_id = $request->user()->id;

        $user = User::select('id', 'name', 'username', 'email', 'unit_organisasi_id', 'updated_at')
            ->with('unit_organisasi')->findOrFail($user_id);

        return ResponseJson::success(
            data: $user
        );
    }

    public function roles(Request $request): JsonResponse
    {
        $user_id = $request->user()->id;

        $user = User::with([
            'roles' => function ($query) {
                $query->select('id', 'name', 'description');
            },
        ])->findOrFail($user_id);

        return ResponseJson::success(
            data: $user->roles
        );
    }
}
