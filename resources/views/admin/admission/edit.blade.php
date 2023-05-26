@php ($headerOption = [
'title' => 'admission',
// 'header_buttons' => [
// ($permission['create'] ? '<a class="btn btn-primary waves-effect" href="'. route($routePrefix . '.create') .'" data-toggle="tooltip" data-original-title="Add New Record">'. \Config::get('settings.icon_add') .' <span>Add New</span></a>' : '')
// ],
// 'filters' => isset($filters) ? $filters : [],
// 'data' => isset($data) ? $data : []
])
@extends('admin.layouts.layout', $headerOption)


@section('content')

 <div class="container">
  <form method="POST" action="{{ route('admission.update') }}" accept-charset="UTF-8" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-6">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="hidden" name="student_info_id" value="{{ $admission->id }}">
              <input type="hidden" name="student_edu_id" value="{{ $admission->student_edu_id }}">
              <input type="text"
                class="form-control" name="name" id="name" value="{{$admission->name}}">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
              <label for="name">Father Name</label>
              <input type="text"
                class="form-control" name="f_name" id="f_name" value="{{$admission->f_name}}">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
              <label for="name">Date of Birth</label>
              <input type="date"
                class="form-control" name="dob" id="dob" value="{{$admission->dob}}">
            </div>
        </div>
        <div class="col-6">
          <div class="form-group">
            <label for="name">Date of Admission</label>
            <input type="date"
              class="form-control" name="doa" id="doa" value="{{$admission->doa}}">
          </div>
        </div>
        <div class="col-6">
          <div class="form-group">
            <label for="name">Module Name</label>
            <select id="course_name" class="form-control"  name="course_name">
              @foreach ($courseModuleData as $item)
                <option value="{{ $item->id}}" {{ $item->id==$admission->course_id ? 'selected' : '' }}>{{ $item->name}}</option>
              @endforeach
            </select>
          </div>
        </div>

      <div class="col-6">
        <div class="form-group">
          <label for="name">Course Code</label>
          <select id="c_code" class="form-control"  name="c_code">
            <option value="">Select Option</option>
            <option value="3">test</option>
            <option value="4">module1</option>
          </select>
        </div>
      </div>

      <div class="col-12">
        <div class="form-group">
          <label for="name">Address</label>
          <textarea id="address" class="form-control" name="address" cols="50" rows="4">{{$admission->address}}</textarea>
        </div>
      </div>

      <div class="col-6">
        <div class="form-group">
          <label for="name">Post Office</label>
          <input type="text"
            class="form-control" name="po" id="po" value="{{$admission->po}}">
        </div>
      </div>

      <div class="col-6">
        <div class="form-group">
          <label for="name">Police Station</label>
          <input type="text"
            class="form-control" name="ps" id="ps" value="{{$admission->ps}}">
        </div>
      </div>

      <div class="col-6">
        <div class="form-group">
          <label for="name">District</label>
          <input type="text"
            class="form-control" name="dis" id="dis" value="{{$admission->dis}}">
        </div>
      </div>

      <div class="col-6">
        <div class="form-group">
          <label for="name">Pin Code</label>
          <input type="text"
            class="form-control" name="pin" id="pin" value="{{$admission->pin}}">
        </div>
      </div>

      <div class="col-6">
        <div class="form-group">
          <label for="name">Mobile No</label>
          <input type="text"
            class="form-control" name="m_no" id="m_no" value="{{$admission->m_no}}">
        </div>
      </div>

      <div class="col-6">
        <div class="form-group">
          <label for="name">Whatsapp No</label>
          <input type="text"
            class="form-control" name="l_no" id="l_no" value="{{$admission->l_no}}">
        </div>
      </div>

      <div class="col-6">
        <div class="form-group">
          <label for="name">Religion</label>
          <select id="religion" class="form-control"  name="religion">
            <option value="Hinduism" {{ $admission->religion=='Hinduism' ? 'selected' : '' }}>Hinduism</option>
            <option value="Christianity" {{ $admission->religion=='Christianity' ? 'selected' : '' }}>Christianity</option>
            <option value="Islam" {{ $admission->religion=='Islam' ? 'selected' : '' }}>Islam</option>
            <option value="Buddhism" {{ $admission->religion=='Buddhism' ? 'selected' : '' }}>Buddhism</option>
            <option value="Jainism" {{ $admission->religion=='Jainism' ? 'selected' : '' }}>Jainism</option>
            <option value="Sikhism" {{ $admission->religion=='Sikhism' ? 'selected' : '' }}>Sikhism</option>
            <option value="Zoroastrianism" {{ $admission->religion=='Zoroastrianism' ? 'selected' : '' }}>Zoroastrianism</option>
            <option value="Other" {{ $admission->religion=='Other' ? 'selected' : '' }}>Other</option>
          </select>
        </div>
      </div>

      <div class="col-6">
        <div class="form-group">
          <label for="name">Cast</label>
          <select id="cast" class="form-control"  name="cast">
            <option value="General" {{ $admission->cast=='General' ? 'selected' : '' }}>General</option>
            <option value="SC" {{ $admission->cast=='SC' ? 'selected' : '' }}>SC</option>
            <option value="ST" {{ $admission->cast=='ST' ? 'selected' : '' }}>ST</option>
            <option value="OBC-A" {{ $admission->cast=='OBC-A' ? 'selected' : '' }}>OBC-A</option>
            <option value="OBC-B" {{ $admission->cast=='OBC-B' ? 'selected' : '' }}>OBC-B</option>
          </select>
        </div>
      </div>

      

      <div class="col-6">
        <div class="form-group">
          <label for="name">Admission Form Number</label>
          <input type="text"
            class="form-control" name="admission_form_number" id="admission_form_number" value="{{$admission->admission_form_number}}">
        </div>
      </div>

      <div class="col-6">
        <div class="form-group">
          <label for="name">Total Fees</label>
          <input type="text"
            class="form-control" name="total_fees" id="total_fees" value="{{$admission->total_fees}}">
        </div>
      </div>


    </div>
    <div class="row mt-3">
      <div class="col-3">
        <p class="">Qualification</p>
      </div>
      <div class="col-3">
        <p>Year</p>
      </div>
      <div class="col-3">
        <p>Board/University</p>
      </div>
      <div class="col-3">
        <p>% of Marks</p>
      </div>
    </div>

    <div class="row mt-2">
      <div class="col-3">
        <select class="form-control" name="exam" id="exam">
          <option value="Playhouse" {{ $admission->exam=='Playhouse' ? 'selected' : '' }}>Playhouse</option>
          <option value="Std 1" {{ $admission->exam=='Std 1' ? 'selected' : '' }}>Std 1</option>
          <option value="Std 2" {{ $admission->exam=='Std 2' ? 'selected' : '' }}>Std 2</option>
          <option value="Std 3" {{ $admission->exam=='Std 3' ? 'selected' : '' }}>Std 3</option>
          <option value="Std 4" {{ $admission->exam=='Std 4' ? 'selected' : '' }}>Std 4</option>
          <option value="Std 5" {{ $admission->exam=='Std 5' ? 'selected' : '' }}>Std 5</option>
          <option value="Std 6" {{ $admission->exam=='Std 6' ? 'selected' : '' }}>Std 6</option>
          <option value="Std 7" {{ $admission->exam=='Std 7' ? 'selected' : '' }}>Std 7</option>
          <option value="Std 8" {{ $admission->exam=='Std 8' ? 'selected' : '' }}>Std 8</option>
          <option value="Std 9" {{ $admission->exam=='Std 9' ? 'selected' : '' }}>Std 9</option>
        </select>
      </div>
      <div class="col-3">
        <div class="form-group">
        
          <select class="form-control" name="year" id="year">
            @for($i=date('Y')-20; $i<=date('Y'); $i++)
            <option value="{{ $i }}" {{ $admission->g_year==$i ? 'selected' : '' }}>{{ $i }}</option>
            @endfor;
           
          </select>
        </div>
      </div>
      <div class="col-3">
        <select class="form-control" name="board" id="board">
          <option value="WBBSE" {{ $admission->board=='WBBSE' ? 'selected' : '' }}>WBBSE</option>
          <option value="CBSE" {{ $admission->board=='CBSE' ? 'selected' : '' }}>CBSE</option>
          <option value="ICSE" {{ $admission->board=='ICSE' ? 'selected' : '' }}>ICSE</option>
          <option value="Other" {{ $admission->board=='Other' ? 'selected' : '' }}>Other</option>
        </select>
      </div>
      <div class="col-3">
        <input type="text" class="form-control" name="marks" id="marks"  value="{{$admission->marks}}">
      </div>
    </div>

    <div class="row mt-2">
      <div class="col-3">
        <p>10th Standard</p>
      </div>
      <div class="col-3">
        <div class="form-group">
        

          <select class="form-control" name="10th_year" id="10th_year">
            @for($i=date('Y')-20; $i<=date('Y'); $i++)
            <option value="{{ $i }}" {{ $admission->g_year==$i ? 'selected' : '' }}>{{ $i }}</option>
            @endfor;
           
          </select>
          
        </div>
      </div>
      <div class="col-3">
        <select class="form-control" name="10th_board" id="10th_board">
          <option value="WBBSE" {{ $admission->ten_board=='WBBSE' ? 'selected' : '' }}>WBBSE</option>
          <option value="CBSE" {{ $admission->ten_board=='CBSE' ? 'selected' : '' }}>CBSE</option>
          <option value="ICSE" {{ $admission->ten_board=='ICSE' ? 'selected' : '' }}>ICSE</option>
          <option value="Other" {{ $admission->ten_board=='Other' ? 'selected' : '' }}>Other</option>
        </select>
      </div>
      <div class="col-3">
        <input type="text" class="form-control" name="10th_marks" id="10th_marks" value="{{$admission->ten_marks}}">
      </div>
    </div>

    <div class="row mt-2">
      <div class="col-3">
        <p>12th Standard</p>
      </div>
      <div class="col-3">
        <div class="form-group">
         

          <select class="form-control" name="12th_year" id="12th_year">
            @for($i=date('Y')-20; $i<=date('Y'); $i++)
            <option value="{{ $i }}" {{ $admission->g_year==$i ? 'selected' : '' }}>{{ $i }}</option>
            @endfor;
           
          </select>
        </div>
      </div>
      <div class="col-3">
        <select class="form-control" name="12th_board" id="12th_board">
          <option value="WBCHSE" {{ $admission->tw_board=='WBCHSE' ? 'selected' : '' }}>WBCHSE</option>
          <option value="CBSE" {{ $admission->tw_board=='CBSE' ? 'selected' : '' }}>CBSE</option>
          <option value="ISC" {{ $admission->tw_board=='ISC' ? 'selected' : '' }}>ISC</option>
          <option value="Other" {{ $admission->tw_board=='Other' ? 'selected' : '' }}>Other</option>
        </select>
      </div>
      <div class="col-3">
        <input type="text" class="form-control" name="12th_marks" id="12th_marks" value="{{$admission->tw_marks}}">
      </div>
    </div>

    <div class="row mt-2">
      <div class="col-3">
        <p>Graduate</p>
      </div>
      <div class="col-3">
        <div class="form-group">
          <select class="form-control" name="g_year" id="g_year">
            @for($i=date('Y')-20; $i<=date('Y'); $i++)
            <option value="{{ $i }}" {{ $admission->g_year==$i ? 'selected' : '' }}>{{ $i }}</option>
            @endfor;
           
          </select>
        </div>
      </div>
      <div class="col-3">
        <select class="form-control" name="g_board" id="g_board">
          <option value="C.U" {{ $admission->g_board=='C.U' ? 'selected' : '' }}>C. U.</option>
          <option value="J.U" {{ $admission->g_board=='J.U' ? 'selected' : '' }}>J. U.</option>
          <option value="B.U" {{ $admission->g_board=='B.U' ? 'selected' : '' }}>B. U.</option>
          <option value="R.B.U" {{ $admission->g_board=='R.B.U' ? 'selected' : '' }}>R. B. U.</option>
          <option value="K.U" {{ $admission->g_board=='K.U' ? 'selected' : '' }}>K. U.</option>
          <option value="V.U" {{ $admission->g_board=='V.U' ? 'selected' : '' }}>V. U.</option>
          <option value="NSOU" {{ $admission->g_board=='NSOU' ? 'selected' : '' }}>NSOU</option>
          <option value="IGNOU" {{ $admission->g_board=='IGNOU' ? 'selected' : '' }}>IGNOU</option>
          <option value="MAKAUT" {{ $admission->g_board=='MAKAUT' ? 'selected' : '' }}>MAKAUT</option>
          <option value="Other" {{ $admission->g_board=='Other' ? 'selected' : '' }}>Other</option>
        </select>
      </div>
      <div class="col-3">
        <input type="text" class="form-control" name="g_marks" id="g_marks" value="{{$admission->g_marks}}">
      </div>
    </div>

    <div class="row mt-2">
      <div class="col-3">
        <p>Post Graduate</p>
      </div>
      <div class="col-3">
        <div class="form-group">
          <select class="form-control" name="p_year" id="p_year">
            @for($i=date('Y')-20; $i<=date('Y'); $i++)
            <option value="{{ $i }}" {{ $admission->g_year==$i ? 'selected' : '' }}>{{ $i }}</option>
            @endfor;
           
          </select>
        </div>
      </div>
      <div class="col-3">
        <select class="form-control" name="p_board" id="p_board">
          <option value="C.U" {{ $admission->p_board=='C.U' ? 'selected' : '' }}>C. U.</option>
          <option value="J.U" {{ $admission->p_board=='J.U' ? 'selected' : '' }}>J. U.</option>
          <option value="B.U" {{ $admission->p_board=='B.U' ? 'selected' : '' }}>B. U.</option>
          <option value="R.B.U" {{ $admission->p_board=='R.B.U' ? 'selected' : '' }}>R. B. U.</option>
          <option value="K.U" {{ $admission->p_board=='K.U' ? 'selected' : '' }}>K. U.</option>
          <option value="V.U" {{ $admission->p_board=='V.U' ? 'selected' : '' }}>V. U.</option>
          <option value="NSOU" {{ $admission->p_board=='NSOU' ? 'selected' : '' }}>NSOU</option>
          <option value="IGNOU" {{ $admission->p_board=='IGNOU' ? 'selected' : '' }}>IGNOU</option>
          <option value="MAKAUT" {{ $admission->p_board=='MAKAUT' ? 'selected' : '' }}>MAKAUT</option>
          <option value="Other" {{ $admission->p_board=='Other' ? 'selected' : '' }}>Other</option>
        </select>
      </div>
      <div class="col-3">
        <input type="text" class="form-control" name="p_marks" id="p_marks"  value="{{$admission->p_marks}}">
      </div>
    </div>

    <div class="card-footer">
      <button type="submit" class="btn btn-primary btn-lg waves-effect"><i class="mdi mdi-content-save"></i> <span>Save Changes</span></button>
      <a href="http://127.0.0.1:8000/admin/course/index" class="btn btn-info btn-lg waves-effect"><i class="mdi mdi-keyboard-backspace"></i> <span>Back</span></a>
                      
    </div>
  </form>
 </div>

@include('admin.components.pagination')

@endsection