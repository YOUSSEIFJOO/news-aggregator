<?php

namespace App\Jobs;

use App\Traits\LogTrait;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class HandleArticlesNewYorkTimesApiJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, LogTrait;

    protected int $page = 1;
    protected int $stopPageNumberFetching = 20;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            do {
                FetchArticlesNewYorkTimesApiJob::dispatch($this->page);
                $this->page++;
            } while ($this->page <= $this->stopPageNumberFetching);
        } catch (Exception $e) {
            $this->logExceptionError(__('articles.error_handling_job_new_york_times_api'), $e);
        }
    }
}
