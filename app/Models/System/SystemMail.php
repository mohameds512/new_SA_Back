<?php

namespace App\Models\System;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Mail;

use App\Models\Users\User;


//you should the queue with: php artisan queue:listen or php artisan queue:work
//nohup php artisan queue:listen --tries=3 > /dev/null 2>&1 &

//In WHM go Server Configuration/Tweak Settings/Restrict outgoing SMTP to root --> off

class SystemMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $body;
    protected $template;
    protected $data;
    public $from;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title, $template, $data , $from = null)
    {
        $this->title = $title;
        $this->template = $template;
        $this->data = $data;
        if ($from) {
            $this->from($from);
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $data = (object)$this->data;

        if ($this->from){
            return $this->subject($this->title)->view("emails.$this->template", compact('data'));
        }

        return $this->subject($this->title)->view("emails.$this->template", compact('data'));
    }

    public function submit($to, $cc = [], $bcc = [] , $stmp = null)
    {
        if (env('APP_DEBUG') === true) {
            $to =  env("DEV_EMAIL", null);
            $cc = ['khaledeissa122@outlook.com','rania@elnadycompany.com','ahmed.osama@elnadycompany.com', 'Nada@elnadycompany.com', 'malisobh2010@gmail.com', 'a.yehia@elnadycompany.com', 'tamer@elnadycompany.com'];
            $bcc = [];

        }

        if (empty($to) && empty($bcc)) return false;
        if (empty($cc)) $cc = [];
        if (empty($bcc)) $bcc = [];

        if (!is_array($to)) $to = [$to];
        if (!is_array($cc)) $cc = [$cc];
        if (!is_array($bcc)) $bcc = [$bcc];

        try {
            if ($stmp){
                Mail::mailer("$stmp")->to($to)->cc($cc)->bcc($bcc)->send($this);
            }else{
                Mail::to($to)->cc($cc)->bcc($bcc)->send($this);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return true;
    }
}
