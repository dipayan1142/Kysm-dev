<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Hash;

class ChangePasswordController extends Controller
{
    public function __construct($parameters = array())
    {
        parent::__construct($parameters);
        
        $this->_module      = 'Change Password';
        $this->_routePrefix = 'change_password';
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
        $response = $this->initUIGeneration($id);
       

        if($response) {
            return $response;
        }
    
        extract($this->_data);
       
        $breadcrumb =[
            "http://127.0.0.1:8000/admin/change_password/create" => "Change Passwords",
            "#" => "Add Change Password"
        ];
        
        $form = [
            'route'      => $this->_routePrefix . ($id ? '.store' : '.store'),
            'back_route' => route($this->_routePrefix . '.create'),
            
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
            'current_password'   => 'required',
            'new_password'       => 'required',
            'confirm_password'   => 'required'
        ];

        $this->validate($request, $validationRules);

        $input      = $request->all();

        $srch_params['id'] =       \Auth::user()->id;
        $user_id        = \Auth::user()->id;
        $srch_params['single_record'] = true ;
        $data=$this->_model->getListing($srch_params, $this->_offset);
        
        if(Hash::check($input['current_password'],$data->password))
        {
            // dd($user_row);
            $update['password'] = Hash::make($input['new_password']);

			if (!$data) {
				return \App\Helpers\Helper::resp('Not a valid data', 400);
			}

			if ($data->update($update)) {
				$data = $this->_model->getListing([
					'id'              => $id,
					'id_greater_than' => $user_id,
				]);
			}
          
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
