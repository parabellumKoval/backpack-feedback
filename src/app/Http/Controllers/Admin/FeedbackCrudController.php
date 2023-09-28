<?php

namespace Backpack\Feedback\app\Http\Controllers\Admin;

use Backpack\Feedback\app\Http\Requests\FeedbackRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Hash;

use Backpack\Feedback\app\Models\Feedback;

/**
 * Class FeedbackCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class FeedbackCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    //use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('Backpack\Feedback\app\Models\Feedback');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/feedback');
        $this->crud->setEntityNameStrings('feedback', 'feedback');
        
        $this->types = array_unique(Feedback::pluck('type', 'type')->toArray());
        $this->statuses = array_unique(Feedback::pluck('status', 'status')->toArray());
    }
    
    protected function setupShowOperation(){ 
      
        $this->crud->set('show.setFromDb', false);
        
        $this->crud->addColumn([
          'name' => 'created_at',
          'type'  => 'datetime',
          'label' => __('feedback::feedback.date')
        ]);

        $this->crud->addColumn([
          'name' => 'status',
          'label' => 'Статус',
        ]);

        $this->crud->addColumn([
            'name' => 'name',
            'label' => 'Имя',
        ]);

        $this->crud->addColumn([
            'name' => 'phone',
            'label' => 'Телефон',
        ]);
            
        $this->crud->addColumn([
            'name' => 'email',
            'label' => 'Email',
            'type' => 'text'
        ]);
        
        $this->crud->addColumn([
            'name' => 'type',
            'label' => 'Тип',
        ]);

        $this->crud->addColumn([
            'name' => 'files',
            'label' => 'Файлы',
            'type' => 'upload_multiple'
        ]);

        $this->crud->addColumn([
            'name' => 'text',
            'label' => 'Сообщение',
            'type' => 'textarea',
            'options' => [
              'rows' => '7'
          ]
        ]);
        
        $this->crud->addColumn([
          'name' => 'info',
          'label' => 'Информация о заказе',
          'type' => 'feedback_info'
        ]);    
    }
    
    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        // $this->crud->setFromDb();
        $this->crud->addFilter([
          'name' => 'type',
          'label' => 'Тип',
          'type' => 'select2'
        ], function(){
          return $this->types;
        }, function($value){
          $this->crud->addClause('where', 'type', $value);
        });

        $this->crud->addFilter([
          'name' => 'status',
          'label' => 'Статус',
          'type' => 'select2'
        ], function(){
          return $this->statuses;
        }, function($value){
          $this->crud->addClause('where', 'status', $value);
        });

        $this->crud->addColumn([
          'name' => 'created_at',
          'type'  => 'datetime',
          'label' => __('feedback::feedback.date')
        ]);

        $this->crud->addColumn([
          'name' => 'status',
          'label' => __('feedback::feedback.status'),
        ]);

        $this->crud->addColumn([
          'name' => 'type',
          'label' => __('feedback::feedback.type'),
        ]);
      
        $this->crud->addColumn([
              'name' => 'name',
              'label' => __('feedback::feedback.name'),
          ]);

        $this->crud->addColumn([
                'name' => 'phone',
                'label' => __('feedback::feedback.phone'),
            ]);

        $this->crud->addColumn([
                'name' => 'email',
                'label' => __('feedback::feedback.email'),
            ]);
            
    }

    // protected function setupCreateOperation()
    // {
    //     $this->crud->setValidation(FeedbackRequest::class);

    //     TODO: remove setFromDb() and manually define Fields
    //      $this->crud->setFromDb();
        
        
    // }

    protected function setupUpdateOperation()
    {
        // $this->setupCreateOperation();
        $this->crud->addFields([
          [
            'name' => 'status',
            'label' => __('feedback::feedback.status'),
            'type' => 'select_from_array',
            'options' => [
              'new' => 'Новый',
              'сanceled' => 'Отменен',
              'processed' => 'Обработан',
              'done' => 'Выполнен',
            ]
          ],
          [
            'name' => 'name',
            'label' => __('feedback::feedback.name'),
            'type' => 'text'
          ],
          [
            'name' => 'phone',
            'label' => __('feedback::feedback.phone'),
            'type' => 'text'
          ],
          [
            'name' => 'email',
            'label' => __('feedback::feedback.email'),
            'type' => 'text'
          ],
          [
            'name' => 'text',
            'label' => __('feedback::feedback.message'),
            'type' => 'textarea',
            'attributes' => [
              'rows' => '7'
            ]
          ],
        ]);
    }
    
}
