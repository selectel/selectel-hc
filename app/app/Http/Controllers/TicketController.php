<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketController extends Controller
{
    protected $api_gateway;

    public function __construct()
    {
        $this->api_gateway = new ApiController();
    }

    public function index()
    {
        $tickets = $this->api_gateway->allTickets();

        return view('index', compact('tickets'));
    }


    public function new(Request $request)
    {
        $result = $this->api_gateway->newTicket($request->ticket_name, $request->comment);

        if (isset($result['error'])) return response()->json(['error' => $result['error']['message']]);
        else return response()->json(['message' => $result]);
    }


    public function show(Request $request)
    {
        $ticket = $this->api_gateway->showTicket($request->ticket_id);

        return view('show_ticket', compact('ticket'));
    }


    public function update(Request $request)
    {
        $result = $this->api_gateway->updateTicket($request->ticket_id, $request->comment);

        if (isset($result['error'])) return response()->json(['error' => $result['error']['message']]);
            else return response()->json(['message' => $result]);
    }

    public function close(Request $request)
    {
        if ($request->score == '10') $result = $this->api_gateway->closeTicket($request->ticket_id, $request->score);
            else $result = $this->api_gateway->closeTicket($request->ticket_id);

        if (isset($result['error'])) return response()->json(['error' => $result['error']['message']]);
            else return response()->json(['message' => $result]);
    }
}
