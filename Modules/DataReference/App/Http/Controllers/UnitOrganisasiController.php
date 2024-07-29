<?php

namespace Modules\DataReference\App\Http\Controllers;

use App\Facades\Convert;
use App\Facades\DMS;
use App\Facades\ResponseJson;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\DataReference\App\Models\UnitOrganisasi;

class UnitOrganisasiController extends Controller
{
    protected $searchOnly = ['nama_unor'];

    public function index(SearchRequest $request): JsonResponse
    {
        $limit = $request->limit ?? 10;
        $params = $request->only($this->searchOnly);
        $searchs = Convert::arrayToObject($params);

        $unit_organisasis = UnitOrganisasi::search($searchs)->paginate($limit);

        return ResponseJson::success(
            data: $unit_organisasis
        );
    }

    public function sync(Request $request): JsonResponse
    {
        $users = User::leftJoin('unit_organisasis', 'users.unit_organisasi_id', '=', 'unit_organisasis.id')
            ->whereNull('unit_organisasis.id')
            ->select('users.*')
            ->get();

        foreach ($users as $user) {
            $unit_organisasi = DMS::get(
                access_token: $request->user()->dms_token,
                path: "/backup/unit-organisasi/$user->unit_organisasi_id",
            );

            if (! $unit_organisasi->error) {
                UnitOrganisasi::updateOrCreate([
                    'id' => $unit_organisasi->data->id,
                ], [
                    'id' => $unit_organisasi->data->id,
                    'nama_unor' => $unit_organisasi->data->nama_unor,
                ]);
            }
        }

        return ResponseJson::success(
            message: 'Sync data berhasil!'
        );
    }
}
