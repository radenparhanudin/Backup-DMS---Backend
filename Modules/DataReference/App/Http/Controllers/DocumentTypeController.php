<?php

namespace Modules\DataReference\App\Http\Controllers;

use App\Facades\Convert;
use App\Facades\DMS;
use App\Facades\ResponseJson;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\DataReference\App\Models\DocumentType;

class DocumentTypeController extends Controller
{
    protected $searchOnly = ['name'];

    public function index(SearchRequest $request): JsonResponse
    {
        $limit = $request->limit ?? 10;
        $params = $request->only($this->searchOnly);
        $searchs = Convert::arrayToObject($params);

        $document_types = DocumentType::search($searchs)->paginate($limit);

        return ResponseJson::success(
            data: $document_types
        );
    }

    public function sync(Request $request): JsonResponse
    {
        $document_types = DMS::get(
            access_token: $request->user()->dms_token,
            path: '/backup/document-types',
        );

        foreach ($document_types->data as $document_type) {
            DocumentType::updateOrCreate(
                [
                    'id' => $document_type->id,
                ],
                [
                    'id' => $document_type->id,
                    'name' => $document_type->name,
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

        $document_types = DocumentType::select('id as value', 'name as label')->search($searchs)->get();

        return ResponseJson::success(
            data: $document_types
        );
    }
}
