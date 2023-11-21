<?php

namespace App\Jobs;

use App\Mail\RegistrationSuccessMail;
use App\Mail\UserReportMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $request;
    public function __construct($user, $request)
    {
        $this->user = $user;
        $this->request = $request;
    }

    public function handle(): void
    {
        // send registration success email
        Mail::to($this->request->email)->send(new RegistrationSuccessMail($this->user));

        $users = User::latest()->take(4)->get();
        // latest 4 users mail to admin
        Mail::to('admin@gmail.com')->send(new UserReportMail($users));

    }
}
