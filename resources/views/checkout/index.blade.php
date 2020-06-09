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
      <h2>Confirmez vos informations de paiement </h2>
    </div>
    <div class="row">
      <div class="col-md-12">
        <form action="{{route('checkout.store')}}" method="POST" id="payment-form" class="my-4 form-style-1 placeholder-1">
          @csrf

          <div class="form-row">
            <div class="form-group col-md-6">
              <label style="color: #5e6977;" for="secteur"></label>
              <select class="form-control" id="secteur" name="secteur" style="background-color: #EFF6F7;border:0px;height: 50px;">
              <option>Selectionner le secteur</option>
                <option value="secteur 1">Secteur 1</option>
                <option value="secteur 2">Secteur 2 </option>
                <option value="secteur 3">Secteur 3</option>
                <option value="secteur 4">Secteur 4</option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="type"></label>
              <select class="form-control" id="type" name="type" style="background-color: #EFF6F7;border:0px;height: 50px;">
              <option>Selectionner le type de livraison</option>
                <option value="magasin">Magasin</option>
                <option value="domicile">Domicile</option>
                <option value="point relais">Point relais</option>
              </select>
            </div>
            <div class="col-md-6">
              <input type="text" id="ville" class="mb-20" name="ville" placeholder="Ville" />
            </div>
            <div class="col-md-6">
              <input type="text" id="telephone" class="mb-20" name="telephone" placeholder="Téléphone" />
            </div>

            <div class="col-md-12">
              <input class="mb-20" id="adresseliv" name="adresseliv" placeholder="Adresse de livraison">
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
    var card = elements.create("card", {
      style: style
    });
    card.mount("#card-element");
    card.on('change', ({
      error
    }) => {
      const displayError = document.getElementById('card-errors');
      if (error) {
        displayError.textContent = error.message;
        displayError.classList.add('alert', 'alert-warning');
      } else {
        displayError.classList.remove('alert', 'alert-warning');
        displayError.textContent = '';

      }
    });
    var form = document.getElementById('submit');
    form.addEventListener('click', function(ev) {
      ev.preventDefault();
      form.disabled = true;
      stripe.confirmCardPayment("{{$clientsecret}}", {
        payment_method: {
          card: card,
        }
      }).then(function(result) {
        if (result.error) {
          form.disabled = false;
          // Show error to your customer (e.g., insufficient funds)
          console.log(result.error.message);
        } else {
          // The payment has been processed!
          if (result.paymentIntent.status === 'succeeded') {
            var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            var paymentIntent = result.paymentIntent;
            var form = document.getElementById('payment-form');
            var url = form.action;
            var secteur = document.getElementById('secteur').value;
            var ville = document.getElementById('ville').value;
            var type = document.getElementById('type').value;
            var telephone = document.getElementById('telephone').value;
            var adresseliv = document.getElementById('adresseliv').value;
            redirect = '/merci';

            fetch(
              url, {
                headers: {
                  "Content-Type": "application/json",
                  "Accept": "application/json,text-plain,*/*",
                  "X-Requested-With": "XMLHttpRequest",
                  "X-CSRF-TOKEN": token
                },

                method: 'post',
                body: JSON.stringify({
                  paymentIntent: paymentIntent,
                  secteur: secteur,
                  ville: ville,
                  type: type,
                  telephone: telephone,
                  adresseliv: adresseliv,




                })

              }).then((data) => {
              console.log(data)
              window.location.href = redirect;
            }).catch((error) => {
              console.log(error)
            })


          }
        }
      });
    });
  </script>
  @endsection