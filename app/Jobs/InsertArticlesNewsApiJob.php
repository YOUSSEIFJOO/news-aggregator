<?php

namespace App\Jobs;

use App\Services\Integrations\NewsApiService;
use App\Traits\LogTrait;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class InsertArticlesNewsApiJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, LogTrait;

    protected array $articles;

    /**
     * Create a new job instance.
     */
    public function __construct($articles)
    {
        $this->articles = $articles;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            (new NewsApiService)->insertInDatabase($this->articles);
        } catch (Exception $e) {
            $this->logExceptionError(__('articles.error_inserting_job_guardian_api'), $e);
        }

    }
}
