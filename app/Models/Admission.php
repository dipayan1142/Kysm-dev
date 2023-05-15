<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Admission extends Model
{
    use SoftDeletes;

    protected $table    = 'student_info';
    
    protected $fillable = [
        'c_id',
        'center_id',
        'name',
        'f_name',
        'dob',
        'doa',
        'course_name',
        'c_code',
        'address',
        'po',
        'ps',
        'dis',
        'pin',
        'l_no',
        'm_no',
        'religion',
        'cast',
        's_id',
        's_idn',
        'course_id',
        'admission_form_number',
        'total_fees',
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
        $centerArr=[];
        
        $userId     	=       \Auth::user()->id;
        $getRole = \App\Helpers\Helper::get_role($userId);
        
        if($getRole==1){
        $getCenter = DB::table('users')
            ->select('users.id','users.center_name')
            ->leftJoin('user_roles', 'user_roles.user_id', '=', 'users.id')
            ->where('user_roles.role_id', '2')
            ->where('users.status', '1')
            ->whereNull('users.deleted_at')
            ->orderBy('users.created_at', 'DESC')
            ->get();
            foreach ($getCenter as $key => $cVal) {
               $centerArr[$cVal->id]=$cVal->center_name;
            }
        }

		return [
            'reset' => route('admission.index'),
			'fields' => [
				'name'          => [
		            'type'      => 'text',
		            'label'     => 'Name'
		        ],
		        'm_no'         => [
		            'type'      => 'text',
		            'label'     => 'Mobile No'
		        ],
                'center_id'     => [
                    'type'       => 'select',
                    'label'      => 'Center',
                    'attributes' => [
                        'id' => 'select-center_id',
                    ],
                    'options'    => $centerArr,
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

        $user       = \Auth::user();
       

        // dd($user);

        $listing = self::select(
                $this->table . ".*","student_edu_info.exam","student_edu_info.year","student_edu_info.board","student_edu_info.marks","student_edu_info.10th_year as ten_year","student_edu_info.10th_board as ten_board","student_edu_info.10th_marks as ten_marks","student_edu_info.12th_year as tw_year","student_edu_info.12th_board as tw_board","student_edu_info.12th_marks as tw_marks","student_edu_info.g_year","student_edu_info.g_board","student_edu_info.g_marks","student_edu_info.p_year","student_edu_info.p_board","student_edu_info.p_marks","student_edu_info.table_id as student_edu_id"
            )->leftJoin('student_edu_info', 'student_edu_info.student_info_id', '=', $this->table.'.id')
            ->when(isset($srch_params['with']), function ($q) use ($srch_params) {
				return $q->with($srch_params['with']);
			})
            ->when(isset($srch_params['name']), function($q) use($srch_params){
                return $q->where($this->table . ".name", "LIKE", "%{$srch_params['name']}%");
            })
            ->when(isset($srch_params['m_no']), function($q) use($srch_params){
                return $q->where($this->table . ".m_no", "LIKE", "%{$srch_params['m_no']}%");
            })
            ->when(isset($srch_params['center_id']), function($q) use($srch_params){
                return $q->where($this->table . ".center_id", $srch_params['center_id']);
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

        if ($user->id !=1)
        {
            $listing->where($this->table . '.c_id', $user->username);
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
