<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\FlashsalesRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class FlashsalesCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class FlashsalesCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Flashsales::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/flashsales');
        CRUD::setEntityNameStrings('flashsales', 'flashsales');
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
        CRUD::addColumn([
            'label'=>'Status',
            'name'=>'status',
            'type'=>'boolean',
            'options'=>[0=>'Private', 1=>'Public'],
            'wrapper'=>[
                'element'=>'span',
                'class'=> function($crud, $column, $entry, $related_key){
                    if($column['text']=='Public'){
                        return 'badge bg-success';
                    }else{
                        return 'badge bg-danger';
                    }
                }
            ]
        ]);
        CRUD::column('start_time');
        CRUD::column('end_time');
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
        CRUD::setValidation(FlashsalesRequest::class);
        //CRUD::setFromDb(); // set fields from db columns.
        CRUD::addField([
            'name'  => 'title',
            'label' => "Title",
            'type'  => 'text',
        ]);
        CRUD::addField([
            'name'  => 'start_time',
            'label' => "Start time",
            'type'  => 'date',
            'wrapper'   => [
                'class' => 'form-group col-md-4'
            ], 
        ]);
        CRUD::addField([
            'name'  => 'end_time',
            'label' => "End time",
            'type'  => 'date',
            'wrapper'   => [
                'class' => 'form-group col-md-4'
            ], 
        ]);
        CRUD::addField([
            'name'  => 'status',
            'label' => "Status",
            'type'  => 'select_from_array',
            'options'=>[1=>'Public',2=>'Private'],
            'wrapper'   => [
                'class' => 'form-group col-md-4'
            ], 
        ]);

        CRUD::addField([
            'name'  => 'search',
            'label' => "Search product",
            'type'  => 'text',
            'wrapper'   => [
                'class' => 'form-group col-md-12'
            ], 
        ]);


        CRUD::addColumn([
            'label'=>'Title',
            'name'=>'title'
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
