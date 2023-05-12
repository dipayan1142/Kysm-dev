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
        $user_id=Auth::user()->id;
        $selectmodule=[];
        $response = $this->initUIGeneration($user_id);
       

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

        $selectmodule=DB::table('center_permission_modules')->where('center_id', $user_id)->pluck('module_id')->all();

        // dd($selectmodule);
     

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
                'avatar'           => [
					'type'       => 'file',
					'label'      => 'Avatar',
					'value'      => isset($data->profile_pic) ? $data->profile_pic : [],
					'attributes' => [
						'cropper' => true,
						'ratio'   => '200x200',
					],
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
               
                'banner_picture[]' => [
                    'type'          => 'file',
                    'label'         => 'banner_picture',
                    'attributes'    => ['multiple' => true],
                    'value'         => isset($data->banner_picture) ? $data->banner_picture : []
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
            'center_name'   => 'required',
            'username'       => 'required',
            'email'   => 'required',
            'phone'   => 'required',
            'center_incharge_name'   => 'required'
        ];

        $this->validate($request, $validationRules);

        $isOwnAcc = true;
		//
		// if this is not own account, it will
		// require role.
		//
		if (Auth::user()->id != $id) {
			$isOwnAcc = false;
		}
		//echo "<pre/>"; print_r($request->all()); die;
        $id=Auth::user()->id;
		$input    = $request->all();
		
		$response = $this->_model->store($input, $id, $request);

		if ($response['status'] == 200) {
			if (!$isOwnAcc) {
				return redirect()
					->route($this->_routePrefix . '.create')
					->with('success', $response['message']);
			} else {
				return redirect()
					->route($this->_routePrefix . '.create', $id)
					->with('success', $response['message']);
			}
		} 
        else 
        {
			return redirect()
				->route($this->_routePrefix . '.index')
				->with('error', $response['message']);
		}
    }

}
