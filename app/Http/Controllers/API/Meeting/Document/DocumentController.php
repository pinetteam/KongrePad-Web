<?php

namespace App\Http\Controllers\API\Meeting\Document;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\Meeting\Document\DocumentResource;
use App\Http\Traits\ParticipantLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DocumentController extends Controller
{
    use ParticipantLog;

    /**
     * Get the documents for the user's meeting.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            // Get the meeting from the authenticated user
            $meeting = $request->user()->meeting;

            // Log participant action
            $this->logParticipantAction(
                $request->user(),
                "get-documents",
                __('common.meeting') . ': ' . $meeting->title
            );

            // Fetch and return documents
            return response()->json([
                'data' => DocumentResource::collection($meeting->documents()->orderBy('created_at', 'desc')->get()),
                'status' => true,
                'errors' => null
            ], 200);

        } catch (\Throwable $e) {
            // Log the error
            Log::error('DocumentController Error: ' . $e->getMessage());

            // Return error response
            return response()->json([
                'data' => null,
                'status' => false,
                'errors' => [$e->getMessage()]
            ], 500);
        }
    }

    /**
     * Get a specific document with download URL.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, int $id)
    {
        try {
            // Get the meeting from the authenticated user
            $meeting = $request->user()->meeting;
            
            // Find the document
            $document = $meeting->documents()->findOrFail($id);
            
            // Check if document is allowed to review
            if (!$document->allowed_to_review) {
                return response()->json([
                    'data' => null,
                    'status' => false,
                    'errors' => [__('common.you-are-not-allowed-to-view-this-document')]
                ], 403);
            }
            
            // Log participant action
            $this->logParticipantAction(
                $request->user(),
                "view-document",
                $document->title
            );
            
            // Return document data (mobile will construct the URL)
            return response()->json([
                'data' => new DocumentResource($document),
                'status' => true,
                'errors' => null
            ], 200);
            
        } catch (\Throwable $e) {
            // Log the error
            Log::error('DocumentController Error (show): ' . $e->getMessage());
            
            // Return error response
            return response()->json([
                'data' => null,
                'status' => false,
                'errors' => [$e->getMessage()]
            ], 500);
        }
    }

    /**
     * Download a document file.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function download(Request $request, int $id)
    {
        try {
            // Get the meeting from the authenticated user
            $meeting = $request->user()->meeting;
            
            // Find the document
            $document = $meeting->documents()->findOrFail($id);
            
            // Check if document is allowed to review
            if (!$document->allowed_to_review) {
                return response()->json([
                    'data' => null,
                    'status' => false,
                    'errors' => [__('common.you-are-not-allowed-to-view-this-document')]
                ], 403);
            }
            
            // Check if file exists
            $filePath = 'public/documents/' . $document->file_name . '.' . $document->file_extension;
            if (!\Storage::exists($filePath)) {
                return response()->json([
                    'data' => null,
                    'status' => false,
                    'errors' => [__('common.file-not-found')]
                ], 404);
            }
            
            // Log participant action
            $this->logParticipantAction(
                $request->user(),
                "download-document",
                $document->title
            );
            
            // Return file download
            return \Storage::download($filePath, $document->title . '.' . $document->file_extension);
            
        } catch (\Throwable $e) {
            // Log the error
            Log::error('DocumentController Error (download): ' . $e->getMessage());
            
            // Return error response
            return response()->json([
                'data' => null,
                'status' => false,
                'errors' => [$e->getMessage()]
            ], 500);
        }
    }
}
