@extends('layout.mainlayout')
@section('content')


<section class="story-area left-text center-sm-text pos-relative">
        <div class="container">
        <br><br>    
                <div class="heading">
                        <img class="heading-img" src="assets/images/heading_logo.png" alt="">
                        <h2>{{$product->nom}}</h2>
                </div>

                <div class="container-fluid">
    <div class="row">
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-horizontal">
                    <div class="img-square-wrapper">
                        <img class="" src="{{URL::asset($product->categorries)}}" alt="Card image cap">
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">{{$product->nom}}<b class="color-primary float-right">${{$product->prix}}</b></h4>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
                <div class="card-footer">
                <form action="{{route('cart.store')}}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{$product->id}}">
                
           
                <button type="submit" class="btn btn-danger mt-3" style="float:right;background-color:#EF0031;border-color:#EF0031">
                <i class="icon ion-ios-cart-outline"></i>Ajouter au panier</a></button>
                
                </form>
                </div>
            </div>
        </div>
    </div>
</div>



       
</section>






@endsection