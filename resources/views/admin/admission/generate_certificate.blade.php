@php ($headerOption = [
'title' => 'Certificate Update',
// 'header_buttons' => [
// ($permission['create'] ? '<a class="btn btn-primary waves-effect" href="'. route($routePrefix . '.create') .'" data-toggle="tooltip" data-original-title="Add New Record">'. \Config::get('settings.icon_add') .' <span>Add New</span></a>' : '')
// ],
// 'filters' => isset($filters) ? $filters : [],
// 'data' => isset($data) ? $data : []
])
@extends('admin.layouts.layout', $headerOption)


@section('content')

 <div class="container">
  <form method="POST" action="{{ route('admission.download-certificate') }}" accept-charset="UTF-8" enctype="multipart/form-data">
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
            <select id="course_name" class="form-control"  name="course_name" disabled="disabled">
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
          </select>
        </div>
      </div>

      

      <div class="col-6">
        <div class="form-group">
          <label for="name">Marks</label>
          <input type="text"
            class="form-control" name="marks" id="marks" value="">
        </div>
      </div>

      <div class="col-6">
        <div class="form-group">
          <label for="name">Grade</label>
          <input type="text"
            class="form-control" name="grade" id="grade" value="">
        </div>
      </div>
    </div>

     
  
  

    <div class="card-footer">
      <button type="submit" class="btn btn-primary btn-lg waves-effect"><i class="mdi mdi-content-save"></i> <span>Generate PDF</span></button>
      <a href="http://127.0.0.1:8000/admin/admission/index" class="btn btn-info btn-lg waves-effect"><i class="mdi mdi-keyboard-backspace"></i> <span>Back</span></a>
                      
    </div>
  </form>
 </div>

@include('admin.components.pagination')

@endsection
<script src="{{ asset('administrator/admin-form-plugins/custom.js') }}"></script>