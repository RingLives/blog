@extends(config('role.admin_tmp'),[
	'title' => 'AdminLTE 3 | Companies',
	'content_header' => 'Companies',
	'breadcrumb' => [
			'items' => "<a href='".Url('admin/')."'>Home</a>",
			'active' => "Companies",
		],
	])
@section('content')
  @include('role::messages.error')
  @include('role::messages.success')
	<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
        	<div class="row">
	        	<div class="col-md-10"></div>
	        	<div class="col-md-2">
	        		<div class="text-right">	        			
	        			<a href="{{Route('company_create')}}">Create</a>
	        		</div>
	        	</div>
        	</div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example2" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>#</th>
              <th>Company Name</th>
              <th>Description</th>
              <th>Address</th>
              <th>Phone</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            	@if(isset($details))
            		@php($i = 1)
            		@foreach($details as $key => $value)
            			<tr>
            			  <td>{{$i++}}</td>
            			  <td>{!! $value->name !!}</td>
                    <td>{!! $value->description !!}</td>
                    <td>{!! $value->address !!}</td>
                    <td>{!! $value->phone !!}</td>
            			  <td>{!! $value->is_active !!}</td>
            			  <td>
            			  	<a href="{{route('company_create_edit',$value->id_companies)}}" class="btn btn-success">{{__('edit')}}</a>

                      <a href="#" class="btn btn-danger"
                         onclick="event.preventDefault();
                                       document.getElementById('delete-form').submit();">
                          {{ __('Delete') }}
                      </a>

                      <form id="delete-form" action="{{route('company_distroy',$value->id_companies)}}" method="POST" style="display: none;">
                          @method('delete')
                      </form>

            			  </td>
            			</tr>
            		@endforeach
            	@endif
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
@endsection

@section('script')
	<script>
	  $(function () {
	    $('#example2').DataTable({
	      "paging": true,
	      "lengthChange": false,
	      "searching": false,
	      "ordering": true,
	      "info": true,
	      "autoWidth": false,
	    });
	  });
	</script>
@endsection