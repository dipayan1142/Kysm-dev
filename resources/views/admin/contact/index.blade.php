@php ($headerOption = [
'title' => $module,
'header_buttons' => [

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
        <th>Contact Name </th>
        <th>Contact Email</th>
        <th>Subject</th>
        <th>Message</th>
        <th>Created At</th>
        @if( $permission['destroy'])
        <th width="15%" style="text-align: right;">Action</th>
        @endif
      </tr>
    </thead>
    <tbody>
      @if(count($data) != 0)
      @foreach ($data as $key => $val)
      
      <tr>
       
      <td> {{ $val->contact_name }}</td>
      <td>
        
          {{ $val->contact_email }}       

      </td>
        
        <td> {{ $val->subject }}</td>
        <td> {{ $val->message }}</td>
       
        <td>{{ \App\Helpers\Helper::showDate($val->created_at) }}</td>
        @if($permission['destroy'])
        <td class="text-right">
         
      
          
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