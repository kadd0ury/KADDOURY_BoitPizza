<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CommandeRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CommandeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CommandeCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Commande');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/commande');
        $this->crud->setEntityNameStrings('commande', 'commandes');
    }

    protected function setupListOperation()
    {
        $V1 = [
            'label' => "Client",
            'type' => 'text',
            'name' => 'client.nom',
        ];
        $V2 = [
            'label' => "Date de la commande ",
            'type' => 'datetime',
            'name' => 'dateCom',
        ];
        $V3 = [
            'label' => "adresse de livraison",
            'type' => 'textarea',
            'name' => 'adresseliv',
        ];

        $V4 = [
            'label' => "Secteur",
            'type' => 'text',
            'name' => 'secteur',
        ];
        $V5 = [
            'label' => "Ville",
            'type' => 'text',
            'name' => 'ville',
        ];
        $V6 = [
            'label' => "telephone",
            'type' => 'text',
            'name' => 'telephone',
        ];


        $this->crud->addColumns([$V1, $V2, $V3, $V4,$V5,$V6]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(CommandeRequest::class);

        $V1 = [
            'label' => "Client",
            'type' => 'select',
            'name' => 'client_id',
            'entity' => 'client',
            'attribute' => 'nom',
            'model' => \App\Models\Client::class,
        ];

        $V2 = [
            'label' => "Date de livraison",
            'type' => 'datetime',
            'name' => 'dateExp',
        ];

        $V3 = [
            'label' => "Type",
            'type' => 'text',
            'name' => 'type',
        ];

        $V4 = [
            'label' => "Ville",
            'type' => 'number',
            'name' => 'ville',
        ];

        $V5 = [
            'label' => "Secteur",
            'type' => 'text',
            'name' => 'secteur',
        ];
        $V6 = [
            'label' => "Adresse de livraison",
            'type' => 'textarea',
            'name' => 'adresseliv',
        ];
        $this->crud->addFields([$V1, $V2, $V3, $V4, $V5, $V6]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }


    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);

        $V1 = [
            'label' => "Client",
            'type' => 'text',
            'name' => 'client.nom',
        ];
        $V2 = [
            'label' => "Date de livraison",
            'type' => 'datetime',
            'name' => 'dateExp',
        ];

        $V3 = [
            'label' => "Date de commande",
            'type' => 'datetime',
            'name' => 'dateCom',
        ];

        $V4 = [
            'label' => "Type",
            'type' => 'text',
            'name' => 'type',
        ];

        $V5 = [
            'label' => "Ville",
            'type' => 'number',
            'name' => 'ville',
        ];

        $V6 = [
            'label' => "Secteur",
            'type' => 'text',
            'name' => 'secteur',
        ];
        $V7 = [
            'label' => "adresse de livraison",
            'type' => 'textarea',
            'name' => 'adresseliv',
        ];

        $this->crud->addColumns([$V1, $V2, $V3, $V4, $V5, $V6, $V7]);
    }
}
