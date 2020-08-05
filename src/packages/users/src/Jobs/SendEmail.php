<?php

namespace GGPHP\Users\Jobs;

use GGPHP\Users\Mail\NotificationPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $mail = new NotificationPassword($this->data);
        Mail::to($this->data['email'])->send($mail);

        if (Mail::failures()) {
            dispatch(new SendEmail($this->data, Mail::failures(), $this->event))->delay(10);
        }
    }
}
