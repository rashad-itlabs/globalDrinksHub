<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CollectionsRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

use function Laravel\Prompts\select;

/**
 * Class CollectionsCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CollectionsCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
   // use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\ProductsCollection::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/collections');
        CRUD::setEntityNameStrings('collections', 'collections');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        //CRUD::setFromDb(); // set columns from db columns.
        CRUD::column('title');
        CRUD::column('slug');
        CRUD::addColumn([
            'label'=>'Status',
            'name'=>'status',
            'type'=>'boolean',
            'options'=>[1=>'Public',0=>'Private'],
            'wrapper'=>[
                'element'=>'span',
                'class'=>function($crud, $column){
                    if($column['text']=='Public'){
                        return 'badge bg-success';
                    }
                }
            ]
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
        CRUD::setValidation(CollectionsRequest::class);
        //CRUD::setFromDb(); // set fields from db columns.
        CRUD::addField([
            'label'=>'Title',
            'name'=>'title'
        ]);
        CRUD::addField([
            'label'=>'Slug',
            'name'=>'slug'
        ]);

        CRUD::addField([
            'label'=>'Status',
            'name'=>'status',
            'type'=>'select_from_array',
            'options'=>[0=>'Private',1=>'Public']
        ]);

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
