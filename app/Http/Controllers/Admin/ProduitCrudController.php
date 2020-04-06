<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProduitRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ProduitCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProduitCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Produit');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/produit');
        $this->crud->setEntityNameStrings('produit', 'produits');
    }

    protected function setupListOperation(){ 
        $V1 = [
            'name' => 'nom',
            'type' => 'text',
            'label' => 'Nom',
        ];
        $V2 = [
            'name' => 'categorries',
            'type' => 'image',
            'label' => 'Image',
            'upload' => true,
            'height' =>'80px',
            'width' =>'80px',
        ];
        $V3= [
            'name' => 'category.nomCat',
            'type' => 'text',
            'label' => 'Categorie',
        ];
        $V4= [
            'name' => 'prix',
            'type' => 'text',
            'label' => 'Prix',
        ];

        $V5= [
            'name' => 'remise',
            'type' => 'text',
            'label' => 'Remise(%)',
        ];

        $V6= [
            'name' => 'datDebut',
            'type' => 'date',
            'label' => 'Date debut',
        ];

        $V7= [
            'name' => 'datFin',
            'type' => 'date',
            'label' => 'Date Fin',
        ];



 
        $this->crud->addColumns([$V1,$V2,$V3,$V4,$V5,$V6,$V7]);

    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(ProduitRequest::class);

        // category_product 
        $this->crud->addField([
                'label'=>"Categories",
                'type'=>'select',
                'name'=>'category_id',
                'entity'=>'category',
                'attribute'=>'nomCat',
                'model'=>\App\Models\Catproduit::class,]);

        // images_Product  
        $this->crud->addField([
                    'name' => 'categorries',
                    'label' => 'Image',
                    'type' => 'browse',]);




        $this->crud->setFromDb();
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
