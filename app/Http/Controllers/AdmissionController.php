<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseModule;
use App\Models\Admission;
use App\Models\AdmissionDetails;
use App\Models\User;
use DB;
use App\Models\PaymentHistory;
use PDF;
class AdmissionController extends Controller
{
    public function __construct($parameters = array())
    {
        parent::__construct($parameters);
        
        $this->_module      = 'Student';
        $this->_routePrefix = 'admission';
        $this->_model       = new Admission();
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
        // dd($this->_data['data'] );
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
        $courseModule       = new CourseModule();
        $courseModuleData      = $courseModule->getListing(['status'=>'1']);

        return view('admin.admission.add',compact('courseModuleData'));
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
        // dd($request->all());
        // return $this->__formPost($request);

        $validationRules = [
            'name'          => 'required',
            'f_name'          => 'required',
            'dob'          => 'required',
            'doa'          => 'required',
            'course_name'          => 'required',
            'c_code'          => 'required',
        ];

        $this->validate($request, $validationRules);

        $input      = $request->all();
        $courseModule       = new CourseModule();
        $courseModuleRow=$courseModule->getListing(['id'=>$input['course_name']]);
    
        $userId     	=       \Auth::user()->id;
        $user       = new User();
        $userRow=$user->getListing(['id'=>$userId]);

        $row_data = DB::table('student_unique_number')->where('id', 1)->first();
        $student_unique_number = [
			"number" => $row_data->number+1
		];
        DB::table('student_unique_number')->where('id',1)->update($student_unique_number);
        $frist_four = substr($userRow->username, 0,4);
        $year=DATE("Y");
        $total_number='';

        $ad_nu = Admission::where('c_id',$userRow->username)->count();
        $length=strlen($row_data->number);
        $ad_nu=$ad_nu+1;
        if($length==1)
        {
            $total_number="0000".$row_data->number;
        }
        elseif($length==2)
        {
            $total_number="000".$row_data->number;
        }
        elseif($length==3)
        {
            $total_number="00".$row_data->number;
        }
        else
        {
            $total_number="0".$row_data->number;
        }
        
        $admission_s_id=$frist_four.'-'.$year.'-'.$ad_nu.'/'.$total_number;

        $c_id=\Auth::user()->id;
        $center_total = User::select('center_wallet')->where('id', '=', $c_id)->first();
      
            
        if($center_total->center_wallet>=100)
        {
            $admission_info = [
                "c_id" =>$userRow->username,
                "center_id" =>$userId,
                "name" => $input['name'],
                "f_name" => $input['f_name'],
                "dob"=>$input['dob'],
                "doa"=>$input['doa'],
                "course_name"=> $courseModuleRow->name,
                "c_code"=>$input['c_code'],
                "address"=>$input['address'],
                "po"=>$input['po'],
                "ps"=>$input['ps'],
                "dis"=>$input['dis'],
                "pin"=>$input['pin'],
                "l_no"=>$input['l_no'],
                "m_no"=>$input['m_no'],
                "religion"=>$input['religion'],
                "cast"=>$input['cast'],
                "admission_form_number"=>$input['admission_form_number'],
                "total_fees"=>$input['total_fees'],
                "s_id"=>$admission_s_id,
                "s_idn"=>$row_data->number,
                "course_id"=>$input['course_name']
            ];
         
            $return_data = Admission::create($admission_info);
            
            $admission_details = [
                "c_id" =>$userRow->username,
                "student_info_id" => $return_data->id,
                "exam" => $input['exam'],
                "year"=>$input['year'],
                "board"=>$input['board'],
                "marks"=>$input['marks'],
                "10th_year"=>$input['10th_year'],
                "10th_board"=>$input['10th_board'],
                "10th_marks"=>$input['10th_marks'],
                "12th_year"=>$input['12th_year'],
                "12th_board"=>$input['12th_board'],
                "12th_marks"=>$input['12th_marks'],
                "g_year"=>$input['g_year'],
                "g_board"=>$input['g_board'],
                "g_marks"=>$input['g_marks'],
                "p_year"=>$input['p_year'],
                "p_board"=>$input['p_board'],
                "p_marks"=>$input['p_marks'],
                "s_id"=>$return_data->s_id
            ];
    
            AdmissionDetails::create($admission_details);

            User::where('id', '=', $c_id)->update(['center_wallet' => $center_total->center_wallet-100]);

            $paymentM=new PaymentHistory();
          
            $payment_input=[
                'center_id'=>$c_id,
                'admission_id'=>$return_data->id,
                'amount'=>100,
                'payment_type'=>1,
            ];
            $paymentM->store($payment_input);
           
            return redirect()
                    ->route($this->_routePrefix . '.index')
                    ->with('success','Admission added successfully.');
        }
        else
        {
            return \App\Helpers\Helper::resp('Pleac check your balance.', 201, $data);
        }
        
        
        
    }

   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $courseModule       = new CourseModule();
        $courseModuleData      = $courseModule->getListing(['status'=>'1']);
        return view('admin.admission.view',compact('courseModuleData'));
        // $data = $this->_model->getListing(['id' => $id]);
        // return view('admin.' . $this->_routePrefix . '.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $srch_params['id']=$id;
        $admission                = $this->_model->getListing($srch_params, $this->_offset);


