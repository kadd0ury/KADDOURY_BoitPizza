@extends('layout.mainlayout')
@section('content')

<section class="bg-8 h-500x main-slider pos-relative">
    <div class="triangle-up pos-bottom"></div>
    <div class="container h-100">
        <div class="dplay-tbl">
            <div class="dplay-tbl-cell center-text color-white pt-90">
                <h5><b>
                        Meilleur Produits</b></h5>
                <h3 class="mt-30 mb-15">Mes commandes</h3>
            </div><!-- dplay-tbl-cell -->
        </div><!-- dplay-tbl -->
    </div><!-- container -->
</section>

<section class="counter-section center-text pt-0" id="counter">
    <div class="container">
        <h5 class="font-30 mb-70 mb-sm-40 left-text"><b style="font-size: 25px;">Mes Produits
                <span class="badge badge-dark" style="font-size: 62%;margin: 1px;">{{$nbrproduct}}</span>
            </b></h5>


        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="mb-30 ">
                    <i class="mlr-auto mb-30  icon-gradient icon-pizza"></i>
                    <h2><b><span class="counter-value" data-duration="400" style="font-size: 30px;" data-count="{{$nbrpizza}}">0</span></b></h2>
                    <h5 class="semi-black"><b>Pizza</b></h5>
                </div><!-- margin-b-30 -->
            </div><!-- col-md-3-->

            <div class="col-sm-6 col-md-3">
                <div class="mb-30">
                    <i class="mlr-auto mb-30 icon-gradient icon-sea-food"></i>
                    <h2><b><span class="counter-value" data-duration="1400" style="font-size: 30px;" data-count="{{$nbrdesert}}">0</span></b></h2>
                    <h5 class="semi-black"><b>Desserts</b></h5>
                </div><!-- margin-b-30 -->
            </div><!-- col-md-3-->

            <div class="col-sm-6 col-md-3">
                <div class="mb-30">
                    <i class="mlr-auto mb-30 icon-gradient icon-pasta"></i>
                    <h2><b><span class="counter-value" data-duration="300" style="font-size: 30px;" data-count="{{$nbrboissons}}">0</span></b></h2>
                    <h5 class="semi-black"><b>Boissons</b></h5>
                </div><!-- margin-b-30 -->
            </div><!-- col-md-3-->

            <div class="col-sm-6 col-md-3">
                <div class="mb-30">
                    <i class="mlr-auto mb-30 icon-gradient icon-salad"></i>
                    <h2><b><span class="counter-value" data-duration="1000" style="font-size: 30px;" data-count="{{$nbrsalades}}">0</span></b></h2>
                    <h5 class="semi-black"><b>Salades</b></h5>
                </div><!-- margin-b-30 -->
            </div><!-- col-md-3-->

        </div><!-- row-->
    </div><!-- container-->
</section><!-- counter-section-->

<section class="counter-section center-text pt-0" id="counter">
    <div class="container">
        <h5 class="font-30 mb-70 mb-sm-40 left-text"><b style="font-size: 25px;">Mes Commandes
                <span class="badge badge-dark" style="font-size: 62%;margin: 1px;">{{$commandes->count()}}</span></b></h5>
        @if ($commandes->count() == 0)
        <div class="row">

            <div class="col-md-4 offset-md-4" style="font-size: 16px;color: #495057;">
                <strong>
                    Vous n'avez pas passé aucune commande

                </strong>
            </div>
        </div>
        @else
        @foreach($commandes as $item)
        <div class="accordion" id="accordionExample">
            <div class="card" style="width:50rem;">
                <div class="card-header" id="headingOne">
                    <h6 class="mb-0">
                        <button class="btn btn-dark" style="float: left;" type="button" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapseOne">
                            Commande : <span class="badge badge-light">{{\App\Http\Controllers\OrdersDisplaying::totalprix($item->id)}}€</span>
                        </button>
                        <form action="{{route('generatepdf',$item->id)}}" method="Post">
                         @csrf
                        <div style="float: right;padding: 10px">
                            <i class="fa fa-clock-o" aria-hidden="true"></i>  {{$item->dateCom}}
                            <button type="submit" style="height: 30px;width: 39px;" class="btn btn-dark"><i class="fa fa-download" aria-hidden="true"></i></button>
                        
                        </div>
                        </form> 
                    </h6>
                </div>

                <div id="collapse1" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        <div class="container">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col">Image</th>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Quantité</th>
                                        <th scope="col">Prix</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach(App\Models\LigneCommande::where('commande_id',$item->id)->get() as $ttpc)
                                    <tr>

                                        <td><img src="{{DB::table('produits')->where('id',$ttpc->produit_id)->value('categorries')}}" style="height: 60px; width: 60px;"></td>
                                        <td>{{DB::table('produits')->where('id',$ttpc->produit_id)->value('nom')}}</td>
                                        <td>{{DB::table('ligne_commandes')->where('produit_id',$ttpc->produit_id)->value('nb')}}</td>
                                        <td>{{DB::table('produits')->where('id',$ttpc->produit_id)->value('prix')}}€</td>
                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>





        </div>
        @endforeach

        @endif
    </div><!-- container-->
</section><!-- counter-section-->

@endsection