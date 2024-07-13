<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;

class UserController extends Controller
{
    public function purchase(Request $request)
    {
        // Set Stripe API Key
       // Stripe::setApiKey(env('STRIPE_SECRET'));

        $user = User::firstOrCreate(
            [
                'email' => $request->input('email'),
            ],
            [
                'password' => Hash::make(Str::random(12)),
                'name' => $request->input('first_name') . ' ' . $request->input('last_name'),
                'address' => $request->input('address'),
                'city' => $request->input('city'),
                'state' => $request->input('state'),
                'zip_code' => $request->input('zip_code')
            ]
        );

        try {
            $user->createOrGetStripeCustomer();

            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => $request->input('amount'),
                'currency' => 'usd',
                'payment_method' => $request->input('payment_method_id'),
                'customer' => $user->stripe_id,
                'confirm' => true,
                'return_url' => url('/summary'), // Specify your return URL here
                'automatic_payment_methods' => [
                    'enabled' => true,
                    'allow_redirects' => 'never',
                ],
            ]);

            if (isset($paymentIntent->charges) && isset($paymentIntent->charges->data[0])) {
                $transactionId = $paymentIntent->charges->data[0]->id;
                $totalAmount = $paymentIntent->charges->data[0]->amount;

                $order = $user->orders()->create([
                    'transaction_id' => $transactionId,
                    'total' => $totalAmount,
                ]);

                foreach (json_decode($request->input('cart'), true) as $item) {
                    $order->products()->attach($item['id'], ['quantity' => $item['quantity']]);
                }

                $order->load('products');

                return response()->json($order, 201);
            } else {
                Log::error('Purchase error: PaymentIntent charges data is missing or null');
                return response()->json(['message' => 'Payment processing error'], 500);
            }

        } catch (\Exception $ex) {
            Log::error('Purchase error: ' . $ex->getMessage());
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }
}
