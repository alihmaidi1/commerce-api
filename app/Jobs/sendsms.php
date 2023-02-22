<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Twilio\Rest\Client;

class sendsms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $phone,$code;
    public function __construct($phone,$code)
    {
        $this->phone=$phone;
        $this->code=$code;

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {


            $client = new Client(env("TWILIO_SID"), env("TWILIO_SECRET"));
            $client->messages->create("+4368181744368", [
                'from' => env("TWILIO_FROM"),
                'body' => "hello user you can reset password by this code :".$this->code]);


    }
}
