<?php

namespace App\Http\Controllers;

use App\DataTables\TicketReplyDataTable;
use Illuminate\Http\Request;

class TicketReplyController extends Controller
{
    public function index(TicketReplyDataTable $dataTable)
    {
        return $dataTable->render('backend.ticket-reply.index');
    }
}
