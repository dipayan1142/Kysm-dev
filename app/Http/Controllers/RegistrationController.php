<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\CourseModule;
use App\Models\Course;
use App\Models\Admission;

class RegistrationController extends Controller
{
    public function __construct($parameters = array())
    {
        parent::__construct($parameters);
        
        $this->_module      = 'Registration';
        $this->_routePrefix = 'registration';
        $this->_model       = new Registration();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
        $this->initIndex();
        $this->_data['permisssionState']    = \App\Models\Permission::checkModulePermissions(['index'], 'CourseController');
        $srch_params                        = $request->all();
    
        $this->_data['data']                = $this->_model->getListing($srch_params, $this->_offset);
        $this->_data['orderBy']             = $this->_model->orderBy;
        $this->_data['filters']             = $this->_model->getFilters();

        // echo "<pre>";
        // print_r($this->_data['data'] );
        // die;
        // $file_model=new App\Models\File();
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
        $response = $this->initUIGeneration($id);
        if($response) {
            return $response;
        }
        
        $courseModule       = new CourseModule();
        $courseM       = $courseModule->getListing(['status'=>'1'])
            ->pluck('name', 'id')
            ->all();

        $course       = new Course();
        $courseModel       = $course->getListing(['status'=>'1'])
            ->pluck('course_name', 'id')
            ->all();

        extract($this->_data);
       
        $status = \App\Helpers\Helper::makeSimpleArray($this->_model->statuses, 'id,name');
        $courseArOption=[
            '0'=>'NO',
            '1'=>'YES'
        ];
        $form = [
            'route'      => $this->_routePrefix . ($id ? '.update' : '.store'),
            'back_route' => route($this->_routePrefix . '.index'),
            'include_scripts'   => '<script src="'. asset('administrator/admin-form-plugins/custom.js'). '"></script>',
            'fields'     => [

                'registration_number'      => [
                    'type'          => 'text',
                    'label'         => 'Registration Number',
                    'attributes'    => [
                    
                        'required'  => true
                    ],
                    'extra'         => [
                        'type'          =>'custom',
                        'value'         =>'<button type="button" name="get_search" id="get_search" class="btn btn-primary">Search</button>',
                        ]
                ],
                
                'name'      => [
                    'type'          => 'text',
                    'label'         => 'Name',
                    'attributes'    => [
                    
                        'required'  => true,
                        'readonly'  => true,
                    ]
                ],
                'father_name'      => [
                    'type'          => 'text',
                    'label'         => 'Father Name',
                    'attributes'    => [
                        'required'  => true,
                        'readonly'  => true,
                    ]
                ],
                'module_id'      => [
                    'type'          => 'select',
                    'label'         => 'Select Module',
                    'options'       => $courseM,
                    'value'         => isset($data->module_id) ? $data->module_id : 1,
                    'attributes'    => [
                        
                        'required'  => true,
                       
                    ]
                ],
                'course_id'      => [
                    'type'          => 'select',
                    'label'         => 'Select Course',
                    'options'       => $courseModel,
                    'value'         => isset($data->course_id) ? $data->course_id : 1,
                    'attributes'    => [
                        
                        'required'  => true,
                
                    ]
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
            'registration_number'          => 'required',
            'module_id'          => 'required',
            'course_id'            => 'required'
        ];

        $this->validate($request, $validationRules);

        $input      = $request->all();
        // dd($input);
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

    public function getData(Request $request)
    {
        $admissionM      = new Admission();
        $registration_number=$request->registration_number;
        $data = $admissionM->getListing(['registration_number' => $registration_number]);
        
        return $data;
    }

    public function getCourseData(Request $request)
    {
        $module_id=$request->c_code;
        $course       = new Course();
        $courseModel       = $course->getListing(['status'=>'1','module_id'=>$module_id])
            ->pluck('course_name', 'id')
            ->all();
       
        $html='<option value="">select course</option>';
        foreach($courseModel as $key  =>  $value)
        {
            $html.='<option value="'.$key.'">'.$value.'</option>';
        }
        return $html;
    }
}
