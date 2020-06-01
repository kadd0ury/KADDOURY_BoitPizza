@extends('layout.mainlayout')
@section('extra-script')
<script src="https://js.stripe.com/v3/"></script>
@endsection

@section('extra-meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection


@section('content')

<section class="story-area left-text center-sm-text pos-relative">
        <div class="container">
        <br><br><br>
                <div class="heading">
                        <h2>Confirmez vos informations</h2>
                </div>
                <div class="row">
                <div class="col-md-12">
                <form action="{{route('checkout.store')}}" method="POST" id="payment-form"  class="my-4">
                @csrf

             <div class="form-row">
              <div class="form-group col-md-6">
              <label  style="color: #5e6977;" for="secteur">Secteur:</label>
            <input type="text" id ="secteur" class="form-control" name="secteur"/>
             </div>
             <div class="form-group col-md-6">
             <label for="type">Type de Livraison:</label>
            <input type="text" id="type" class="form-control" name="type"/>
             </div>
             <div class="form-group col-md-6">
             <label for="ville">Ville:</label>
            <input type="text" id="ville" class="form-control" name="ville"/>
             </div>
             <div class="form-group col-md-6">
             <label for="telephone">Telephone:</label>
            <input type="text" id ="telephone" class="form-control" name="telephone"/>
             </div>
             
             <div class="form-group col-md-12">
             <label for="adresseliv">Adresse de Livraison:</label>
            <textarea class="form-control" id ="adresseliv" name="adresseliv"></textarea>
             </div>
        </div>
       

                
                <div id="card-element">
                    <!-- Elements will create input elements here -->
 
                </div>
              

                <!-- We'll put the error messages in this element -->
                <div id="card-errors" role="alert"></div>
                <div style="text-align:center;">
                <button class="btn btn-success mt-4" id="submit">procéder au paiement ({{Cart::total()}}$)</button>
                </div>
              </form>

                </div>
                </div>

                


</div>

@endsection
@section('extra-js')
<script>
var stripe = Stripe('pk_test_hEAdx5fIFhMgGftTjA4n47CF00vCHzdl3J');
var elements = stripe.elements();
var style = {
    base: {
      color: "#32325d",
      fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
      fontSmoothing: "antialiased",
      fontSize: "16px",
      "::placeholder": {
        color: "#aab7c4"
      }
    },
    invalid: {
      color: "#fa755a",
      iconColor: "#fa755a"
    }
    };
var card = elements.create("card", { style: style });
card.mount("#card-element");
card.on('change', ({error}) => {
  const displayError = document.getElementById('card-errors');
  if (error) {
    displayError.textContent = error.message;
    displayError.classList.add('alert','alert-warning');
  } else {
    displayError.classList.remove('alert','alert-warning');
    displayError.textContent = '';
    
  }
});
var form = document.getElementById('submit');
form.addEventListener('click', function(ev) {
  ev.preventDefault();
  form.disabled =true;
  stripe.confirmCardPayment("{{$clientsecret}}", {
    payment_method: {
      card: card,
    }
  }).then(function(result) {
    if (result.error) {
        form.disabled =false;
      // Show error to your customer (e.g., insufficient funds)
      console.log(result.error.message);
    } else {
      // The payment has been processed!
      if (result.paymentIntent.status === 'succeeded') {
        var token=document.querySelector('meta[name="csrf-token"]').getAttribute('content');     
        var paymentIntent=result.paymentIntent;
        var form=document.getElementById('payment-form');
        var url=form.action;
        //var redirect='/merci';

        fetch(
                url,
                {
                        headers:{
                          "Content-Type" : "application/json",
                          "Accept":"application/json,text-plain,*/*",
                          "X-Requested-With":"XMLHttpRequest",
                          "X-CSRF-TOKEN":token
                        },

                        method:'post',
                        body: JSON.stringify({
                                        paymentIntent : paymentIntent
                                })
                        
                }).then((data)=>{
                console.log(data)
                window.location.href=redirect;
        }).catch((error)=>{
                console.log(error)
        })
     
        
      }
    }
  });
});
</script>
@endsection