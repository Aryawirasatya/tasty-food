<?php

namespace App\Mail;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessageNotification extends Mailable
{
    use Queueable, SerializesModels;

    public ContactMessage $messageModel;

    public function __construct(ContactMessage $messageModel)
    {
        $this->messageModel = $messageModel;
    }

    public function build()
    {
        return $this->subject('[Kontak] '.$this->messageModel->subject)
            // Supaya admin bisa langsung reply ke pengirim
            ->replyTo($this->messageModel->email, $this->messageModel->nama)
            ->view('emails.contact_message'); // blade di langkah 3
    }
}