        $courseModule       = new CourseModule();
        $courseModuleData      = $courseModule->getListing(['status'=>'1']);
        return view('admin.admission.edit',compact('courseModuleData','admission'));
        // return $this->__formUiGeneration($request, $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request->all());
        // return $this->__formPost($request);

        $validationRules = [
            'name'          => 'required',
            'f_name'          => 'required',
            'dob'          => 'required',
            'doa'          => 'required',
            'course_name'          => 'required',
            'c_code'          => 'required',
        ];

        $this->validate($request, $validationRules);

        $input      = $request->all();
        $courseModule       = new CourseModule();
        $courseModuleRow=$courseModule->getListing(['id'=>$input['course_name']]);
    
        $userId     	=       \Auth::user()->id;
        $user       = new User();
        $userRow=$user->getListing(['id'=>$userId]);

        $student_info_id= $input['student_info_id'];
        $student_edu_id= $input['student_edu_id'];
      
        $admission_info = [
			"name" => $input['name'],
			"f_name" => $input['f_name'],
            "dob"=>$input['dob'],
            "doa"=>$input['doa'],
            "course_name"=> $courseModuleRow->name,
            "c_code"=>$input['c_code'],
            "address"=>$input['address'],
            "po"=>$input['po'],
            "ps"=>$input['ps'],
            "dis"=>$input['dis'],
            "pin"=>$input['pin'],
            "l_no"=>$input['l_no'],
            "m_no"=>$input['m_no'],
            "religion"=>$input['religion'],
            "cast"=>$input['cast'],
            "admission_form_number"=>$input['admission_form_number'],
            "total_fees"=>$input['total_fees'],
            "course_id"=>$input['course_name']
		];
        $return_data = Admission::where('id',$student_info_id)->update($admission_info);
    
        $admission_details = [
			"exam" => $input['exam'],
            "year"=>$input['year'],
            "board"=>$input['board'],
            "marks"=>$input['marks'],
            "10th_year"=>$input['10th_year'],
            "10th_board"=>$input['10th_board'],
            "10th_marks"=>$input['10th_marks'],
            "12th_year"=>$input['12th_year'],
            "12th_board"=>$input['12th_board'],
            "12th_marks"=>$input['12th_marks'],
            "g_year"=>$input['g_year'],
            "g_board"=>$input['g_board'],
            "g_marks"=>$input['g_marks'],
            "p_year"=>$input['p_year'],
            "p_board"=>$input['p_board'],
            "p_marks"=>$input['p_marks']
		];

		AdmissionDetails::where('table_id',$student_edu_id)->update($admission_details);
        return redirect()
                ->route($this->_routePrefix . '.index')
                ->with('success','Admission upadded successfully.');
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

    public function generate_certificate(Request $request, $id)
    {
        $srch_params['id']=$id;
        $admission                = $this->_model->getListing($srch_params, $this->_offset);

       // echo "<pre/>"; print_r($admission); die;
        $courseModule       = new CourseModule();
        $courseModuleData      = $courseModule->getListing(['status'=>'1']);
        return view('admin.admission.generate_certificate',compact('courseModuleData','admission'));
        
    }
    public function download_certificate(Request $request)
    {
        //echo "<pre/>"; print_r($request->all()); die;
        $data=[];
        $srch_params['id']=$request->student_info_id;
        $admission = $this->_model->getListing($srch_params, $this->_offset);
        $data['admission']=$admission;
        $data['form_request']=$request->all();

        
        $pdf = PDF::loadView('admin/admission/certificatepdf', ['data'=>$data], [], 
        [ 
          'title' => 'Certificate', 
          'format' => [1000, 380],
          'orientation' => 'L'
        ]);
        return $pdf->stream('certificatepdf.pdf');
    }


}
