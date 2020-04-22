<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\FormuleRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class FormuleCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class FormuleCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Formule');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/formule');
        $this->crud->setEntityNameStrings('formule', 'formules');
    }

    protected function setupListOperation()
    {
        $V1 = [
            'name' => 'image',
            'type' => 'image',
            'label' => 'Image Formule',
            'upload' => true,
            'height' =>'80px',
            'width' =>'80px',
        ];
        $V2=[
            'name'=>'nomFormule',
            'label'=>'Nom Formule',
            'type'=>'text',
          ];

          $V3=[
            'name'=>'prix',
            'label'=>'Prix(dhs)',
            'type'=>'number',
          ];

          $V4=[
            'name'=>'description',
            'label'=>'Description',
            'type'=>'textarea',
          ];
    

          $this->crud->addColumns([$V1,$V2,$V3,$V4]);
        
        
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(FormuleRequest::class);

        $V1=[
            'label' => "Image Formule : ",
            'name' => "image",
            'type' => 'image',
            'default'=>'uploads/images_formules\defaultImage.jpg',
            'upload' => true,
            'crop' => true, // set to true to allow cropping, false to disable
            'aspect_ratio' => 1, // ommit or set to 0 to allow any aspect ratio
            // 'disk' => 's3_bucket', // in case you need to show images from a different disk
            // 'prefix' => 'uploads/images/profile_pictures/' // in case your db value is only the file name (no path), you can use this to prepend your path to the image src (in HTML), before it's shown to the user;
      ];
      $V2=[
        'name'=>'nomFormule',
        'label'=>'Nom Formule :',
        'type'=>'text',
      ];

      $V3=[
        'name'=>'prix',
        'label'=>'Prix :',
        'type'=>'number',
        'prefix' => "MAD",
      ];

      $V4=[
        'name'=>'description',
        'label'=>'Description :',
        'type'=>'textarea',
      ];

      $this->crud->addFields([$V1,$V2,$V3,$V4]);   
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupShowOperation() {
      $this->crud->set('show.setFromDb', false);
      $V1 = [
        'name' => 'image',
        'type' => 'image',
        'label' => 'Image Formule',
        'upload' => true,
        'height' =>'80px',
        'width' =>'80px',
    ];


  $V2=[
        'name'=>'nomFormule',
        'label'=>'Nom Formule',
        'type'=>'text',
      ];

      $V3=[
        'name'=>'prix',
        'label'=>'Prix(dhs)',
        'type'=>'number',
      ];

      $V4=[
        'name'=>'description',
        'label'=>'Description',
        'type'=>'textarea',
      ];

      $this->crud->addColumns([$V1,$V2,$V3,$V4]);



    }
}
