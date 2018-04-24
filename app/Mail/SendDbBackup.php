<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendDbBackup extends Mailable
{
    use Queueable, SerializesModels;

    public $backupName;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($backupName)
    {
        $this->backupName = $backupName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $backupName = $this->backupName;
        return $this->from('AOETec@aoetec.com')
                    ->view('mail.send_db_backup')
                    ->attach('./'.$backupName);
    }
}
