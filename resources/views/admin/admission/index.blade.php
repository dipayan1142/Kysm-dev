@php ($headerOption = [
'title' => $module,
'header_buttons' => [
($permission['create'] ? '<a class="btn btn-primary waves-effect" href="'. route($routePrefix . '.create') .'" data-toggle="tooltip" data-original-title="Add New Record">'. \Config::get('settings.icon_add') .' <span>Add New</span></a>' : '')
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
        <th>Name & Date</th>
        <th>Contact No</th>
        <th>Other</th>
        <th>Status</th>
        <th>Created At</th>
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
          <div>
          <span style="display: block ruby;">Name: {{ $val->name }}</span>
          <span style="display: block ruby;">Father Name: {{ $val->f_name }}</span>
          <span style="display: block ruby;">Date of Birth: {{ $val->dob }}</span>
          <span style="display: block ruby;">Date of Admission: {{ $val->dob }}</span>
          
          </div>
        </td>

        <td>
          <div>
            <span style="display: block ruby;">Mobile: {{ $val->m_no }}</span>
            <span style="display: block ruby;">Whatsapp: {{ $val->l_no }}</span>
          </div>
        </td>
        <td>
          <div>
            <span style="display: block ruby;">Religion: {{ $val->religion }}</span>
            <span style="display: block ruby;">Cast: {{ $val->cast }}</span>
            <span style="display: block ruby;">Form Number: {{ $val->admission_form_number }}</span>
            <span style="display: block ruby;">Total Fees: {{ $val->total_fees }}</span>
            
            </div>
        </td>
       
        <td><span class="badge badge-pill badge-soft-{{ $val->statuses[$val->status]['badge'] }} font-size-12">{!! $val->statuses[$val->status]['name'] !!}</span></td>
        <td>{{ \App\Helpers\Helper::showDate($val->created_at) }}</td>
        @if($permission['edit'] || $permission['destroy'])
        <td class="text-right">
          @if($permission['edit'])
          <a href="{{ route($routePrefix . '.edit', $val->id) }}" class="btn btn-outline-light waves-effect" data-toggle="tooltip" title="" data-original-title="Edit">{!! \Config::get('settings.icon_edit') !!}</a>
          @endif
          <a href="{{ route('semester.show', $val->id) }}" class="btn btn-outline-light waves-effect" data-toggle="tooltip" title="" data-original-title="add Semister"><i class="fa fa-fw fa-bars"></i></a> 
          
          @if($permission['destroy'] )
            <a class="btn btn-outline-danger waves-effect" data-toggle="tooltip" title="" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="event.preventDefault();
                  document.getElementById('delete-form-{{$val->id}}').submit();" data-original-title="Delete">{!! \Config::get('settings.icon_delete') !!}</a>
            {!! Form::open([
              'method'  => 'DELETE',
              'route'   => [
                $routePrefix . '.destroy',
                $val->id
              ],
              'style' => 'display:inline',
              'id'    => 'delete-form-' . $val->id
            ]) !!}
            {!! Form::close() !!}
          @endif
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