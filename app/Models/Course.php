<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;

    protected $table    = 'courses';
    
    protected $fillable = [
        'module_id',
        'course_name',
        'course_title',
        'tag_line',
        'short_description',
        'duration',
        'enroll',
        'eligibility',
        'availibity',
        'about_course',
        'key_features',
        'status',
        'is_propular_course',
        'reg_fee'
        
    ];

    protected $hidden = [
    	'updated_at',
    	
    ];

    // for course
	protected $appends = [
		'course_image',
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

    public function getCourseAttribute()
	{
		return File::file($this->course_pic, 'no-profile.jpg');
	}

    
	public function course_pic()
	{
		$entityType = isset(File::$fileType['course_picture']['type']) ? File::$fileType['course_picture']['type'] : 0;
		return $this->hasOne('App\Models\File', 'entity_id', 'id')
			->where('entity_type', $entityType);
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
        $avatar                     = [];
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
		$this->uploadCourse($data, $id, $request);
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

    public function uploadCourse($data = [], $id = 0, $request = null)
	{
		$avatar = $data->course_pic;
		$file   = \App\Models\File::upload($request, 'course_picture', 'course_picture', $data->id);

		// if file has successfully uploaded
		// and previous file exists, it will
		// delete old file.
		if ($file && $avatar) {
			\App\Models\File::deleteFile($avatar, true);
		}

		return \App\Helpers\Helper::resp('Changes has been successfully saved.', 200, $file);
	}

}
