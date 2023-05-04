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
  <form method="POST" action="http://127.0.0.1:8000/admin/admission/store" accept-charset="UTF-8" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-6">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text"
                class="form-control" name="name" id="name" placeholder="Enter Your Name">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
              <label for="name">Father Name</label>
              <input type="text"
                class="form-control" name="f_name" id="f_name" placeholder="Enter Your Father Name">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
              <label for="name">Date of Birth</label>
              <input type="date"
                class="form-control" name="dob" id="dob" placeholder="Enter Your Date of Birth">
            </div>
        </div>
        <div class="col-6">
          <div class="form-group">
            <label for="name">Date of Admission</label>
            <input type="date"
              class="form-control" name="doa" id="doa" placeholder="Enter Your Date of Admission">
          </div>
        </div>
        <div class="col-6">
          <div class="form-group">
            <label for="name">Module Name</label>
            <select required="" id="course_name" class="form-control"  name="course_name">
              <option value="">Select Option</option>
              <option value="3">test</option>
              <option value="4">module1</option>
            </select>
          </div>
        </div>

      <div class="col-6">
        <div class="form-group">
          <label for="name">Course Code</label>
          <select required="" id="c_code" class="form-control"  name="c_code">
            <option value="">Select Option</option>
            <option value="3">test</option>
            <option value="4">module1</option>
          </select>
        </div>
      </div>

      <div class="col-12">
        <div class="form-group">
          <label for="name">Address</label>
          <textarea required="" id="address" class="form-control" name="address" cols="50" rows="4"></textarea>
        </div>
      </div>

      <div class="col-6">
        <div class="form-group">
          <label for="name">Post Office</label>
          <input type="text"
            class="form-control" name="po" id="po" placeholder="Enter Your Post Office">
        </div>
      </div>

      <div class="col-6">
        <div class="form-group">
          <label for="name">Police Station</label>
          <input type="text"
            class="form-control" name="ps" id="ps" placeholder="Enter Your Police Station">
        </div>
      </div>

      <div class="col-6">
        <div class="form-group">
          <label for="name">District</label>
          <input type="text"
            class="form-control" name="dis" id="dis" placeholder="Enter Your District">
        </div>
      </div>

      <div class="col-6">
        <div class="form-group">
          <label for="name">Pin Code</label>
          <input type="text"
            class="form-control" name="pin" id="pin" placeholder="Enter Your Pin Code">
        </div>
      </div>

      <div class="col-6">
        <div class="form-group">
          <label for="name">Mobile No</label>
          <input type="text"
            class="form-control" name="l_no" id="l_no" placeholder="Enter Your Mobile No">
        </div>
      </div>

      <div class="col-6">
        <div class="form-group">
          <label for="name">Whatsapp No</label>
          <input type="text"
            class="form-control" name="m_no" id="m_no" placeholder="Enter Your Whatsapp No">
        </div>
      </div>

      <div class="col-6">
        <div class="form-group">
          <label for="name">Religion</label>
          <select required="" id="religion" class="form-control"  name="religion">
            <option value="Hinduism">Hinduism</option>
            <option value="Christianity">Christianity</option>
            <option value="Islam">Islam</option>
            <option value="Buddhism">Buddhism</option>
            <option value="Jainism">Jainism</option>
            <option value="Sikhism">Sikhism</option>
            <option value="Zoroastrianism">Zoroastrianism</option>
            <option value="Other">Other</option>
          </select>
        </div>
      </div>

      <div class="col-6">
        <div class="form-group">
          <label for="name">Cast</label>
          <select required="" id="cast" class="form-control"  name="cast">
            <option value="General">General</option>
            <option value="SC">SC</option>
            <option value="ST">ST</option>
            <option value="OBC-A">OBC-A</option>
            <option value="OBC-B">OBC-B</option>
          </select>
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
          <option value="Playhouse">Playhouse</option>
          <option value="Std 1">Std 1</option>
          <option value="Std 2">Std 2</option>
          <option value="Std 3">Std 3</option>
          <option value="Std 4">Std 4</option>
          <option value="Std 5">Std 5</option>
          <option value="Std 6">Std 6</option>
          <option value="Std 7">Std 7</option>
          <option value="Std 8">Std 8</option>
          <option value="Std 9">Std 9</option>
        </select>
      </div>
      <div class="col-3">
        <div class="form-group">
          <input type="number" class="form-control" name="year" id="year"  placeholder="Year">
        </div>
      </div>
      <div class="col-3">
        <select class="form-control" name="board" id="board">
          <option value="WBBSE">WBBSE</option>
          <option value="CBSE">CBSE</option>
          <option value="ICSE">ICSE</option>
          <option value="Other">Other</option>
        </select>
      </div>
      <div class="col-3">
        <input type="number" class="form-control" name="marks" id="marks"  placeholder="% Of Mark">
      </div>
    </div>

    <div class="row mt-2">
      <div class="col-3">
        <p>10th Standard</p>
      </div>
      <div class="col-3">
        <div class="form-group">
          <input type="number" class="form-control" name="10th_year" id="10th_year"  placeholder="Year">
        </div>
      </div>
      <div class="col-3">
        <select class="form-control" name="10th_board" id="10th_board">
          <option value="WBBSE">WBBSE</option>
          <option value="CBSE">CBSE</option>
          <option value="ICSE">ICSE</option>
          <option value="Other">Other</option>
        </select>
      </div>
      <div class="col-3">
        <input type="number" class="form-control" name="10th_marks" id="10th_marks"  placeholder="% Of Mark">
      </div>
    </div>

    <div class="row mt-2">
      <div class="col-3">
        <p>12th Standard</p>
      </div>
      <div class="col-3">
        <div class="form-group">
          <input type="number" class="form-control" name="12th_year" id="12th_year"  placeholder="Year">
        </div>
      </div>
      <div class="col-3">
        <select class="form-control" name="12th_board" id="12th_board">
          <option value="WBCHSE">WBCHSE</option>
          <option value="CBSE">CBSE</option>
          <option value="ISC">ISC</option>
          <option value="Other">Other</option>
        </select>
      </div>
      <div class="col-3">
        <input type="number" class="form-control" name="12th_marks" id="12th_marks"  placeholder="% Of Mark">
      </div>
    </div>

    <div class="row mt-2">
      <div class="col-3">
        <p>Graduate</p>
      </div>
      <div class="col-3">
        <div class="form-group">
          <input type="number" class="form-control" name="g_year" id="g_year"  placeholder="Year">
        </div>
      </div>
      <div class="col-3">
        <select class="form-control" name="g_board" id="g_board">
          <option value="C.U">C. U.</option>
          <option value="J.U">J. U.</option>
          <option value="B.U">B. U.</option>
          <option value="R.B.U">R. B. U.</option>
          <option value="K.U">K. U.</option>
          <option value="V.U">V. U.</option>
          <option value="NSOU">NSOU</option>
          <option value="IGNOU">IGNOU</option>
          <option value="MAKAUT">MAKAUT</option>
          <option value="Other">Other</option>
        </select>
      </div>
      <div class="col-3">
        <input type="number" class="form-control" name="g_marks" id="g_marks"  placeholder="% Of Mark">
      </div>
    </div>

    <div class="row mt-2">
      <div class="col-3">
        <p>Post Graduate</p>
      </div>
      <div class="col-3">
        <div class="form-group">
          <input type="number" class="form-control" name="p_year" id="p_year"  placeholder="Year">
        </div>
      </div>
      <div class="col-3">
        <select class="form-control" name="p_board" id="p_board">
          <option value="C.U">C. U.</option>
          <option value="J.U">J. U.</option>
          <option value="B.U">B. U.</option>
          <option value="R.B.U">R. B. U.</option>
          <option value="K.U">K. U.</option>
          <option value="V.U">V. U.</option>
          <option value="NSOU">NSOU</option>
          <option value="IGNOU">IGNOU</option>
          <option value="MAKAUT">MAKAUT</option>
          <option value="Other">Other</option>
        </select>
      </div>
      <div class="col-3">
        <input type="number" class="form-control" name="p_marks" id="p_marks"  placeholder="% Of Mark">
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