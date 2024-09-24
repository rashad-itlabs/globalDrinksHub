<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OrdersRequest;
use App\Models\Orders;
use App\Models\User;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class OrdersCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class OrdersCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    //use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    //use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Orders::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/orders');
        CRUD::setEntityNameStrings('order', 'orders');
        if(backpack_user()->id !=1){
            CRUD::addClause('where','user_id',backpack_user()->id);
        }
        

       // CRUD::addClause('where', 'product_created_id',backpack_user()->id);
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
    //    dd($name);
        CRUD::column('order');
        CRUD::addColumn([
            'label'=>'Products',
            'name'=>'product_id'
        ]);
        $this->crud->addColumn([
            'name'=>'status',
            'label'=>'Status',
            'type'=> 'select_from_array',
            'options'=>[1=>'Reservation', 2=>'Confirmed',3=>'Canceled'],
            'wrapper' => [
                'element' => 'span',
            ],
        ]);
        if(backpack_user()->id==1){

            $this->crud->addColumn([
                'name'=>'user_id',
                'label'=>'Recipient of the product',
                'type'=>'select',
                'entity'=>'admins',
                'attribute'=>'name',
                'model'=>'App\Models\Orders'
            ]);
        }
        CRUD::addColumn([
            'label'=>'Quantity',
            'name'=>'quantity'
        ]);
        CRUD::addColumn([
            'label'=>'Amount($)',
            'name'=>'total_amount'
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
        CRUD::setValidation(OrdersRequest::class);
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
