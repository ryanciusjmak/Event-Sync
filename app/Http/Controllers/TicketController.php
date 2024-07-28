<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TicketPurchase;

class TicketController extends Controller
{
    public function requestRefund($id)
    {
        $purchase = TicketPurchase::find($id);

        if (!$purchase) {
            return redirect()->route('dashboard')->with('error', 'Ticket purchase not found.');
        }

        // Aqui você pode adicionar lógica para processar o reembolso, como interagir com a API do Stripe

        $purchase->delete();

        return redirect()->route('dashboard')->with('success', 'Refund requested successfully.');
    }
}