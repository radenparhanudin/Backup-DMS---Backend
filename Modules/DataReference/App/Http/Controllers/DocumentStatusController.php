<?php

namespace Modules\DataReference\App\Http\Controllers;

use App\Facades\Convert;
use App\Facades\DMS;
use App\Facades\ResponseJson;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\DataReference\App\Models\DocumentStatus;

class DocumentStatusController extends Controller
{
    protected $searchOnly = ['status'];

    public function index(SearchRequest $request): JsonResponse
    {
        $limit = $request->limit ?? 10;
        $params = $request->only($this->searchOnly);
        $searchs = Convert::arrayToObject($params);

        $document_statuses = DocumentStatus::withCount('documents')->search($searchs)->paginate($limit);

        return ResponseJson::success(
            data: $document_statuses
        );
    }

    public function sync(Request $request): JsonResponse
    {
        $document_statuses = DMS::get(
            access_token: $request->user()->dms_token,
            path: '/backup/document-statuses',
        );

        foreach ($document_statuses->data as $document_status) {
            DocumentStatus::updateOrCreate(
                [
                    'id' => $document_status->id,
                ],
                [
                    'id' => $document_status->id,
                    'status' => $document_status->status,
                ]
            );
        }

        return ResponseJson::success(
            message: 'Sync data berhasil!'
        );
    }

    public function search(SearchRequest $request): JsonResponse
    {
        $params = $request->only($this->searchOnly);
        $searchs = Convert::arrayToObject($params);

        $document_statuses = DocumentStatus::search($searchs)->get();

        return ResponseJson::success(
            data: $document_statuses
        );
    }
}
