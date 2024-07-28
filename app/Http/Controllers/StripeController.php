<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TicketPurchase;
use App\Models\Event; // Adicione isso para acessar o modelo Event
use Illuminate\Support\Facades\Auth;

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
        // Pegue o ID do evento da URL de sucesso
        $eventId = $request->query('event_id');  // Use query para pegar o parâmetro da URL
        $userId = Auth::id();

        // Verifique se o event_id não é nulo
        if ($eventId === null) {
            return "Erro: O ID do evento não foi fornecido.";
        }

        // Obtenha o evento do banco de dados
        $event = Event::find($eventId);

        // Verifique se o evento existe
        if (!$event) {
            return "Erro: Evento não encontrado.";
        }

        // Salve a compra do ticket no banco de dados
        TicketPurchase::create([
            'user_id' => $userId,
            'event_id' => $eventId,
            'amount_paid' => $event->price, // Pegue o preço do evento
        ]);

        return redirect()->route('dashboard')->with('success', 'Ticket purchased successfully!');
    }
}
