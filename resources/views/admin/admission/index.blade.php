@php ($headerOption = [
'title' => $module,
'header_buttons' => [
($permission['create'] ? '<a class="btn btn-primary waves-effect" href="'. route($routePrefix . '.create') .'" data-toggle="tooltip" data-original-title="Add New Record">'. \Config::get('settings.icon_add') .' <span>Add Student</span></a>' : '')
],
'filters' => isset($filters) ? $filters : [],
'data' => isset($data) ? $data : []
])
@extends('admin.layouts.layout', $headerOption)


@section('content')

<div class="table-responsive">
  <table class="table table-condensed mh-200">
    <thead>
      <tr>
        <th>Name</th>
        <th>Phone No</th>
        <th>Reg No</th>
        <th>Course Code</th>
        <th>Registered</th>
        <th>Certificate</th>
        <th>Due Amount</th>
        <th>Status</th>
  
        @if($permission['edit'] || $permission['destroy'])
        <th width="15%" style="text-align: right;">Action</th>
        @endif
      </tr>
    </thead>
    <tbody>
      @if(count($data) != 0)
      @foreach ($data as $key => $val)
      
      <tr>
       
        <td> 
          <p><b>Name : </b> {{ $val->name }}</p>
          <p><b>Father Name : </b> {{ $val->f_name }}</p>
          <p><b>Date of Birth : </b> {{ $val->dob }}</p>
        </td>
        <td> {{ $val->m_no }} </td>
        <td> {{ $val->s_id }} </td>
        <td> {{ $val->course_name }} </td>
        <td> {{ ($val->is_registered=='Y') ? 'Y' : 'N' }} </td>
        <td> {{ ($val->is_certificate_generated=='Y') ? 'Y' : 'N'}} </td>
        <td>{!! \App\Helpers\Helper::get_due_amount($val->id) !!}</td>
       
        <td><span class="badge badge-pill badge-soft-{{ $val->statuses[$val->status]['badge'] }} font-size-12">{!! $val->statuses[$val->status]['name'] !!}</span></td>
       
        @if($permission['edit'] || $permission['destroy'])
        <td class="text-right">
          @if($permission['edit'])
          <a href="{{ route($routePrefix . '.edit', $val->id) }}" class="btn btn-outline-light waves-effect" data-toggle="tooltip" title="" data-original-title="Edit">{!! \Config::get('settings.icon_edit') !!}</a>
          @endif
          <a href="{{ route('admission.show', $val->id) }}" class="btn btn-outline-light waves-effect" data-toggle="tooltip" title="" data-original-title="View Admission"><i class="fa fa-fw fa-eye"></i></a>
          
          <a href="{{ route('payment_history.show', $val->id) }}" class="btn btn-outline-light waves-effect" data-toggle="tooltip" title="" data-original-title="payment Add"><i class="fa fa-fw fa-bars"></i></a> 
          <a href="{{ route('payment_history.show', $val->id) }}" class="btn btn-outline-light waves-effect" data-toggle="tooltip" title="" data-original-title="I-Card"><i class="fas fa-address-card "></i></a> 
          <a href="{{ route($routePrefix . '.generate-certificate', $val->id) }}" class="btn btn-outline-light waves-effect" data-toggle="tooltip" title="" data-original-title="Certificate"><i class="fas fa-certificate"></i></a> 
        </td>
        @endif
      </tr>
      @endforeach
      @else
      <tr>
        <td colspan="25">
          <div class="alert alert-danger">No Data</div>
        </td>
      </tr>
      @endif
    </tbody>
  </table>
</div>

@include('admin.components.pagination')

@endsection