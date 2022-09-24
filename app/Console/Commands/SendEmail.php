<?php

namespace App\Console\Commands;

use App\Mail\EmailSend;
use App\Models\User;
use App\Models\ShortLink;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send email notification to user about expire url ';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        // Get all notification for today
        $expiredShortLinks = ShortLink::where('expire_date', now()->format('Y-m-d H:i:s'))
        ->orderBy('user_id')
        ->get();

        $data = [];
        foreach ($expiredShortLinks as $expiredShortLink) {
            // find the users and push emails in array (if the email NOT exists push if it exists ignore )
            $user = User::find($expiredShortLink->user_id);
            if (!In_array("$user->email",$data)) {
                array_push($data, $user->email);
                // send an email for the users
                $this->sendEmailToUser($user->email);
            }
        }

    }

    private function sendEmailToUser($email)
    {
        Mail::to($email)->send(new EmailSend());
    }
}
