<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ClientRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ClientCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ClientCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Client');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/client');
        $this->crud->setEntityNameStrings('client', 'clients');
    }

    protected function setupListOperation(){

        $V1 = [
            'name' => 'image',
            'type' => 'image',
            'label' => 'Profile Image',
            'upload' => true,
            'height' =>'80px',
            'width' =>'80px',
        ];

        $V2 = [

        'name'=>'nom',
        'label'=>'Nom',
        'type'=>'text',
        ];

        $V3=[
            'name'=>'prenom',
            'label'=>'Prénom',
            'type'=>'text',
          ];
          $V4=[
            'name'=>'login',
            'label'=>"Nom d'utillisateur",
            'type'=>'text',
          ];

          $V5=[
            'name'=>'email',
            'label'=>"Email",
            'type'=>'email',
          ];

          $V6=[
            'name'=>'adresse',
            'label'=>"Adresse",
            'type'=>'textarea',
          ];
    
    

        $this->crud->addColumns([$V1,$V2,$V3,$V4,$V5,$V6]);
    }

    protected function setupCreateOperation(){
        $this->crud->setValidation(ClientRequest::class);
      $V1=[
            'label' => "Profile Image : ",
            'name' => "image",
            'type' => 'image',
            'upload' => true,
            'crop' => true, // set to true to allow cropping, false to disable
            'aspect_ratio' => 1, // ommit or set to 0 to allow any aspect ratio
            // 'disk' => 's3_bucket', // in case you need to show images from a different disk
            // 'prefix' => 'uploads/images/profile_pictures/' // in case your db value is only the file name (no path), you can use this to prepend your path to the image src (in HTML), before it's shown to the user;
      ];
      $V2=[
        'name'=>'nom',
        'label'=>'Nom :',
        'type'=>'text',
      ];

      $V3=[
        'name'=>'prenom',
        'label'=>'Prénom :',
        'type'=>'text',
      ];
      $V4=[
        'name'=>'login',
        'label'=>"Nom d'utillisateur :",
        'type'=>'text',
      ];
      $V5=[
        'name'=>'motdepasse',
        'label'=>"Password :",
        'type'=>'Password',
      ];

      $V6=[
        'name'=>'email',
        'label'=>"Email :",
        'type'=>'email',
      ];

      
      $V7=[
        'name'=>'adresse',
        'label'=>"Adresse :",
        'type'=>'textarea',
      ];
         $this->crud->addFields([$V1,$V2,$V3,$V4,$V5,$V6,$V7]);
    }

    protected function setupUpdateOperation(){
     $this->setupCreateOperation();
    }

    protected function setupShowOperation() {
        $this->crud->set('show.setFromDb', false);

        $V1 = [
            'name' => 'image',
            'type' => 'image',
            'label' => 'Profile Image',
            'upload' => true,
            'height' =>'80px',
            'width' =>'80px',
        ];
        $V2=[
            'name'=>'nom',
            'label'=>'Nom',
            'type'=>'text',
          ];
    
          $V3=[
            'name'=>'prenom',
            'label'=>'Prénom',
            'type'=>'text',
          ];
          $V4=[
            'name'=>'login',
            'label'=>"Nom d'utillisateur",
            'type'=>'text',
          ];

          $V5=[
            'name'=>'email',
            'label'=>"Email",
            'type'=>'email',
          ];
    
          
          $V6=[
            'name'=>'adresse',
            'label'=>"Adresse",
            'type'=>'textarea',
          ];

          
          $this->crud->addColumns([$V1,$V2,$V3,$V4,$V5,$V6]);




    }

}
