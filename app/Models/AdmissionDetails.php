<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdmissionDetails extends Model
{
    use SoftDeletes;

    protected $table    = 'student_edu_info';
    
    protected $fillable = [
        'c_id',
        'student_info_id',
        'exam',
        'year',
        'board',
        'marks',
        '10th_in_name',
        '10th_year',
        '10th_board',
        '10th_marks',
        '12th_year',
        '12th_board',
        '12th_marks',
        'g_year',
        'g_board',
        'g_marks',
        'p_year',
        'p_board',
        'p_marks',
        's_id',
        'status',
        
    ];

    protected $hidden = [
    	'updated_at',
    	
    ];

    public $statuses = [
        0=> [
            'id' => 0,
            'name' => 'Inactive',
            'badge' => 'warning'
        ],
        1=> [
            'id' => 1,
            'name' => 'Active',
            'badge' => 'success'
        ],
    ];

    public $orderBy = [];

    public function getFilters()
	{
        $status         = \App\Helpers\Helper::makeSimpleArray($this->statuses, 'id,name');
        $courseModule       = new CourseModule();
        $courseM       = $courseModule->getListing(['status'=>'1'])
            ->pluck('name', 'id')
            ->all();
		return [
            'reset' => route('course.index'),
			'fields' => [
                'module_id'     => [
                    'type'       => 'select',
                    'label'      => 'Module',
                    'attributes' => [
                        'id' => 'module',
                    ],
                    'options'    => $courseM,
                ],
				'course_name'          => [
		            'type'      => 'text',
		            'label'     => 'Course Name'
		        ],
		        'course_title'         => [
		            'type'      => 'text',
		            'label'     => 'Course Title'
		        ],
		        // 'tag_line'        => [
		        //     'type'      => 'text',
		        //     'label'     => 'Tag Line'
		        // ],
		        'status'     => [
                    'type'       => 'select',
                    'label'      => 'Status',
                    'attributes' => [
                        'id' => 'select-status',
                    ],
                    'options'    => $status,
                ],
			]
		];
	}

    public function getListing($srch_params = [], $offset = 0)
    {
        $listing = self::select(
                $this->table . ".*",
                'course_module.name'
            )->leftJoin('course_module', 'course_module.id', '=', $this->table.'.module_id')
            ->when(isset($srch_params['with']), function ($q) use ($srch_params) {
				return $q->with($srch_params['with']);
			})
            ->when(isset($srch_params['course_name']), function($q) use($srch_params){
                return $q->where($this->table . ".course_name", "LIKE", "%{$srch_params['course_name']}%");
            })
            ->when(isset($srch_params['course_title']), function($q) use($srch_params){
                return $q->where($this->table . ".course_title", "LIKE", "%{$srch_params['course_title']}%");
            })
            ->when(isset($srch_params['module_id']), function($q) use($srch_params){
                return $q->where($this->table . ".module_id", "=",$srch_params['module_id']);
            })
            ->when(isset($srch_params['status']), function($q) use($srch_params){
                return $q->where($this->table . '.status', '=', $srch_params['status']);
            });

        if(isset($srch_params['id'])){
            return $listing->where($this->table . '.id', '=', $srch_params['id'])
                            ->first();
        }

        if(isset($srch_params['tag_line'])){
            return $listing->where($this->table . '.tag_line', '=', $srch_params['tag_line'])
                            ->first();
        }

   
        if(isset($srch_params['orderBy'])){
            $this->orderBy = \App\Helpers\Helper::manageOrderBy($srch_params['orderBy']);
            foreach ($this->orderBy as $key => $value) {
                $listing->orderBy($key, $value);
            }
        } else {
            $listing->orderBy($this->table . '.created_at', 'DESC');
        }

        if (isset($srch_params['get_sql']) && $srch_params['get_sql']) {
            return \App\Helpers\Helper::getSql([
                $listing->toSql(),
                $listing->getBindings(),
            ]);
        }

        if($offset){
            $listing = $listing->paginate($offset);
        } else {
            $listing = $listing->get();
        }

        return $listing;
    }

    public function store($input = [], $id = 0, $request = null)
	{
		$data 						= null;
        if ($id) {
            $data = $this->getListing(['id' => $id]);

            if(!$data) {
				return \App\Helpers\Helper::resp('Not a valid data', 400);
			}

            $data->update($input);
        } else {
            $data   = $this->create($input);
		}
		
		return \App\Helpers\Helper::resp('Changes has been successfully saved.', 200, $data);
    }
    
    public function remove($id = null)
	{
		$data = $this->getListing([
			'id'    => $id,
		]);

		if(!$data) {
			return \App\Helpers\Helper::resp('Not a valid data', 400);
		}

		$data->delete();

		return \App\Helpers\Helper::resp('Record has been successfully deleted.', 200, $data);
	}
}
