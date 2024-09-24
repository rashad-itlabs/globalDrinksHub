<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BrandsRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class BrandsCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class BrandsCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    //use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Brands::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/brands');
        CRUD::setEntityNameStrings('brands', 'brands');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
       // CRUD::setFromDb(); // set columns from db columns.
       $this->crud->addColumn([
        'name' => 'image', // The db column name
        'label' => "Image", // Table column heading
        'type' => 'image',
        'prefix' => 'uploads/',
        'height' => '50px',
        'width'  => '50px',
      ]);
        CRUD::column('title');
        CRUD::column('slug');
        $this->crud->addColumn([
            'label'=>'Featured',
            'name'=>'featured',
            'type'    => 'boolean',
            'options' => [0 => 'No', 1 => 'Yes'],
            'wrapper' => [
                'element' => 'span',
                'class' => function ($crud, $column, $entry, $related_key) {
                    if ($column['text'] == 'Yes') {
                        return 'badge bg-success';
                    }else{
                        return 'badge bg-danger';
                    }
                },
            ],
        ]); //thumb-brand-1714047900-3.png
        $this->crud->addColumn([
            'label'=>'Status',
            'name'=>'status',
            'type'    => 'boolean',
            'options' => [0 => 'Private', 1 => 'Public'],
            'wrapper' => [
                'element' => 'span',
                'class' => function ($crud, $column, $entry, $related_key) {
                    if ($column['text'] == 'Public') {
                        return 'badge bg-success';
                    }else{
                        return 'badge bg-danger';
                    }
                },
            ],
        ]);
        CRUD::column('created_at');
        /**
         * Columns can be defined using the fluent syntax:
         * - CRUD::column('price')->type('number');
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(BrandsRequest::class);
        CRUD::setFromDb(); // set fields from db columns.

        /**
         * Fields can be defined using the fluent syntax:
         * - CRUD::field('price')->type('number');
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
