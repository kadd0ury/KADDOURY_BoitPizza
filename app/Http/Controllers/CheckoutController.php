<?php

namespace App\Http\Controllers;
use Gloudemans\Shoppingcart\Facades\Cart;
use Stripe\PaymentIntent;
use App\Models\Commande;
use App\Models\LigneCommande;
use Stripe\Stripe;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        if (Cart::count()== 0){
            return redirect()->route('index');
        }
        
        Stripe::setApiKey('sk_test_03VrhZwKvxOTlovj34UP62Df000UaYrwVx');
        $intent = PaymentIntent::create([
            'amount' => round (Cart::total()),
            'currency' => 'usd', 
          ]);
          $clientsecret = Arr::get($intent,'client_secret');
        return view ('checkout.index' ,[
      'clientsecret' =>$clientsecret
        ]
        );
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
    public function store(Request $request)
    {
        
       
  
        
        $commande =Commande::create([
        'client_id'=>31,
        'adresseliv'=>$request->adresseliv,
        'type'=>$request->type,
        'ville'=>$request->ville,
        'secteur'=>$request->secteur,
        'telephone'=>$request->telephone,
         ]);

         

        
        foreach(Cart::content() as $item ){
        $commandeligne=LigneCommande::create([
        'commande_id'=> $commande->id,
        'produit_id' => $item->model->id,
        'nb'         => $item->qty ,
       ]);     
        }

        
        //return  $data ['paymentIntent'];
        //$commande = new Commande();
        //$commande->adresseliv=$data['paymentIntent']['id'];
        //$commande->realise=$data['paymentIntent']['amount'];
        //$commande->client_id=31;
        //$commande->save();
        $data = $request->json()->all();
        if ($data['paymentIntent']['status']=='succeeded'){
            dd($commande);
            Cart::destroy();
            Session::flash('success','');

            return response()->json(['success'=>'Payment Intent succeeded']);
        }
        else {
        
            return response()->json(['error'=>'Payment Intent not succeeded']);

        } 
        

       

        
    }

   // public function merci()
    //{
    //    return Session::has('success')?view('checkout.merci'):

    //    redirect()->route('index');
    //}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
