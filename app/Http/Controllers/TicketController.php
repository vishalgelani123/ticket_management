<?php

namespace App\Http\Controllers;

use App\DataTables\TicketAdminDataTable;
use App\DataTables\TicketDataTable;
use App\Http\Requests\TicketStoreRequest;
use App\Models\Category;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TicketController extends Controller
{
    public function index(TicketDataTable $dataTable)
    {
        return $dataTable->render('backend.ticket.index');
    }

    public function admin(TicketAdminDataTable $dataTable)
    {
        $categories = Category::all();
        return $dataTable->render('backend.ticket.indexAdmin', compact('categories'));

    }

    public function filter(TicketAdminDataTable $dataTable)
    {
        $categories = Category::all();

        return $dataTable->render('backend.ticket.indexAdmin',compact('categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('backend.ticket.create', compact('categories'));
    }

    public function store(TicketStoreRequest $request)
    {
        try {
            $ticket = new Ticket;
            $ticket->user_id = Auth::id();
            $ticket->category_id = $request->category;
            $ticket->title = $request->title;
            $ticket->description = $request->description;
            $ticket->save();


//            Mail::send('admin.emails.users.create', compact('user'), function ($message) use ($user) {
//                $message->to($user->email)->subject('Welcome to ' . config('app.name'));
//            });
            return redirect()->route('tickets.index')->with(['success' => 'Ticket created successfully']);
        } catch (\Exception $e) {
            return redirect()->route('tickets.index')->with(['error' => $e->getMessage()]);
        }
    }

    public function updateStatus(Request $request)
    {
        $ticket = Ticket::find($request->user_id);
        $ticket->status = $request->status;
        $ticket->save();
        return response()->json(['success' => 'Status change successfully.']);
    }

    public function getDetails(Request $request)
    {
        $ticket = Ticket::where('id', $request->user_id)->first();

        if ($ticket) {
            return response()->json([
                'title' => $ticket->title,
                'description' => $ticket->description,
                'status' => $ticket->status,
                'category' => $ticket->category->name,
                'ticket_reply' => $ticket->ticket_reply,
                'created_at' => $ticket->created_at->format('Y-m-d'), // Format the date
            ]);
        } else {
            return response()->json(['error' => 'Ticket not found'], 404);
        }
    }

    public function sendMail(Request $request)
    {
        $ticket = Ticket::find($request->ticket_id);

        if (!$ticket) {
            return response()->json(['success' => false, 'message' => 'Ticket not found.']);
        }
        $reply = $request->reply;
        $ticket->ticket_reply = $reply;
        $ticket->status = 'close';
        $ticket->save();

        Mail::send('backend.ticket.mailReply', compact('ticket'), function ($message) use ($ticket) {
            $message->to($ticket->user->email)->subject('Welcome to ' . config('app.name'));
        });

        return response()->json(['success' => true, 'message' => 'Reply saved successfully.']);

    }


    public function delete(Ticket $user)
    {
        try {
            if ($user->delete()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Ticket deleted successfully'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => "Ticket not found!"
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

}
