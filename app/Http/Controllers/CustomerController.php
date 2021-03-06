<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Stripe\Stripe as Stripe;
use Stripe\Account as StripeAccount;
use Stripe\Charge as StripeCharge;
use Stripe\Token as StripeToken;
use Stripe\Coupon as StripeCoupon;
use Stripe\Customer as StripeCustomer;

class CustomerController extends Controller
{
    private $stripeConfig;
    public function __construct()
    {   
        $this->stripeConfig = \Config::get('stripe');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('customer.create');      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $token = $request->input('stripeToken');
        $email = $request->input('email');

        Stripe::setApiKey($this->stripeConfig['testSecretKey']);

        $customer = StripeCustomer::create([
            "email" => $email,
            "description" => "Description of $email",
            "source" => $token // obtained with Stripe.js
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($customerID)
    {
        Stripe::setApiKey($this->stripeConfig['testSecretKey']);

        $customerRetrieve = StripeCustomer::retrieve($customerID);

        /*echo '<pre>';
        print_r($customerRetrieve);
        echo '</pre>';*/

        return view('customer.show', compact('customerRetrieve'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
