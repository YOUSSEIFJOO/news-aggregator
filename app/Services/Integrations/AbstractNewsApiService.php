<?php

namespace App\Services\Integrations;

use App\Traits\LogTrait;

Abstract class AbstractNewsApiService
{
    use LogTrait;

    protected string $apiKey;

    protected string $apiUrl;

    public function __construct()
    {
        $this->apiKey = config('news-services.' . $this->apiKeyName . '.api-key');
        $this->apiUrl = config('news-services.' . $this->apiKeyName . '.url');
    }

    protected abstract function fetchArticles();

    protected abstract function insertInDatabase($data);
}
