<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentStoreRequest;
use App\Payment;
use Auth;
use Illuminate\Http\Request;
use Stripe\{Stripe, Charge, Customer};

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentStoreRequest $request)
    {

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $token  = $request->get('stripeToken');

        $customer = Customer::create(array(
            'email' => Auth::user()->email,
            'source'  => $token
        ));

        $charge = Charge::create(array(
            'customer' => $customer->id,
            'amount'   => $request->get('amount') * 100,
            'currency' => 'cad'
        ));

        $payment = Payment::create([
            'user_id' => Auth::user()->id,
            'amount' => $request->get('amount') * 100
        ]);

        return back()->with('status', 'Payment received.  Check out your ranking.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
