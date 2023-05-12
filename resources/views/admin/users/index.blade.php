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
        <th colspan="2">Name {!! \App\Helpers\Helper::sort($routePrefix . '.index', 'first_name', $orderBy) !!}</th>
        <th>Email {!! \App\Helpers\Helper::sort($routePrefix . '.index', 'email', $orderBy) !!}</th>
        <th>Phone</th>
        <th>Role {!! \App\Helpers\Helper::sort($routePrefix . '.index', 'r__title', $orderBy) !!}</th>
        <th>User ID</th>
        <th>Center Incharge Name</th>

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
        <td width="10%"><img src="{{ $val->avatar['thumb'] }}" class="rounded-circle avatar-md" style="max-height: 70px;"></td>
        <td>
         @if($val->first_name)   
            {{ $val->first_name }} {{ $val->last_name }}
        @else
          {{ $val->center_name }}       
        @endif
         

      </td>
        <td> {{ $val->email }}</td>
        <td> {{ $val->phone }}</td>
        <td>{{ $val->role_title }}</td>
        <td> {{ $val->username }}</td>
        <td> {{ $val->center_incharge_name }}</td>
        <td><span class="badge badge-pill badge-soft-{{ $val->statuses[$val->status]['badge'] }} font-size-12">{!! $val->statuses[$val->status]['name'] !!}</span></td>
        <td>{{ \App\Helpers\Helper::showDate($val->created_at) }}</td>
        @if($permission['edit'] || $permission['destroy'])
        <td class="text-right">
          @if($permission['edit'])
          <a href="{{ route($routePrefix . '.edit', $val->id) }}" class="btn btn-outline-light waves-effect" data-toggle="tooltip" title="" data-original-title="Edit">{!! \Config::get('settings.icon_edit') !!}</a>
          @endif
          @if($permission['destroy'] && $val->id != auth()->user()->id)
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