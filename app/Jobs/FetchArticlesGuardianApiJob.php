<?php

namespace App\Jobs;

use App\Services\Integrations\TheGuardianApiService;
use App\Traits\LogTrait;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FetchArticlesGuardianApiJob implements ShouldQueue
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
            $articles = (new TheGuardianApiService())->fetchArticles($this->page);
            if(count($articles) > 0)
                InsertArticlesNewsApiJob::dispatch($articles);
        } catch (Exception $e) {
            $this->logExceptionError(__('articles.error_fetching_job_guardian_api'), $e);
        }

    }
}
