<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{URL::asset('assets/pdfcss/css.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Bon de Commande</title>
</head>

<body>
    
    <div class="container">
        <div class="row">
            <div class="col-4">
                <img src="{{URL::asset('assets/pdfcss/icone.PNG')}}">
                <p class="title">Luigis</p>
            </div>
            <div class="col-4">
                <p class="txt">Bon de Commande</p>
                <p class="sub-title">Date de création:{{$commandes->dateCom}}</p>
                <p class="sub-title">Date de livraison:{{$commandes->dateCom}}</p>
                <p class="sub-title">Références Externes:{{$commandes->id}}</p>
            </div>
            <div class="col-4" style="position: relative;top: 44px;">

                <p class="sub-title">Nom du client:{{DB::table('clients')->where('id',$commandes->client_id)->value('nom')}}
                {{DB::table('clients')->where('id',$commandes->client_id)->value('prenom')}}
                </p>
                <p class="sub-title">N° Téléphone:{{$commandes->telephone}}</p>
                <p class="sub-title">Référence Commande:{{$commandes->id}}</p>
            </div>
        </div>
        <div class="row" style="padding-top: 26px">
            <div class="col-md-5" style="border-style: inset;">
                <div class="row" style="background-color: darkgray;color: #1d2124;">
                    Adresse de Livraison :</div>
                <div class="row">{{$commandes->adresseliv}}</div>
            </div>
            <div class="col-md-5 offset-md-2">
                <div class="row" style="background-color: darkgray;color: #1d2124;">Adresse de Fournisseur:</div>
                <div class="row">Quartier el Aamal Block 1 Benni-Mellal</div>
            </div>
        </div>
        <div class="row" style="padding-top: 20px">
            <p>Details de la commande :</p>
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th scope="col">Produit</th>
                        <th scope="col">Categorie</th>
                        <th scope="col">Qte</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Remise</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                @foreach(App\Models\LigneCommande::where('commande_id',$commandes->id)->get() as $ttpc)
                    <tr>
                        <td>{{DB::table('produits')->where('id',$ttpc->produit_id)->value('nom')}}</td>
                        <td>{{App\Models\Produit::find($ttpc->produit_id)->category->nomCat}}</td>
                        <td>{{$ttpc->nb}}</td>
                        <td>{{$ttpc->prix}}€</td>
                        <td>{{DB::table('produits')->where('id',$ttpc->produit_id)->value('remise')}}%</td>
                        <td>{{$ttpc->prix * $ttpc->nb }}€</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>


        </div>
        <div class="row" style="padding-top: 15px">
            <div class="col-md-5 offset-md-7">
                <div class="row tech">
                    <div class="col-10">Quantité Totale : </div>
                    <div class="col">{{$total_qte}}</div>
                </div>
                <div class="row tech">
                    <div class="col-10">Remise:</div>
                    <div class="col">{{$total_remise}}%</div>
                </div>
                <div class="row tech">
                    <div class="col-10">Sous-Total:</div>
                    <div class="col">{{$sous_total}}€</div>
                </div>
                <div class="row tech">
                    <div class="col-10">Taxe:</div>
                    <div class="col">10%</div>
                </div>
                <div class="row tech">
                    <div class="col-10">Total:</div>
                    <div class="col">{{ $sous_total + $sous_total * 0.1 }}€</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                Nos Coordonnées :
                <hr color="#1d2124" style="position: relative;bottom: 19px;width: 134px;" align=left>
                <p style="position: relative;bottom: 29px;">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                    Quartier el Aamal Block 1 Benni-Mellal
                </p>
                <p style="position: relative;bottom: 44px;">
                    <i class="fa fa-mobile" aria-hidden="true"></i>
                    0638859907
                </p>
                <p style="position: relative;bottom: 59px;">
                    <i class="fa fa-fax" aria-hidden="true"></i>
                    052350645
                </p>
                <p style="position: relative;bottom: 73px;">
                    <i class="fa fa-internet-explorer" aria-hidden="true"></i>
                    www.luigis.ma/
                    <i class="fa fa-facebook-official" aria-hidden="true"></i>
                    BestLuigis/
                    <i class="fa fa-instagram" aria-hidden="true"></i>
                    BestLuigis
                </p>
            </div>

        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>