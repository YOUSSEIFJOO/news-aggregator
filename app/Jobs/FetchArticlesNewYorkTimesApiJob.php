<?php

namespace App\Jobs;

use App\Services\Integrations\NewYorkTimesApiService;
use App\Traits\LogTrait;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FetchArticlesNewYorkTimesApiJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, LogTrait;

    protected int $page;

    /**
     * Create a new job instance.
     */
    public function __construct($page)
    {
        $this->page = $page;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $articles = (new NewYorkTimesApiService())->fetchArticles($this->page);
            if(count($articles) > 0)
                InsertArticlesNewYorkTimesApiJob::dispatch($articles);
        } catch (Exception $e) {
            $this->logExceptionError(__('articles.error_fetching_job_new_york_times_api'), $e);
        }

    }
}
