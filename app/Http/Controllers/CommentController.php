<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Log;
use App\Models\CommentImage;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotification;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required',
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $request->validate(
                    ['image' => 'image|mimes:jpeg,png,jpg,gif',]
                );
            }
        }

        $comment = new Comment();
        $comment->fill($request->all());
        $comment->save();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                $path = "storage/{$path}";
                $commentImage = new CommentImage();
                $commentImage->comment_id = $comment->id;
                $commentImage->image = $path;
                $commentImage->save();
            }
        }

        $log = new Log();
        $log->ticket_id = $request->input('ticket_id');
        $log->user_id = $request->input('user_id');
        $log->action = 'Commented on the ticket.' ;
        $log->save();

        $var = $comment->ticket->ticket_number;
        $viewlink = url('/ticket/'. $var );

        $subject = 'New comment on ticket';
        $data = ['ticket_no'=>$comment->ticket->ticket_number, 'viewlink'=> $viewlink,];
        $view = 'mail.comment';

        Mail::to('abhishek.choudhary13062000@gmail.com', 'Abhishek')->send(new MailNotification($subject, $data, $view));

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
