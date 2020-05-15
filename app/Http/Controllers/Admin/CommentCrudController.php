<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CommentRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CommentCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CommentCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Comment');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/comment');
        $this->crud->setEntityNameStrings('comment', 'comments');
        $this->crud->denyAccess(['create', 'update']);
        //prohibit to the Admin to modify or create comments
        //$this->crud->denyAccess(['create', 'update']);

    }

    protected function setupListOperation()
    {
        //$this->crud->setFromDb();

        $V1=[
            'label' => "Clients",
            'type' => 'select2',
            'name' => 'client.nom' ];

            
        $V2=[
            'label' => "Produits",
            'type' => 'select2',
            'name' => 'produit.nom' ];

        $V3=[
            'name'=>'texte',
            'label'=>'Commentaire',
            'type'=>'text' ];

        $V4=[
            'name'=>'date_pub',
            'label'=>'Date de publication',
            'type'=>'datetime' ];
    



                $this->crud->addColumns([$V1,$V2,$V3,$V4]);



    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(CommentRequest::class);

       // $this->crud->setFromDb();

      $V1=[

        'label' => "Clients",
        'type' => 'select2',
        'name' => 'client_id', // the method that defines the relationship in your Model
        'entity' => 'client', // the method that defines the relationship in your Model
        'attribute' => 'nom', // foreign key attribute that is shown to user
       //'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
        'model'=>"App\Models\Client",



         ];

    $V2=[

        'label' => "Produits",
        'type' => 'select2',
        'name' => 'produit_id', // the method that defines the relationship in your Model
        'entity' => 'produit', // the method that defines the relationship in your Model
        'attribute' => 'nom', // foreign key attribute that is shown to user
        //'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
        'model'=>"App\Models\Produit",

               
    
    
            ];


     $V3=[
        'name'=>'texte',
        'label'=>'Commentaire',
        'type'=>'text',
          ];

          $this->crud->addFields([$V1,$V2,$V3]);
        

    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
