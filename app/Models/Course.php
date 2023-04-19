<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;

    protected $table    = 'courses';
    
    protected $fillable = [
        
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
		return [
            'reset' => route('location.countries.index'),
			'fields' => [
				'country_name'          => [
		            'type'      => 'text',
		            'label'     => 'Name'
		        ],
		        'code'         => [
		            'type'      => 'text',
		            'label'     => 'Country code'
		        ],
		        'phone_code'        => [
		            'type'      => 'text',
		            'label'     => 'Phone code'
		        ],
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
                $this->table . ".*"
            )
            ->when(isset($srch_params['with']), function ($q) use ($srch_params) {
				return $q->with($srch_params['with']);
			})
            ->when(isset($srch_params['course_name']), function($q) use($srch_params){
                return $q->where($this->table . ".course_name", "LIKE", "%{$srch_params['course_name']}%");
            })
            ->when(isset($srch_params['code']), function($q) use($srch_params){
                return $q->where($this->table . ".country_code", "LIKE", "%{$srch_params['code']}%");
            })
            ->when(isset($srch_params['status']), function($q) use($srch_params){
                return $q->where($this->table . '.status', '=', $srch_params['status']);
            });

        if(isset($srch_params['id'])){
            return $listing->where($this->table . '.id', '=', $srch_params['id'])
                            ->first();
        }

        if(isset($srch_params['country_code'])){
            return $listing->where($this->table . '.country_code', '=', $srch_params['country_code'])
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
