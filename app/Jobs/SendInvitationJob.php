<?php

namespace App\Jobs;

use App\Mail\InvitationMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendInvitationJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public $invite;
    public function __construct($invite)
    {
        $this->invite=$invite;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->invite->email)->send(new InvitationMail($this->invite) );
    }
}
