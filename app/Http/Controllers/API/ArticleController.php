<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Articles\ListRequest;
use App\Services\ListingArticlesService;
use Exception;
use Illuminate\Http\JsonResponse;

class ArticleController extends Controller
{
    protected ListingArticlesService $articleService;

    public function __construct(ListingArticlesService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function index(ListRequest $request): JsonResponse
    {
        try {
            $data = $this->articleService->getArticlesWithPagination($request->validated());
            return $this->paginatedResponse($data);
        } catch (Exception $e) {
            $this->logExceptionErrorWithData(__('articles.error_listing_articles'), $e, $request->validated());
            return $this->serverErrorResponse();
        }
    }
}
