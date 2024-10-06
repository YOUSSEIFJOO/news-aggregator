<?php

namespace App\Services\Integrations;

use App\Models\Article;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Http;

class NewYorkTimesApiService extends AbstractNewsApiService
{
    protected string $apiKeyName = 'new-york-times-api';

    public function fetchArticles($page = 1)
    {
        try {
            $response = Http::get($this->apiUrl, [
                'api-key' => $this->apiKey,
                'begin_date' => Carbon::now()->format('Ymd'),
                'page' => $page
            ]);

            if ($response->failed())
                $this->logErrorWithData(__('articles.error_fetching_articles_new_york_times_api'), $response->json());

            return $response->json()['response']['docs'];
        } catch (Exception $e) {
            $this->logExceptionError(__('articles.error_fetching_articles_new_york_times_api'), $e);
            return [];
        }
    }

    public function insertInDatabase($data): void
    {
        try {
            foreach($data as $article) {
                Article::updateOrCreate(
                    [
                        'url' => $article['web_url'],
                    ],
                    [
                        'title' => $article['headline']['main'],
                        'description' => $article['snippet'],
                        'content' => $article['lead_paragraph'],
                        'source' => $article['source'],
                        'category' => $article['news_desk'],
                        'author' => $article['byline']['original'],
                        'image_url' => count($article['multimedia']) > 0 ? 'https://www.nytimes.com/'.$article['multimedia'][0]['url'] : null,
                        'published_at' => $article['pub_date']
                    ]
                );
            }
        } catch (Exception $e) {
            $this->logExceptionError(__('articles.error_inserting_articles_new_york_times_api'), $e);
        }
    }
}
