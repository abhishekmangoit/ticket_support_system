<?php

namespace App\Mail;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Headers;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;


class Mymail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct( public $editlink , public $ticket_no)
    {
       
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New ticket created - Ticket Number :'. $this->ticket_no,
            // replyTo: [
            //     new Address('abhishek.choudhary13062000@gmail.com', 'Abhishek'),
            // ],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'ticket.mail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    public static function assign_email($ticket_no) {
        $data = array('ticket_no'=>$ticket_no);
     
        Mail::send(['html'=>'ticket.assignMail'], $data, function($message) {
           $message->to('abhishek.choudhary13062000@gmail.com', 'Agent')->subject
              ('New Ticket Assigned');
           $message->from('abhishek.choudhary13062000@gmail.com','Admin');
        });
     }

     public static function comment_email($ticket_no) {
        $data = array('ticket_no'=>$ticket_no);
     
        Mail::send(['html'=>'ticket.commentMail'], $data, function($message) {
           $message->to('abhishek.choudhary13062000@gmail.com')->subject
              ('Comment on ticket');
           $message->from('abhishek.choudhary13062000@gmail.com');
        });
     }

     public static function ticketclose_email($ticket_no, $user_role) {
        $data = array('ticket_no'=>$ticket_no, 'user_role'=> $user_role);
     
        Mail::send(['html'=>'ticket.ticketcloseMail'], $data, function($message) {
           $message->to('abhishek.choudhary13062000@gmail.com')->subject
              ('Ticket Closed');
           $message->from('abhishek.choudhary13062000@gmail.com');
        });
     }
}
