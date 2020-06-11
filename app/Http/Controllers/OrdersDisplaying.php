<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Client;

use App\Models\Commande;
use App\Models\Produit;

use App\Models\LigneCommande;

use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class OrdersDisplaying extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $nbrproduct = 0;
        $nbrpizza = 0;
        $nbrsalades = 0;
        $nbrdesert = 0;
        $nbrboissons = 0;


        $commandes = Commande::where('client_id', auth()->user()->id)

            ->get();
        foreach ($commandes as $cmd) {

            $ttcomman = LigneCommande::where('commande_id', $cmd->id)->get();

            foreach ($ttcomman as $item) {

                $catproduit = Produit::find($item->produit_id)->category->nomCat;

                if ($catproduit == "Salades") {
                    $nbrsalades = $nbrsalades + $item->nb;
                } elseif ($catproduit == "Pizza") {
                    $nbrpizza = $nbrpizza + $item->nb;
                } elseif ($catproduit == "Boissons") {
                    $nbrboissons = $nbrboissons + $item->nb;
                } else {
                    $nbrdesert = $nbrdesert + $item->nb;
                }



                $nbrproduct = $nbrproduct + $item->nb;
            }
        }



        return view('checkout.orders', [
            'commandes' => $commandes,
            'nbrproduct' => $nbrproduct,
            'nbrdesert' => $nbrdesert,
            'nbrboissons' => $nbrboissons,
            'nbrpizza' => $nbrpizza,
            'nbrsalades' => $nbrsalades,



        ]);
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
        //
    }

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


    public static function totalprix($id)
    {
        $totalprice = 0;
        $mycommandes = LigneCommande::where('commande_id', $id)->get();
        foreach ($mycommandes as $item) {
            $totalprice = $totalprice + ($item->prix);
        }
        return $totalprice + $totalprice * 0.1;
    }

    public function GeneratePdf($id)

    {
        $total_remise = 0;
        $sous_total = 0;


        $commandes = Commande::find($id);


        $commanLigne = LigneCommande::where('commande_id', $id)->get();
        $total_qte = DB::table('ligne_commandes')
            ->where('commande_id', $id)
            ->sum('nb');

        foreach ($commanLigne as $item) {
            $total_remise = $total_remise + (DB::table('produits')->where('id', $item->produit_id)->value('remise'));
            $sous_total = $sous_total + ($item->nb * $item->prix);
        }


        return view('generatePDF.pdf', [

            'commandes'    => $commandes,
            'total_qte'    => $total_qte,
            'total_remise' => $total_remise,
            'sous_total'   => $sous_total
        ]);
    }
}
