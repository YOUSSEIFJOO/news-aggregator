<?php

namespace App\Services\Integrations;

use App\Models\Article;
use Exception;
use Illuminate\Support\Facades\Http;

class TheGuardianApiService extends AbstractNewsApiService
{
    protected string $apiKeyName = 'guardian-api';

    public function fetchArticles($page = 1)
    {
        try {
            $response = Http::get($this->apiUrl, [
                'api-key' => $this->apiKey,
                'page' => $page
            ]);

            if ($response->failed())
                $this->logErrorWithData(__('articles.error_fetching_articles_guardian_api'), $response->json());

            return $response->json()['response']['results'];
        } catch (Exception $e) {
            $this->logExceptionError(__('articles.error_fetching_articles_guardian_api'), $e);
            return [];
        }
    }

    public function insertInDatabase($data): void
    {
        try {
            foreach($data as $article) {
                Article::updateOrCreate(
                    [
                        'url' => $article['webUrl'],
                    ],
                    [
                        'title' => $article['webTitle'],
                        'source' => 'The Guardian',
                        'published_at' => $article['webPublicationDate']
                    ]
                );
            }
        } catch (Exception $e) {
            $this->logExceptionError(__('articles.error_inserting_articles_guardian_api'), $e);
        }
    }
}
