<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseModule;
class ChangePasswordController extends Controller
{
    public function __construct($parameters = array())
    {
        parent::__construct($parameters);
        
        $this->_module      = 'Change Password';
        $this->_routePrefix = 'admission';
        $this->_model       = new Course();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return $this->__formUiGeneration($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->__formPost($request);
    }

   
    /**
     * ui parameters for form add and edit
     *
     * @param  string $id [description]
     * @return [type]     [description]
     */
    protected function __formUiGeneration(Request $request, $id = '')
    {
        $response = $this->initUIGeneration($id);
        if($response) {
            return $response;
        }
        $courseModule       = new CourseModule();
        $courseM       = $courseModule->getListing(['status'=>'1'])
            ->pluck('name', 'id')
            ->all();

        extract($this->_data);
        $status = \App\Helpers\Helper::makeSimpleArray($this->_model->statuses, 'id,name');
        
        $form = [
            'route'      => $this->_routePrefix . ($id ? '.update' : '.store'),
            'back_route' => route($this->_routePrefix . '.index'),
            
            'fields'     => [
                
                'current_password'      => [
                    'type'          => 'password',
                    'label'         => 'Current Password',
                    'attributes'    => [
                        'required'  => true
                    ]
                ],
                'new_password'        => [
                    'type'          => 'password',
                    'label'         => 'New Password',
                    'attributes'    => [
                        
                        'required'  => true
                    ]
                ],
                'confirm_password'        => [
                    'type'          => 'password',
                    'label'         => 'Confirm Password',
                    'attributes'    => [
                        
                        'required'  => true
                    ]
                ]
                
            ],
        ];

        return view('admin.components.admin-form', compact('data', 'id', 'form', 'breadcrumb', 'module'));
    }

    /**
     * Form post action
     *
     * @param  Request $request [description]
     * @param  string  $id      [description]
     * @return [type]           [description]
     */
    protected function __formPost(Request $request, $id = '')
    {
        $validationRules = [
            'course_name'          => 'required',
            'course_title'          => 'required',
            'duration'            => 'required|max:255'
        ];

        $this->validate($request, $validationRules);

        $input      = $request->all();
        $response   = $this->_model->store($input, $id, $request);
        
        if($response['status'] == 200){
            return redirect()
                ->route($this->_routePrefix . '.index')
                ->with('success',  $response['message']);
        } else {
            return redirect()
                    ->route($this->_routePrefix . '.index')
                    ->with('error', $response['message']);
        }
    }
}
