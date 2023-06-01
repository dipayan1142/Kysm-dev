@php ($headerOption = [
  'title' => $module,
  'header_buttons' => [
    ($permission['create'] ? '<a class="btn btn-primary waves-effect" href="'. route($routePrefix . '.create') .'" data-toggle="tooltip" data-original-title="Add New Record">'. \Config::get('settings.icon_add') .' <span>Add New</span></a>' : '')
  ],
  'filters' => isset($filters) ? $filters : [],
  'data'    => isset($data) ? $data : []
])
@extends('admin.layouts.layout', $headerOption)


@section('content')
<div class="table-responsive">
 
  <table class="table table-condensed mh-200">
    <thead>
      <tr>
       <th>Center Id</th>
       <th>Note</th>
       <th>Amount {!! \App\Helpers\Helper::sort($routePrefix . '.index', 'amount', $orderBy) !!}</th>
       <th>Created At</th>
       @if($permission['edit'] || $permission['destroy'] || $permission['index'])
       <!-- <th width="15%" style="text-align: right;">Action</th> -->
       @endif
      </tr>
    </thead>
      <tbody>
      @if(count($data) != 0)
        @foreach ($data as $key => $val)
        <tr>
          <td>{{ $val->center_id }}</td>
          <td>{{ $val->note }}</td>
          <td>{{ $val->amount }}</td>
          <td>{{ \App\Helpers\Helper::showDate($val->created_at) }}</td>
         
        </tr>
         @endforeach
      @else
      <tr><td colspan="25"><div class="alert alert-danger">No Data</div></td></tr>
      @endif
    </tbody>
  </table>
</div>
@include('admin.components.pagination')
@endsection
