@extends(config('blog.admin_tmp'),[
	'title' => 'AdminLTE 3 | Categories',
	'content_header' => 'Categories',
	'breadcrumb' => [
			'items' => "<a href='".Url('admin/')."'>Home</a>",
			'active' => "Categories",
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
	        			<a href="{{Route('category_create')}}">Create</a>
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
              <th>Title</th>
              <th>Description</th>
              <th>Status</th>
              <th>Manage</th>
            </tr>
            </thead>
            <tbody>
            	@if(isset($details))
            		@php($i = 1)
            		@foreach($details as $key => $value)
            			<tr>
            			  <td>{{$i++}}</td>
            			  <td>{!! $value->title !!}</td>
                    <td>{!! $value->description !!}</td>
            			  <td>{!! $value->is_active_html !!}</td>
            			  <td>
            			  	<a href="{{route('category_edit',$value->id)}}" class="btn btn-success">{{__('edit')}}</a>

                      <a href="#" class="btn btn-danger"
                         onclick="event.preventDefault();
                                       document.getElementById('delete-form-{{$key}}').submit();">
                          {{ __('Delete') }}
                      </a>

                      <form id="delete-form-{{$key}}" action="{{route('category_distroy',$value->id)}}" method="POST" style="display: none;">
                          @csrf
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

  <script>
    $('table tr td').on('change', 'input[type=checkbox]', function()
    {
      var method = $(this).data('method') ? $(this).data('method') : 'GET';
      var target = $(this).data('target');

      if(target == '')
      {
        console.log("Please set a data-target attribute.");
        return;
      }

      if('onchange' === $(this).data('action'))
      {
        $.ajax({
            type: method,
            url: target,
            datatype: 'json',
            cache: false,
            async: true,
            success: function(myObj)
            {
              if(myObj.flug)
              {
                location.reload();

              }else{}
            },
            error: function(data)
            {
              console.log(data);
            }
        });
      }
    })
  </script>
  {{-- <script type="text/javascript" src="{{ asset('assets/blog.js') }}"></script> --}}
@endsection