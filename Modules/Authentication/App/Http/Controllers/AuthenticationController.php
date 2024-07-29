<?php

namespace Modules\Authentication\App\Http\Controllers;

use App\Facades\DMS;
use App\Facades\ResponseJson;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Modules\Authentication\App\Http\Requests\LoginRequest;

class AuthenticationController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only(['username', 'password']);

        $login = DMS::login($credentials);

        if ($login->error) {
            throw ValidationException::withMessages(['username' => $login->message->username]);
        }

        $dms_token = $login->data->token;
        $user = $login->data->user;
        $role_names = collect($login->data->roles)->pluck('name')->toArray();
        $role_ids = Role::whereIn('name', $role_names)->pluck('id')->toArray();

        $user_created = User::find($user->id);
        if ($user_created) {
            $user_created->update([
                'id' => $user->id,
                'name' => $user->name,
                'username' => $user->username,
                'email' => $user->email,
                'dms_token' => $dms_token,
                'unit_organisasi_id' => $user->unit_organisasi_id,
                'avatar' => $user->avatar,
                'tanggal_update' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        } else {
            $user_created = User::create([
                'id' => $user->id,
                'name' => $user->name,
                'username' => $user->username,
                'email' => $user->email,
                'dms_token' => $dms_token,
                'unit_organisasi_id' => $user->unit_organisasi_id,
                'avatar' => $user->avatar,
                'tanggal_update' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }

        /* Update Role */
        $user_created->syncRoles($role_ids);

        /* Remove Old Tokens */
        $user_created->tokens()->delete();

        /* Generate Token */
        $token = $user_created->createToken($user_created->username)->plainTextToken;

        return ResponseJson::success(
            message: 'Login berhasil',
            data: [
                'user' => $user_created,
                'token' => $token,
            ]
        );
    }

    public function logout(Request $request): JsonResponse
    {
        $user = $request->user();
        $user->tokens()->where('name', $user->username)->delete();

        return ResponseJson::success(
            message: 'Logout Berhasil!',
        );
    }
}
