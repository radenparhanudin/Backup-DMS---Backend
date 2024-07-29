<?php

namespace Modules\Administrator\App\Http\Controllers;

use App\Facades\Convert;
use App\Facades\DMS;
use App\Facades\ResponseJson;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    protected $searchOnly = ['username', 'name', 'email'];

    public function index(SearchRequest $request): JsonResponse
    {
        $limit = $request->limit ?? 10;
        $params = $request->only($this->searchOnly);
        $searchs = Convert::arrayToObject($params);

        $users = User::with('unit_organisasi')->search($searchs)->paginate($limit);

        return ResponseJson::success(
            data: $users
        );
    }

    public function sync(Request $request): JsonResponse
    {
        $invalidUserIds = DB::table('documents')
            ->whereNotIn('user_id', function ($query) {
                $query->select('id')
                    ->from('users');
            })
            ->pluck('user_id');

        foreach ($invalidUserIds as $invalidUserId) {
            $user = DMS::get(
                access_token: $request->user()->dms_token,
                path: "/backup/user/$invalidUserId",
            );

            if (! $user->error) {
                User::updateOrCreate([
                    'id' => $user->data->id,
                ], [
                    'id' => $user->data->id,
                    'name' => $user->data->name,
                    'username' => $user->data->username,
                    'email' => $user->data->email,
                    'unit_organisasi_id' => $user->data->unit_organisasi_id,
                    'avatar' => $user->data->avatar,
                    'tanggal_update' => Carbon::now(),
                ]);
            }
        }

        return ResponseJson::success(
            message: 'Sync data berhasil!'
        );
    }

    public function update(Request $request): JsonResponse
    {
        $users = User::whereDate('updated_at', 'not like', Carbon::now()->toDateString().'%')->get();

        foreach ($users as $user) {
            $user = DMS::get(
                access_token: $request->user()->dms_token,
                path: "/backup/user/$user->id",
            );

            if (! $user->error) {
                User::whereId($user->data->id)->update([
                    'name' => $user->data->name,
                    'username' => $user->data->username,
                    'email' => $user->data->email,
                    'unit_organisasi_id' => $user->data->unit_organisasi_id,
                    'avatar' => $user->data->avatar,
                    'tanggal_update' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);
            }
        }

        return ResponseJson::success(
            message: 'Update data berhasil!'
        );
    }
}
