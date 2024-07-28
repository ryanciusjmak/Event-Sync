<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TicketPurchase;
use App\Models\Event; // Adicione isso para acessar o modelo Event
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class StripeController extends Controller
{
    public function session(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $productname = $request->get('productname');
        $totalprice = $request->get('total');
        $total = $totalprice * 100; // Convert to cents
        $eventId = $request->get('event_id');  // Obtenha o event_id do request

        $session = \Stripe\Checkout\Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'USD',
                        'product_data' => [
                            "name" => $productname,
                        ],
                        'unit_amount'  => $total,
                    ],
                    'quantity'   => 1,
                ],
            ],
            'mode'        => 'payment',
            'success_url' => route('success') . '?event_id=' . $eventId,  // Passe o event_id na URL de sucesso
        ]);

        return redirect()->away($session->url);
    }

    public function success(Request $request)
{
    $eventId = $request->query('event_id');
    $userId = Auth::id();

    if ($eventId === null) {
        return "Erro: O ID do evento não foi fornecido.";
    }

    $event = Event::find($eventId);

    if (!$event) {
        return "Erro: Evento não encontrado.";
    }

    // Salve a compra do ticket no banco de dados
    TicketPurchase::create([
        'user_id' => $userId,
        'event_id' => $eventId,
        'amount_paid' => $event->price,
    ]);

    // Adicione o usuário ao evento
    $user = User::find($userId);
    $user->eventsAsParticipant()->attach($eventId);

    return redirect()->route('dashboard')->with('success', 'Ticket purchased successfully!');
}
}
