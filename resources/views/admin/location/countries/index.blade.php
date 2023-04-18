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
       <th>Name {!! \App\Helpers\Helper::sort($routePrefix . '.index', 'country_name', $orderBy) !!}</th>
       <th>Code {!! \App\Helpers\Helper::sort($routePrefix . '.index', 'country_code', $orderBy) !!}</th>
       <th>Phone Code {!! \App\Helpers\Helper::sort($routePrefix . '.index', 'phone_code', $orderBy) !!}</th>
       <th>Status {!! \App\Helpers\Helper::sort($routePrefix . '.index', 'status', $orderBy) !!}</th>
       @if($permission['edit'] || $permission['destroy'] || $permisssionState['index'])
       <th width="15%" style="text-align: right;">Action</th>
       @endif
      </tr>
    </thead>
      <tbody>
      @if(count($data) != 0)
        @foreach ($data as $key => $val)
        <tr>
          <td>{{ $val->country_name }}</td>
          <td>{{ $val->country_code }}</td>
          <td>{{ $val->phone_code }}</td>
          <td><span class="badge badge-pill badge-soft-{{ $val->statuses[$val->status]['badge'] }} font-size-12">{!! $val->statuses[$val->status]['name'] !!}</span></td>
          @if($permission['edit'] || $permission['destroy'] || $permisssionState['index'])
          <td class="text-right">
            @if($permisssionState['index'])
            <a href="{{ route($routePrefix . '.states.index', $val->id) }}" class="btn btn-outline-light waves-effect" data-toggle="tooltip" title="View States" data-original-title="View States"><i class="bx bx-list-ul"></i></a>
            @endif
            @if($permission['edit'])
            <a href="{{ route($routePrefix . '.edit',$val->id) }}" class="btn btn-outline-light waves-effect" data-toggle="tooltip" title="" data-original-title="Edit">{!! \Config::get('settings.icon_edit') !!}</a>
            @endif
            @if($permission['destroy'])
           <a class="btn btn-outline-danger waves-effect" data-toggle="tooltip" title="" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="event.preventDefault();
              document.getElementById('delete-form-{{$val->id}}').submit();" data-original-title="Delete">{!! \Config::get('settings.icon_delete') !!}</a>
            {!! Form::open([
              'method' => 'DELETE',
              'route' => [
                $routePrefix . '.destroy',
                $val->id
                ],
              'id' => 'delete-form-'.$val->id
            ]) !!}
            {!! Form::close() !!}
            @endif
          </td>
          @endif
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

