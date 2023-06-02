<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Course;
use App\Models\CourseModule;
use App\Models\User;
use App\Models\PaymentHistory;
use App\Models\Admission;

class Registration extends Model
{
    use SoftDeletes;

    protected $table    = 'registrations';
    
    protected $fillable = [
        'registration_number',
        'name',
        'father_name',
        'module_id',
        'module_name',
        'course_id',
        'course_name',
        'status'
    ];

    protected $hidden = [
    	'updated_at',
    	'deleted_at'
    ];

    public $statuses = [
        0=> [
            'id' => 0,
            'name' => 'Disabled',
            'badge' => 'warning'
        ],
        1=> [
            'id' => 1,
            'name' => 'Enabled',
            'badge' => 'success'
        ],
    ];

    public $orderBy = [];

    public function getFilters()
	{
        $status         = \App\Helpers\Helper::makeSimpleArray($this->statuses, 'id,name');
		return [
            // 'reset' => route('semester.show'),
			'fields' => [
				
                
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
            ->when(isset($srch_params['name']), function($q) use($srch_params){
                return $q->where($this->table . ".name", "LIKE", "%{$srch_params['name']}%");
            })
            ->when(isset($srch_params['tag_line']), function($q) use($srch_params){
                return $q->where($this->table . ".tag_line", "LIKE", "%{$srch_params['tag_line']}%");
            })
            ->when(isset($srch_params['status']), function($q) use($srch_params){
                return $q->where($this->table . '.status', '=', $srch_params['status']);
            })
            ->when(isset($srch_params['course_id']), function($q) use($srch_params){
                return $q->where($this->table . '.course_id', '=', $srch_params['course_id']);
            });


        if(isset($srch_params['id'])){
            return $listing->where($this->table . '.id', '=', $srch_params['id'])
                            ->first();
        }

        if(isset($srch_params['orderBy'])){
            $this->orderBy = \App\Helpers\Helper::manageOrderBy($srch_params['orderBy']);
            foreach ($this->orderBy as $key => $value) {
                $listing->orderBy($key, $value);
            }
        } else {
            $listing->orderBy($this->table . '.id', 'ASC');
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
    //    dd($input);
        $module_id=$input['module_id'];
        $course_id=$input['course_id'];

        $courseModule       = new CourseModule();
        $courseModuleData      = $courseModule->getListing(['id'=>$module_id]);
        
        $courseM       = new Course();
        $courseMData      = $courseM->getListing(['id'=>$course_id]);

        $admissionM       = new Admission();
        $admissionMData      = $admissionM->getListing(['registration_number'=>$input['registration_number']]);
        
        $center_total = User::select('center_wallet')->where('id', '=', $admissionMData['center_id'])->first();
        $data 						= null;
        if($center_total->center_wallet>=$courseMData['reg_fee'])
        {

            User::where('id', '=', $admissionMData['center_id'])->update(['center_wallet' => $center_total->center_wallet-$courseMData['reg_fee']]);

            $paymentM=new PaymentHistory();

            $payment_input=[
                'center_id'=>$admissionMData->c_id,
                'admission_id'=>$admissionMData->id,
                'amount'=>$courseMData['reg_fee'],
                'payment_type'=>3,
                ''
            ];
            $paymentM->store($payment_input);

            $input['module_name']=$courseModuleData->name;
            $input['course_name']=$courseMData->course_name;

            
            if ($id) 
            {
                $data = $this->getListing(['id' => $id]);
                
                if(!$data) {
                    return \App\Helpers\Helper::resp('Not a valid data', 400);
                }

                $data->update($input);
            } 
            else 
            {
                $data   = $this->create($input);
            }
            
            return \App\Helpers\Helper::resp('Changes has been successfully saved.', 200, $data);
        }
        else
        {
            return \App\Helpers\Helper::resp('Pleac check your balance.', 201, $data);
        }
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
