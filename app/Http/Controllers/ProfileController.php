<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
// use Hash;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Models\CourseModule;
use DB;
class ProfileController extends Controller
{
    public function __construct($parameters = array())
    {
        parent::__construct($parameters);
        
        $this->_module      = 'profile Update';
        $this->_routePrefix = 'profile';
        $this->_model       = new User();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // echo "+++";
        // die;
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
        $id=Auth::user()->id;
        $selectmodule=[];
        $response = $this->initUIGeneration($id);
       

        if($response) {
            return $response;
        }
    
        extract($this->_data);
       
        $breadcrumb =[
            "http://127.0.0.1:8000/admin/profile/create" => "Profile Update",
            "#" => "Add Profile Update"
        ];
        
        $status = \App\Helpers\Helper::makeSimpleArray($this->_model->statuses, 'id,name');
        $courseModule       = new CourseModule();
        $courseM       = $courseModule->getListing(['status'=>'1'])
            ->pluck('name', 'id')
            ->all();

        $selectmodule=DB::table('center_permission_modules')->where('center_id', $id)->pluck('module_id')->all();

        dd($selectmodule);
     

        $form = [
			'route'      		=> $this->_routePrefix . ($id ? '.store' : '.store'),
			'back_route' 		=> route($this->_routePrefix . '.index'),
			'include_scripts'   => '<script src="'. asset('administrator/admin-form-plugins/form-controls.js'). '"></script>',
			'fields'     => [
				'center_name'       => [
					'type'       => 'text',
					'label'      => 'Center Name',
					'attributes' => ['required' => true],
				    
				],

				'username'             => [
				    'type'       => 'text',
				    'label'      => 'User ID',
				    'help'       => 'Maximum 20 characters',
				    'attributes' => [
                                        'required' => true,
                                        'readonly' => true
                                    ],
				],
				
				'email'            => [
					'type'       => 'email',
					'label'      => 'Email',
					'attributes' => [
                                        'required' => true,
                                        'readonly' => true
                                    ],
				],
				'phone'            => [
					'type'       => 'text',
					'label'      => 'Phone',
					'attributes' => ['required' => true],
				],
				'center_incharge_name'       => [
					'type'       => 'text',
					'label'      => 'Center Incharge Name',
					'attributes' => ['required' => true],
				    
				],
                'profile_picture'       => [
					'type'       => 'file',
					'label'      => 'Profile Picture',
			
				    
				],
                'address'       => [
					'type'       => 'text',
					'label'      => 'Address',
					
				    
				],
                'qualification'       => [
					'type'       => 'text',
					'label'      => 'Qualification',
					
				    
				],
                'allternative_phone'       => [
					'type'       => 'text',
					'label'      => 'Allternative Phone Number',
				
				    
				],
				'module_id'          => [
					'type'       => 'checkbox',
					'label'      => 'Course Module',
					'options'    => $courseM,
					'attributes' => ['width' => 'col-lg-4 col-md-4 col-sm-12 col-xs-12'],
					  'value'      => $selectmodule,
				],
				'status'           => [
					'type'       => 'radio',
					'label'      => 'Status',
					'options'    => $status,
					'value'      => isset($data->status) ? $data->status : 1,
					'attributes' => ['width' => 'col-lg-4 col-md-4 col-sm-12 col-xs-12'],
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
            'current_password'   => 'required',
            'new_password'       => 'required',
            'confirm_password'   => 'required'
        ];

        $this->validate($request, $validationRules);

        $input      = $request->all();

        $srch_params['id'] =       \Auth::user()->id;
        $srch_params['single_record'] = true ;
        $user_row=$this->_model->getListing($srch_params, $this->_offset);
        
        if(Hash::check($input['current_password'],$user_row->password))
        {
            // dd($user_row);
            $input['password'] = Hash::make($input['current_password']);

            // $data = \Auth::user();
			// $data->update($input);

            // $user_row->password=$input['password'];
            // $user_row->update($input);
            $this->_model::where('id',$srch_params['id'])->update(['password'=>$input['password']]);
        
            return redirect()
                    ->route($this->_routePrefix . '.create')
                    ->with('success','Password change successfully.');
           
        }
        else
        {
            return redirect()
                    ->route($this->_routePrefix . '.create')
                    ->with('error', 'Your current password is incorrect.');
        } 
    }
    
}
