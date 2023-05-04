<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseModule;
class AdmissionController extends Controller
{
    public function __construct($parameters = array())
    {
        parent::__construct($parameters);
        
        $this->_module      = 'Admission';
        $this->_routePrefix = 'admission';
        $this->_model       = new Course();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
        $this->initIndex();
        $this->_data['permisssionState']    = \App\Models\Permission::checkModulePermissions(['index'], 'AdmissionController');
        $srch_params                        = $request->all();
        $this->_data['data']                = $this->_model->getListing($srch_params, $this->_offset);
        $this->_data['orderBy']             = $this->_model->orderBy;
        $this->_data['filters']             = $this->_model->getFilters();
        return view('admin.' . $this->_routePrefix . '.index', $this->_data)
            ->with('i', ($request->input('page', 1) - 1) * $this->_offset);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.admission.add');
        // return $this->__formUiGeneration($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
        return $this->__formPost($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->_model->getListing(['id' => $id]);
        return view('admin.' . $this->_routePrefix . '.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        return $this->__formUiGeneration($request, $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->__formPost($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = $this->_model->remove($id);

        if($response['status'] == 200) {
            return redirect()
                ->route($this->_routePrefix . '.index')
                ->with('success', $response['message']);
        } else {
            return redirect()
                    ->route($this->_routePrefix . '.index')
                    ->with('error', $response['message']);
        }
    }

    /**
     * ui parameters for form add and edit
     *
     * @param  string $id [description]
     * @return [type]     [description]
     */
    protected function __formUiGeneration(Request $request, $id = '')
    {
        $courseModuleName=$coursesName=0;

        $response = $this->initUIGeneration($id);
        if($response) {
            return $response;
        }
        extract($this->_data);
        $courseModuleName        =$request->old('course_name') ? $request->old('course_name') : $courseModuleName ;
        $coursesName        =$request->old('c_code') ? $request->old('c_code') : $coursesName ;

        $courseModuleModel       = new CourseModule();
        $courseModule      = $courseModuleModel->getListing(['status'=>'1'])
            ->pluck('name', 'id');

        $courses=[];
        if($courseModuleName)
        {
            $courseModel       = new Course();
            $courses       = $course->getListing(['module_id'=>$courseModuleName])
                ->pluck('course_name', 'id');  
        }
          

        $status = \App\Helpers\Helper::makeSimpleArray($this->_model->statuses, 'id,name');
        
        $form = [
            'route'      => $this->_routePrefix . ($id ? '.update' : '.store'),
            'back_route' => route($this->_routePrefix . '.index'),
            'include_scripts'   => '<script src="'. asset('administrator/admin-form-plugins/form-controls.js'). '"></script>',
            'fields'     => [
                'name'      => [
                    'type'          => 'text',
                    'label'         => 'Name',
                    'attributes'    => [
                    
                        'required'  => true
                    ]
                ],
                'f_name'      => [
                    'type'          => 'text',
                    'label'         => 'Father Name',
                    'attributes'    => [
                    
                        'required'  => true
                    ]
                ],
                'dob'      => [
                    'type'          => 'date',
                    'label'         => 'Date of Birth',
                    'attributes'    => [
                        'required'  => true
                    ]
                ],
                'doa'        => [
                    'type'          => 'date',
                    'label'         => 'Date of Admission',
                    'attributes'    => [
                        
                        'required'  => true
                    ]
                ],
                'course_name'        => [
                    'type'          => 'select',
                    'label'         => 'Select Module',
                    'options'       => $courseModule,
                    'value'         => isset($data->course_name) ? $data->course_name : 1,
                    'attributes'    => [
                        'required'  => true
                    ]
                ],
                'c_code'        => [
                    'type'          => 'select',
                    'label'         => 'Course Code',
                    'options'       => $courses,
                    'value'         => isset($data->c_code) ? $data->c_code : 1,
                    'attributes'    => [
                        'required'  => true
                    ]
                ],
                'address'        => [
                    'type'          => 'textarea',
                    'label'         => 'Address',
                    'attributes'    => [
                        
                        'required'  => true
                    ]
                ],
                'po'        => [
                    'type'          => 'text',
                    'label'         => 'Post Office',
                    'attributes'    => [
                        
                        'required'  => true
                    ]
                ],
                'ps'        => [
                    'type'          => 'text',
                    'label'         => 'Police Station',
                    'attributes'    => [
                        
                        'required'  => true
                    ]
                ],
                'dis'        => [
                    'type'          => 'text',
                    'label'         => 'District',
                    
                ],
                'pin'        => [
                    'type'          => 'text',
                    'label'         => 'Pin Code',
                    
                ],
                'l_no'        => [
                    'type'          => 'text',
                    'label'         => 'Contact No',
                    
                ],
                'm_no'        => [
                    'type'          => 'text',
                    'label'         => 'Whatsapp No',
                    
                ],
                'religion'        => [
                    'type'          => 'text',
                    'label'         => 'Religion',
                    
                ],
                'cast'        => [
                    'type'          => 'text',
                    'label'         => 'Cast',
                    
                ],
                
                'status'            => [
                    'type'          => 'radio',
                    'label'         => 'Status',
                    'options'       => $status,
                    'value'         => isset($data->status) ? $data->status : 1,
                ],
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
