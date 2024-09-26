<?php

namespace App\Jobs;

use App\Mail\RecapMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendRecapMail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $users = User::all();
        foreach ($users as $user) {
            Mail::to($user->email)->send(new RecapMail([
                'username' => $user->username,
                'postCount' => $user->posts()->count(),
                'followersCount' => $user->followers()->count(),
                'followingsCount' => $user->following()->count(),
            ]));
        }
    }
}
