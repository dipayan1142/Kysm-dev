<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transactions;
use App\Models\Admission;

class TransactionController extends Controller
{
    public function __construct($parameters = array())
    {
        parent::__construct($parameters);
        
        $this->_module      = 'Transactions';
        $this->_routePrefix = 'transaction';
        $this->_model       = new Transactions();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
        $this->initIndex();
        $this->_data['permisssionState']    = \App\Models\Permission::checkModulePermissions(['index'], 'TransactionController');
    
        $srch_params                        = $request->all();
        $this->_data['data']                = $this->_model->getListing($srch_params, $this->_offset);
        $this->_data['orderBy']             = $this->_model->orderBy;
        $this->_data['filters']             = $this->_model->getFilters();
        // dd($this->_data['data']);
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
        $admission       = new Admission();
        $admissionM       = $admission->getListing(['status'=>'1'])
            ->pluck('name', 'id')
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
            'fields'     => [
                'admission_id'      => [
                    'type'          => 'select',
                    'label'         => 'Select Admission',
                    'options'       => $admissionM,
                    'value'         => isset($data->admission_id) ? $data->admission_id : 1,
                    'attributes'    => [
                        
                        'required'  => true
                    ]
                ],
                'amount'      => [
                    'type'          => 'number',
                    'label'         => 'Amount',
                    'attributes'    => [
                        'required'  => true
                    ]
                ],
                'note'      => [
                    'type'          => 'textarea',
                    'label'         => 'Note',
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
            'admission_id'          => 'required',
            'amount'          => 'required',
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
