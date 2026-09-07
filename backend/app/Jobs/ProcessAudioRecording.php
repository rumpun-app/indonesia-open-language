<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\AudioRecording;

class ProcessAudioRecording implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public AudioRecording $recording) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->recording->update(['processing_status' => 'processed', 'review_status' => 'pending']);
    }
}
