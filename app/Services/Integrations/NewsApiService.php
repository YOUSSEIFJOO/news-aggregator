<?php

namespace App\Services\Integrations;

use App\Models\Article;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Http;

class NewsApiService extends AbstractNewsApiService
{
    protected string $apiKeyName = 'news-api';

    public function fetchArticles($page = 1, $pageSize = 10)
    {
        try {
            $response = Http::get($this->apiUrl, [
                'apiKey' => $this->apiKey,
                /**
                 * The api require one or all some parameters to be in the APi. So I used this parameter and
                 * make this "a" because any title or description or content
                 * in most of the cases will contain this character
                */
                'q' => 'a',
                'from' => Carbon::now()->format('Y-m-d\TH:i:s'),
                'page' => $page,
                'pageSize' => $pageSize,
            ]);

            if ($response->failed())
                $this->logErrorWithData(__('articles.error_fetching_articles_news_api'), $response->json());

            return $response->json()['articles'];
        } catch (Exception $e) {
            $this->logExceptionError(__('articles.error_fetching_articles_news_api'), $e);
            return [];
        }
    }

    public function insertInDatabase($data): void
    {
        try {
            foreach($data as $article) {
                if($article['title'] != '[Removed]') {
                    Article::updateOrCreate(
                        [
                            'url' => $article['url'],
                        ],
                        [
                            'title' => $article['title'],
                            'description' => $article['description'],
                            'content' => $article['content'],
                            'source' => $article['source']['name'],
                            'author' => $article['author'],
                            'image_url' => $article['urlToImage'],
                            'published_at' => $article['publishedAt']
                        ]
                    );
                }
            }
        } catch (Exception $e) {
            $this->logExceptionError(__('articles.error_inserting_articles_news_api'), $e);
        }
    }
}
