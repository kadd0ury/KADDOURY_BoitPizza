<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Produit;

use Illuminate\Http\Request;

class ShowController extends Controller
{

    public function index(){
       $pizza = DB::table('catproduits')->join('produits','catproduits.id','=','produits.category_id')
       ->where('catproduits.nomCat','Pizza')->get();
       
       $salades = DB::table('catproduits')->join('produits','catproduits.id','=','produits.category_id')
       ->where('catproduits.nomCat','Salades')->get();

       $desserts = DB::table('catproduits')->join('produits','catproduits.id','=','produits.category_id')
       ->where('catproduits.nomCat','Desserts')->get();

       $boisson = DB::table('catproduits')->join('produits','catproduits.id','=','produits.category_id')
       ->where('catproduits.nomCat','Boissons')->get();

        return view('products.index',
        ['pizza'   => $pizza,
         'salades' => $salades,
         'desserts'=> $desserts,
         'boisson' => $boisson,]);}

    public function show($id){
     
        $product = DB::table('produits')->where('id', $id)->first();

        return view('products.show')->with('product',$product);
    }     




         
}
