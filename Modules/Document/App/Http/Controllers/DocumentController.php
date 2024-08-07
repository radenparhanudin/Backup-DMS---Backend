<?php

namespace Modules\Document\App\Http\Controllers;

use App\Facades\Convert;
use App\Facades\DMS;
use App\Facades\ResponseJson;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Modules\Document\App\Http\Requests\SyncFileRequest;
use Modules\Document\App\Models\Document;
use Modules\Document\App\Models\MetaData;

class DocumentController extends Controller
{
    protected $searchOnly = ['document_type_id', 'document_name', 'additional_name', 'document_status_id'];

    public function index(SearchRequest $request): JsonResponse
    {
        $limit = $request->limit ?? 10;
        $params = $request->only($this->searchOnly);
        $searchs = Convert::arrayToObject($params);

        $documents = Document::with(['user', 'document_type', 'document_status'])->search($searchs);

        if ($request->username || $request->name) {
            $documents = $documents->whereHas('user', function (Builder $query) use ($request) {
                return $query->where('username', 'like', "%$request->username%")->where('name', 'like', "%$request->name%");
            });
        }

        $documents = $documents->paginate($limit);

        return ResponseJson::success(
            data: $documents
        );
    }

    public function syncGet(SearchRequest $request): JsonResponse
    {
        $limit = $request->limit ?? 10;
        $params = $request->only($this->searchOnly);
        $searchs = Convert::arrayToObject($params);

        $documents = Document::with(['user', 'document_type', 'document_status'])->whereDownloadedFile(0)->search($searchs)->paginate($limit);

        return ResponseJson::success(
            data: $documents
        );
    }

    public function syncPost(Request $request): JsonResponse
    {
        /* Check Document Is Empty */
        $document_count = Document::count();
        if ($document_count == 0) {
            $start_date = '2024-01-01 00:00:00';
        } else {
            $document = Document::orderBy('tanggal_update', 'desc')->first();
            $start_date = Carbon::parse($document->tanggal_update)->format('Y-m-d H:i:s');
        }

        /* Download File Is False */
        $downloaded_file = Document::whereDownloadedFile(0)->get();
        if ($downloaded_file->count() > 0) {
            return ResponseJson::error(
                message: "Masih terdapat {$downloaded_file->count()} data yang belum di download filenya!"
            );
        }

        /* Get Documents */
        $documents = DMS::get(
            access_token: $request->user()->dms_token,
            path: '/backup/documents',
            params: [
                'start_date' => $start_date,
            ],
        );

        $documents = $documents->data;
        foreach ($documents as $document) {
            Document::updateOrCreate([
                'id' => $document->id,
            ], [
                'id' => $document->id,
                'document_type_id' => $document->document_type_id,
                'document_name' => $document->document_name,
                'additional_name' => $document->additional_name,
                'path' => $document->path,
                'file_size' => $document->file_size,
                'document_status_id' => $document->document_status_id,
                'user_id' => $document->user_id,
                'downloaded_file' => false,
                'tanggal_update' => $document->updated_at,
            ]);

            $meta_data = $document->meta_data;
            $meta_data_ids = collect($meta_data)->pluck('id')->toArray();

            /* Remove Old Meta Data */
            MetaData::whereDocumentId($document->id)->whereNotIn('id', $meta_data_ids)->delete();

            foreach ($meta_data as $md) {
                MetaData::updateOrCreate([
                    'id' => $md->id,
                ], [
                    'id' => $md->id,
                    'document_id' => $md->document_id,
                    'value' => $md->value,
                    'sort_number' => $md->sort_number,
                    'column_name' => $md->column_name,
                    'column_description' => $md->column_description,
                ]);
            }
        }

        return ResponseJson::success(
            message: 'Sync dokumen selesai!'
        );
    }

    public function syncFile(SyncFileRequest $request): JsonResponse
    {
        $documents = Document::whereDownloadedFile(0)->limit($request->limit)->orderBy('tanggal_update', 'asc')->get();

        foreach ($documents as $document) {
            $file_response = DMS::get(
                access_token: $request->user()->dms_token,
                path: "/backup/download/$document->id",
                object: false,
            );

            Storage::put($document->path, $file_response);

            Document::whereId($document->id)->update([
                'downloaded_file' => true,
            ]);
        }

        return ResponseJson::success(
            message: 'Download file backup selesai!'
        );
    }

    public function metadata($document_id): JsonResponse
    {
        $meta_data = MetaData::whereDocumentId($document_id)->get();

        return ResponseJson::success(
            data: $meta_data
        );
    }

    public function file($document_id)
    {
        $document = Document::findOrFail($document_id);
        $path = $document->path;
        if (!Storage::exists($path)) {
            return ResponseJson::error(
                message: 'File tidak ditemukan kemungkinan terhapus!'
            );
        }
        $content = Storage::get($path);
        $content_type = Storage::mimeType($path);

        return response(
            content: $content,
            headers: ['Content-Type' => $content_type]
        );
    }
}
