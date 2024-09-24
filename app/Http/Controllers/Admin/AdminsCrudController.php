<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdminsRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class AdminsCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AdminsCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Admins::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/admins');
        CRUD::setEntityNameStrings('admins', 'admins');

        CRUD::addClause('where', 'viewed',1);
        
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
       
        CRUD::column('name');
        CRUD::column('username');
        CRUD::addColumn([
            'label'=>'Role',
            'name'=>'role_id',
            'type'=>'select_from_array',
            'options'=>[1=>'superadmin',2=>'vendor']
        ]);
        CRUD::column('phone');
        CRUD::column('email');
        CRUD::addColumn([
            'lavel'=>'Verified',
            'name'=>'verified',
            'type'=>'boolean',
            'options'=>[0=>'Unverified',1=>'Verified'],
            'wrapper'=>[
                'element'=>'span',
                'class'=>function($crud, $column){
                    if($column['text']=='Verified'){
                        return 'badge bg-success';
                    }else{
                        return 'badge bg-danger';
                    }
                }
            ]
            
        ]);
        CRUD::addColumn([
            'lavel'=>'Active',
            'name'=>'active',
            'type'=>'boolean',
            'options'=>[0=>'No',1=>'Yes']
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
        CRUD::setValidation(AdminsRequest::class);
        //CRUD::setFromDb(); // set fields from db columns.
       
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
