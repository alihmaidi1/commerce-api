<?php

namespace App\Jobs;

use App\Mail\verifyaccount;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class sendVerifyMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

     public $email,$code;


     public function __construct($email,$code)
     {
         $this->email=$email;
         $this->code=$code;

     }
    /**
     * Execute the job.
     */
    public function handle(): void
    {

        Mail::to($this->email)->send(new verifyaccount($this->code));


    }
}