@extends('layout.mainlayout')
@section('content')
<section class="story-area left-text center-sm-text pos-relative">
    <div class="container">
        <br><br>
        <div class="heading">
            <img class="heading-img" src="assets/images/heading_logo.png" alt="">
            <h2 style="font-size: 40px;">{{$product->nom}}</h2>
        </div>

        @if ($product->remise==0)

        <div class="row mb-2">
            <div class="col-md-10">
                <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <h4 class="d-inline-block mb-2 text-success">Category:{{App\Models\Produit::find($product->id)->category->nomCat}}</h4>
                        <h5 class="mb-0" style="text-transform: UPPERCASE;font-weight: bold;">{{ $product->nom }}</h5>
                        <div class="rating">
                            <div class="stars">
                                <span class="fa fa-star checked" style="color: #ff9f1a;"></span>
                                <span class="fa fa-star checked" style="color: #ff9f1a;"></span>
                                <span class="fa fa-star checked" style="color: #ff9f1a;"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                            </div>
                            <span class="review-no">41 reviews</span>
                        </div>
                        <hr>
                        <p class="mb-auto text-muted">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <h5 class="mb-auto font-weight-normal text-secondary" style=" text-transform: UPPERCASE;
  font-weight: bold;">current price: <span style="color: #ff9f1a;">{{ $product->prix }}$</span></h5>
                        <form action="{{route('cart.store')}}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{$product->id}}">


                            <button type="submit" class="btn btn-danger mt-3" style="background-color:#EF0031;border-color:#EF0031">
                                <i class="icon ion-ios-cart-outline"></i>Ajouter au panier</a></button>

                        </form>
                    </div>
                    <div class="col-auto d-none d-lg-block">
                        <img style="width:250%;" src="{{URL::asset($product->categorries)}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>



    @else
    <div class="row mb-2">
        <div class="col-md-10">
            <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                    <h4 class="d-inline-block mb-2 text-success">Category:{{App\Models\Produit::find($product->id)->category->nomCat}}</h4>
                    <h5 class="mb-0" style="text-transform: UPPERCASE;font-weight: bold;">{{ $product->nom }}</h5>
                    <div class="rating">
                        <div class="stars">
                            <span class="fa fa-star checked" style="color: #ff9f1a;"></span>
                            <span class="fa fa-star checked" style="color: #ff9f1a;"></span>
                            <span class="fa fa-star checked" style="color: #ff9f1a;"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                        <span class="review-no">41 reviews</span>
                    </div>
                    <hr>
                    <p class="mb-auto text-muted">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <h5 class="mb-auto font-weight-normal text-secondary" style=" text-transform: UPPERCASE;
  font-weight: bold;">current price: <span style="color: #ff9f1a;">{{ $product->prix }}$</span>
                        <h6 style="color: green;"> (-{{$product->remise}}%)</h6>
                    </h5>
                    <form action="{{route('cart.store')}}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{$product->id}}">


                        <button type="submit" class="btn btn-danger mt-3" style="background-color:#EF0031;border-color:#EF0031">
                            <i class="icon ion-ios-cart-outline"></i>Ajouter au panier</a></button>

                    </form>
                </div>
                <div class="col-auto d-none d-lg-block">
                    <img style="width:270%;" src="{{URL::asset($product->categorries)}}" alt="">
                </div>
            </div>
        </div>
    </div>
    </div>

    @endif
    </div>


    <div class="container">

  <div class="row">

    <div class="col-sm-8 col-sm-offset-1" id="logout">
        <div class="page-header">
            <h3 class="reviews" style="font-size: 33px;">Laissez vos avis
            <i class="fa fa-commenting" aria-hidden="true"></i>
        </h3>
         
        </div>


        
        <div class="comment-tabs">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#comments-logout" role="tab" data-toggle="tab"><h4 class="reviews text-capitalize">{{$comments->count()}} Commentaires</h4></a></li>
            </ul>   
            @foreach($comments as $item)
            <div class="tab-content">
                <div class="tab-pane active" id="comments-logout">                
                    <ul class="media-list">
                      <li class="media">
                        <a class="pull-left" style="margin-right:-100px">
                          <img class="rounded-circle"  style ="width: 29%;" src="{{URL::asset(DB::table('clients')->where('id',$item->client_id)->value('image'))}}" alt="profile">
                        </a>
                        <div class="media-body">
                          <div class="well well-lg">
                              <h6 class="media-heading text-uppercase reviews"><span style="color: blue;">
                              {{DB::table('clients')->where('id',$item->client_id)->value('nom')}}
                              {{DB::table('clients')->where('id',$item->client_id)->value('prenom')}}
                            </span>
                              <span style="float: right;"><i class="fa fa-clock-o" aria-hidden="true"></i> {{$item->date_pub}}</span></h6>
                              
                              <p class="media-comment">
                                {{$item->texte}}
                              </p>
                          </div>              
                        </div>
                      
                      </li>          
                   
                  
                    </ul> 
                </div> 
            </div>
            @endforeach


            <div class="tab-pane" id="add-comment">
                    <form action="{{route ('comments',$product->id)}}" method="post" class="form-horizontal" id="commentForm" role="form"> 
                    @csrf    
                    <div class="form-group">
                            <label for="texte" class="col-sm-2 control-label"></label>
                            <div class="col-sm-10">
                              <textarea class="form-control" name="texte" id="texte" rows="5" placeholder="write comment"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">                    
                                <button class="btn btn-success btn-circle text-uppercase" type="submit" id="submitComment"><span class="glyphicon glyphicon-send"></span>Publier</button>
                            </div>
                        </div>            
                    </form>
                </div>
            

            





        </div>
  </div>
</section>





@endsection