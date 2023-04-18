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
       <th>Title {!! \App\Helpers\Helper::sort($routePrefix . '.index', 'title', $orderBy) !!}</th>
       @if($permission['edit'] || $permission['destroy'] || $permission['manageRole'])
       <th width="20%" style="text-align: right;">Action</th>
       @endif
      </tr>
    </thead>
      <tbody>
      @if(count($data) != 0)
        @foreach ($data as $key => $value)
        <tr>
          <td>{{ $value->title }}</td>
          @if($permission['edit'] || $permission['destroy'] || $permission['manageRole'])
          <td class="text-right">
            @if($permission['manageRole'])
            <a href="{{ route('permissions.manage_role',$value->id) }}" class="btn btn-outline-light waves-effect" data-toggle="tooltip" title="" data-original-title="Manage permission for this Role"><i class="bx bx-cog"></i></a>
            @endif
            @if($permission['edit'] && $value['user_id'] == $userId)
            <a href="{{ route($routePrefix . '.edit',$value->id) }}" class="btn btn-outline-light waves-effect" data-toggle="tooltip" title="" data-original-title="Edit">{!! \Config::get('settings.icon_edit') !!}</a>
            @endif
            @if($permission['destroy'] && $value['user_id'] == $userId)
           <a class="btn btn-outline-danger waves-effect" data-toggle="tooltip" title="" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="event.preventDefault();
              document.getElementById('delete-form-{{$value->id}}').submit();" data-original-title="Delete">{!! \Config::get('settings.icon_delete') !!}</a>
            {!! Form::open([
              'method' => 'DELETE',
              'route' => [
                $routePrefix . '.destroy',
                $value->id
                ],
              'id' => 'delete-form-' . $value->id
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
  </table>
</div>
@include('admin.components.pagination')


@endsection

