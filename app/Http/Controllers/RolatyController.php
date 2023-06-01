<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseModule;
use App\Models\User;
use App\Models\PaymentHistory;
use DB;
class RolatyController extends Controller
{
    public function __construct($parameters = array())
    {
        parent::__construct($parameters);
        
        $this->_module      = 'Royalty';
        $this->_routePrefix = 'royalty';
        $this->_model       = new PaymentHistory();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
        $this->initIndex();
        $this->_data['permisssionState']    = \App\Models\Permission::checkModulePermissions(['index'], 'RolatyController');
        $srch_params                        = $request->all();
        $srch_params['payment_type']        = 2;
        
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
        
        $userModule       = new User();
       
        $userM = DB::table('users')
            ->select('users.center_name','users.id','users.username')
            ->leftJoin('user_roles', 'user_roles.user_id', '=', 'users.id')
            ->where('user_roles.role_id', '2')
            ->where('users.status', '1')
            ->whereNull('users.deleted_at')
            ->orderBy('users.created_at', 'DESC')
            ->get();
        $centerData=[];    
        foreach ($userM as $key => $useVal) {
           
            $centerData[$useVal->username]=$useVal->center_name.' ('.$useVal->username.')';
        }
       
        extract($this->_data);
       
        $status = \App\Helpers\Helper::makeSimpleArray($this->_model->statuses, 'id,name');
        $courseArOption=[
            '0'=>'NO',
            '1'=>'YES'
        ];
        $form = [
            'route'      => $this->_routePrefix . ($id ? '.update' : '.store'),
            'back_route' => route($this->_routePrefix . '.index'),
            // 'include_scripts'   => '<script src="'. asset('administrator/admin-form-plugins/royalty.js'). '"></script>',
            'fields'     => [
                'center_id'      => [
                    'type'          => 'select',
                    'label'         => 'Select Center',
                    'options'       => $centerData,
                    'value'         => isset($data->module_id) ? $data->module_id : 1,
                    'attributes'    => [
                        
                        'required'  => true
                    ]
                ],

                // 'center_id'        => [
                //     'type'          => 'text',
                //     'label'         => 'Center Id',
                //     'attributes'    => [
                        
                //         'required'  => true
                //     ]
                // ],
                'center_wallet_update'        => [
                    'type'          => 'hidden',
                    'value'         =>'wallet_update'
                ],
                'payment_type'        => [
                    'type'          => 'hidden',
                    'value'         =>2
                ],
                'amount'        => [
                    'type'          => 'text',
                    'label'         => 'Amount',
                    'attributes'    => [
                        
                        'required'  => true
                    ]
                ],
       
                'note'        => [
                    'type'          => 'text',
                    'label'         => 'Message',
                    'attributes'    => [
                        
                        'required'  => true
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
            'center_id'          => 'required',
            'amount'          => 'required',
            
        ];

        $this->validate($request, $validationRules);

        $input      = $request->all();
      
        $response   = $this->_model->store($input, $id, $request);

        $center_total = User::select('center_wallet')->where('username', '=', $input['center_id'])->first();

        User::where('username', '=', $input['center_id'])->update(['center_wallet' => $center_total->center_wallet+$input['amount']]);
          
        
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