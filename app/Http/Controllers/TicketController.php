<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Log;
use App\Models\Ticket;
use App\Models\User;
use App\Models\TicketImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotification;


use DataTables;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */

     
    public function index(Request $request)
    {
        $category = Category::select('id','name')->get();
        $user = auth()->user();
        if ($request->ajax()) {

            if (auth()->user()->role == '3') {
                if (!empty($request->get('search'))) {
                    $search = $request->get('search');
                    $data = Ticket::with('user')->whereHas('user', function ($query) use ($search) {
                        $query->where('email', 'LIKE', "%$search%");
                    })->where('user_id', $user->id)->orderBy('created_at', 'DESC');
                } else {
                    $data = Ticket::where('user_id', $user->id)->orderBy('created_at', 'DESC');
                }

            } elseif (auth()->user()->role == '2') {
                if (!empty($request->get('search'))) {
                    $search = $request->get('search');
                    $data = Ticket::with('user')->whereHas('user', function ($query) use ($search) {
                        $query->where('email', 'LIKE', "%$search%");
                    })->where('agent_id', $user->id)->orderBy('created_at', 'DESC');
                } else {
                    $data = Ticket::where('agent_id', $user->id)->orderBy('created_at', 'DESC');
                }

            } else {
                if (!empty($request->get('search'))) {
                    $search = $request->get('search');
                    $data = Ticket::with('user')->whereHas('user', function ($query) use ($search) {
                        $query->where('email', 'LIKE', "%$search%");
                    })->orderBy('created_at', 'DESC');
                } else {
                    $data = Ticket::orderBy('created_at', 'DESC');
                }
            }

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('created_at', function ($row) {
                    $date = date("d F Y", strtotime($row->created_at));
                    return $date;
                })
                ->addColumn('category_id', function ($row) {
                    return $row->category->name;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status) {
                        return 'Closed';
                    } else {
                        return 'Open';
                    }
                })
                ->addColumn('priority', function ($row) {
                    if ($row->priority) {
                        return 'High';
                    } else {
                        return 'Low';
                    }
                })
                ->addColumn('assigned', function ($row) {
                    if ($row->agent_id != NULL) {
                        return 'Yes';
                    } else {
                        return 'No';
                    }
                })

                ->addColumn('email', function ($row) {
                    return $row->user->email;
                })
                ->addColumn('action', function ($row) {
                    $user = auth()->user();
                    if ($user->role == '1') {
                        return '<a href="' . route('ticket.edit', $row->id) .  '"><button class="btn btn-primary p-1">Edit</button></a>
                            <a href="' . route('ticket.show', $row->ticket_number) . '"><button class="btn btn-primary p-1">Details</button></a>
                        <a href="' . route('ticket.log', $row->ticket_number) . '"><button class="btn btn-primary p-1">Logs</button></a>';
                    } else {
                        return '<a href="' . route('ticket.show', $row->ticket_number) . '"><button class="btn btn-primary p-1">Details</button></a>
                        <a href="' . route('ticket.log', $row->ticket_number) . '"><button class="btn btn-primary p-1">Logs</button></a>';
                    }

                })
                ->filter(function ($instance) use ($request) {
                    if ($request->get('status') == '0' || $request->get('status') == '1') {
                        $instance->where('status', $request->get('status'));
                    }
                    if ($request->get('priority') == '0' || $request->get('priority') == '1') {
                        $instance->where('priority', $request->get('priority'));
                    }
                    if ($request->get('category') ) {
                        $instance->where('category_id', $request->get('category'));
                    }
                    if ($request->get('assigned') == '0') {
                        $instance->where('agent_id', null);
                    } elseif ($request->get('assigned') == '1') {
                        $instance->where('agent_id', '<>', null);
                    }

                })
                ->rawColumns(['category_id', 'status', 'priority', 'assigned', 'email', 'action'])
                ->make(true);
        }

        return view('ticket.index', ['category' => $category]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::select('id', 'name')->where('status', 1)->get();
        return view('ticket.create', compact(['category']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required',
            'details' => 'required',
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $request->validate(
                    ['image' => 'image|mimes:jpeg,png,jpg,gif',]
                );
            }
        }

        $ticket = new Ticket();
        $ticket->fill($request->all());
        $ticket->category_id = $request->input('category');
        $ticket->user_id = $request->input('user_id');
        $ticket->save();

        $ticket->ticket_number = 1000000+$ticket->id;
        $ticket->save();

        
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                $path = "storage/{$path}";
                $ticketImage = new TicketImage();
                $ticketImage->ticket_id = $ticket->id;
                $ticketImage->image = $path;
                $ticketImage->save();
            }
        }
        
        $log = new Log();
        $log->ticket_id = $ticket->id;
        $log->user_id = $request->input('user_id');
        $log->action = 'Created the ticket.';
        $log->save();
        
        $var = $ticket->id;
        $editlink = url('/ticket/'. $var . '/edit');
        $ticket_no = $ticket->ticket_number;

        $subject = 'New Ticket Created';
        $data = ['ticket_no'=>$ticket_no, 'editlink'=> $editlink,];
        $view = 'mail.ticketcreated';

        Mail::to('abhishek.choudhary13062000@gmail.com', 'Abhishek')->send(new MailNotification($subject, $data, $view));

        return redirect()->route('ticket.index')->with('success', 'ticket created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $ticket_number)
    {
        $ticket = Ticket::where('ticket_number',$ticket_number)->get();
        return view('ticket.show', compact(['ticket',]));
    }

    /**
     * Display the specified resource.
     */
    public function close(Request $request, string $id)
    {
        Ticket::where('id', $id)->update(['status' => 1]);
        $log = new Log();
        $log->ticket_id = $id;
        $log->user_id = $request->query('user_id');
        $log->action = 'Closed the ticket.';
        $log->save();

        if($log->user->role == '2'){
            $user_role = 2 ;
        }else{
            $user_role = 1;
        }

        $var = $log->ticket->ticket_number;
        $viewlink = url('/ticket/'. $var );

        $subject = 'Ticket Closed';
        $data = ['ticket_no'=>$log->ticket->ticket_number, 'viewlink'=> $viewlink, 'user_role' =>$user_role];
        $view = 'mail.ticketclose';

        Mail::to('abhishek.choudhary13062000@gmail.com', 'Abhishek')->send(new MailNotification($subject, $data, $view));

        return redirect()->route('ticket.index')->with('success', 'ticket closed successfully');
    }
    public function log(Request $request, string $ticket_number)
    {
        $ticket = Ticket::where('ticket_number',$ticket_number)->get();
        foreach($ticket as $value){
            $logs = $value->logs()->get();
            
        }
        return view('ticket.log', [
            'logs' => $logs,
            'ticket' => $ticket,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::select('id', 'name')->where('status', 1)->get();
        $agent = User::select('id', 'name')->where('status', 1)->where('role', 2)->get();
        $ticket = Ticket::find($id);
        return view('ticket.edit', compact(['category', 'ticket', 'agent']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required',
            'details' => 'required',
            'agent' => 'required',
        ]);

        $ticket = Ticket::find($id);
        $agent_previous_id = $ticket->agent_id;
        $ticket->fill($request->all());
        $ticket->category_id = $request->input('category');
        $ticket->agent_id = $request->input('agent');
        $ticket->save();

        if($agent_previous_id != $request->input('agent')){

            $log = new Log();
            $log->ticket_id = $ticket->id;
            $log->user_id = $request->input('user');
            $log->action = 'Assigned the ticket. ';
            $log->save();

            $var = $ticket->ticket_number;
            $viewlink = url('/ticket/'. $var );
    
            $subject = 'New Ticket Created';
            $data = ['ticket_no'=>$ticket->ticket_number, 'viewlink'=> $viewlink,];
            $view = 'mail.ticketassign';

            Mail::to($ticket->agent->email, $ticket->agent->name)->send(new MailNotification($subject, $data, $view));

        }else{
            $log = new Log();
            $log->ticket_id = $ticket->id;
            $log->user_id = $request->input('user');
            $log->action = 'Updated the ticket. ';
            $log->save();
        }
        

        return redirect()->route('ticket.index')->with('success', 'ticket updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}