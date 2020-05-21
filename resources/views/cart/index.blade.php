@extends('layout.mainlayout')
@section('content')


<section class="story-area left-text center-sm-text pos-relative">
        <div class="container">
        <br>  
                <div class="heading">
                        <h2>Mon panier</h2>
                </div>

@if (Cart::count()>0)
<div class="px-4 px-lg-0">
 
  <div class="pb-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">

          <!-- Shopping cart table -->
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col" class="border-0 bg-light">
                    <div class="p-2 px-3 text-uppercase">Product</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Price</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Quantity</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Remove</div>
                  </th>
                </tr>
              </thead>
              <tbody>
              @foreach(Cart::content() as $product)

              <tr>
                  <th scope="row" class="border-0">
                    <div class="p-2">
                      <img src="{{URL::asset($product->model->categorries)}}" alt="" style="width: 20%" class="img-fluid rounded shadow-sm">
                      <div class="ml-3 d-inline-block align-middle">
                        <h5 class="mb-0"> <a href="#" class="text-dark d-inline-block align-middle">{{$product->model->nom}}</a></h5><span class="text-muted font-weight-normal font-italic d-block">Category:{{App\Models\Produit::find($product->model->id)->category->nomCat}}</span>
                      </div>
                    </div>
                  </th>
                  <td class="border-0 align-middle"><strong>{{$product->model->prix}}€</strong></td>
                  <td class="border-0 align-middle"><strong>1</strong></td>
                  <td class="border-0 align-middle">
                  <form action="{{route('cart.destroy',$product->rowId)}}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="text-dark"><i class="fa fa-trash"></i></button>
                  </form>
                  </td>
                </tr>
                
               @endforeach
              </tbody>
            </table>
          </div>
          <!-- End -->
        </div>
      </div>


    </div>
  </div>
</div>

@else

<div class="row">
  <div class="col-md-4 offset-md-4">
  <p>Votre panier ne contient aucun produit.</p>
  </div>
</div>


@endif    
</section>


@endsection