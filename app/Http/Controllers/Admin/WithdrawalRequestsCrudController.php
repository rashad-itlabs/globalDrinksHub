<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\WithdrawalRequestsRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class WithdrawalRequestsCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class WithdrawalRequestsCrudController extends CrudController
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
        CRUD::setModel(\App\Models\WithdrawalRequests::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/withdrawal-requests');
        CRUD::setEntityNameStrings('withdrawal requests', 'withdrawal requests');
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
        CRUD::addColumn([
            'label'=>'Amount($)',
            'name'=>'amount'
        ]);
        CRUD::addColumn([
            'label'=>'Approved By',
            'name'=>'approved_by',
            'type'=>'select',
            'entity'=>'admins',
            'attribute'=>'name',
            'model'=>'App\Models\WithdrawalRequests'
        ]);
        CRUD::addColumn([
            'label'=>'Status',
            'name'=>'status',
            'type'=> 'select_from_array',
            'options'=>[1=>'APPROVED', 2=>'PENDING', 3=>'CANCELLED'],
            'wrapper'=>[
                'element'=>'span',
                'class'=>'badge'
            ],
        ]);
        CRUD::addColumn([
            'label'=>'Bank',
            'name'=>'withdrawal_account_id',
            'type'=>'select',
            'entity'=>'bank',
            'attribute'=>'bank_name',
            'model'=>'App\Models\WithdrawalRequests'
        ]);
        CRUD::addColumn([
            'label'=>'Branch',
            'type'=>'select',
            'entity'=>'branch',
            'attribute'=>'branch_name',
            'model'=>'App\Models\WithdrawalRequests'
        ]);

        CRUD::addColumn([
            'label'=>'Account Name',
            'type'=>'select',
            'entity'=>'account_name',
            'attribute'=>'account_name',
            'model'=>'App\Models\WithdrawalRequests'
        ]);
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
        CRUD::setValidation(WithdrawalRequestsRequest::class);
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
