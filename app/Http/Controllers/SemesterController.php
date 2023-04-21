<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Semester;

class SemesterController extends Controller
{
    public function __construct($parameters = array())
    {
        parent::__construct($parameters);
        
        $this->_module      = 'semester';
        $this->_routePrefix = 'semester';
        $this->_model       = new Semester();
    }

    


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$id= 0)
    {
    
        $this->initIndex();

        $srch_params                        = $request->all();
        $this->_data['userId']     	=       \Auth::user()->id;
        $this->_data['data']                = $this->_model->getListing($srch_params, $this->_offset);
        $this->_data['orderBy']             = $this->_model->orderBy;
        $this->_data['filters']             = $this->_model->getFilters();
        // dd( $this->_data);
        return view('admin.' . $this->_routePrefix . '.index', $this->_data)
            ->with('i', ($request->input('page', 1) - 1) * $this->_offset);
        
        // return view('admin.' . $this->_routePrefix . '.module_index');
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,$id)
    {
        // echo "+++".$id;die;
        return $this->__formUiGenerationCreate($request,$id);
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
       
        $this->initIndex();

        $srch_params['course_id']                        = $id;
        $this->_data['userId']     	=       \Auth::user()->id;
        $this->_data['course_id']     	=    $id;
        $this->_data['data']                = $this->_model->getListing($srch_params, $this->_offset);
        $this->_data['orderBy']             = $this->_model->orderBy;
        // $this->_data['filters']             = $this->_model->getFilters();
        // dd($this->_data);
        return view('admin.' . $this->_routePrefix . '.index', $this->_data);
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

        extract($this->_data);
        $status = \App\Helpers\Helper::makeSimpleArray($this->_model->statuses, 'id,name');
        $form = [
            'route'      => $this->_routePrefix . ($id ? '.update' : '.store'),
            'back_route' => route($this->_routePrefix . '.index'),
            'fields'     => [
                'name'      => [
                    'type'          => 'text',
                    'label'         => 'Name',
                    'attributes'    => [
                        'required'  => true
                    ]
                ],
                'tag_line'      => [
                    'type'          => 'text',
                    'label'         => 'Tag line',
                    'attributes'    => [
                        'required'  => true
                    ]
                ],
                'description'      => [
                    'type'          => 'textarea',
                    'label'         => 'Description',
                    'attributes'    => [
                        'required'  => true
                    ]
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
     * ui parameters for form add and edit
     *
     * @param  string $id [description]
     * @return [type]     [description]
     */
    protected function __formUiGenerationCreate(Request $request, $id = '')
    {
        $course_id = (isset($id))? $id : '';
        $response = $this->initUIGeneration();
        if($response) {
            return $response;
        }

        extract($this->_data);
        $this->_data['data'] = [];
        $status = \App\Helpers\Helper::makeSimpleArray($this->_model->statuses, 'id,name');
        $form = [
            'route'      => $this->_routePrefix.'.store',
            'back_route' => route($this->_routePrefix . '.index'),
            'fields'     => [
                'name'      => [
                    'type'          => 'text',
                    'label'         => 'Name',
                    'attributes'    => [
                        'required'  => true
                    ]
                ],
                'course_id'      => [
                    'type'          => 'hidden',
                    'label'         => 'Course Id',
                    'value'         => $course_id,
                    'attributes'    => [
                        'required'  => true
                    ]
                ],
                'tag_line'      => [
                    'type'          => 'text',
                    'label'         => 'Tag line',
                    'attributes'    => [
                        'required'  => true
                    ]
                ],
                'description'      => [
                    'type'          => 'textarea',
                    'label'         => 'Description',
                    'attributes'    => [
                        'required'  => true
                    ]
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
            'name'          => 'required',
            'description'          => 'required',
        ];

        $this->validate($request, $validationRules);

        $input      = $request->all();
        $response   = $this->_model->store($input, $id, $request);

        if($response['status'] == 200){
            return redirect()
                ->route($this->_routePrefix . '.show',$response['data']->course_id)
                ->with('success',  $response['message']);
        } else {
            return redirect()
                    ->route($this->_routePrefix .'.show',$response['data']->course_id)
                    ->with('error', $response['message']);
        }
    }
}
