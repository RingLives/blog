@extends(config('blog.admin_tmp'),[
	'title' => 'AdminLTE 3 | Posts',
	'content_header' => 'Posts',
	'breadcrumb' => [
			'items' => "<a href='".Url('admin/')."'>Home</a>",
			'active' => "Posts",
		],
	])
@section('content')
  @include('blog::messages.error')
  @include('blog::messages.success')
	<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
        	<div class="row">
	        	<div class="col-md-10">
            </div>
	        	<div class="col-md-2">
	        		<div class="text-right">	        			
	        			<a href="{{Route('post_create')}}">{{__("Create")}}</a>
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
              <th>{{__("blog::attribute.title")}}</th>
              <th>{{__("blog::attribute.blog_category_id")}}</th>
              <th>{{__("blog::attribute.disabled")}}</th>
              <th>{{__("blog::attribute.is_active")}}</th>
              <th>{{__("blog::attribute.publish_on")}}</th>
              <th>{{__("blog::attribute.manage")}}</th>
            </tr>
            </thead>
            <tbody>
            	@if(isset($details))
            		@php($i = 1)
            		@foreach($details as $key => $value)
            			<tr>
            			  <td>{{$i++}}</td>
            			  <td>{!! $value->title !!}</td>
                    <td>{!! $value->category->title ?? '' !!}</td>
                    <td>{!! $value->disabled_html !!}</td>
            			  <td>{!! $value->is_active_html !!}</td>
                    <td>{!! $value->publish_on !!}</td>
            			  <td>
            			  	<a href="{{route('post_edit',$value->id)}}" class="btn btn-{{config('blog.button.edit')}}">{{__("blog::resource.button.edit")}}</a>

                      <a href="#" class="btn btn-{{config('blog.button.delete')}}"
                         onclick="event.preventDefault();
                                       document.getElementById('delete-form-{{$key}}').submit();">
                          {{__("blog::resource.button.delete")}}
                      </a>

                      <form id="delete-form-{{$key}}" action="{{Route('post_distroy',$value->id)}}" method="POST" style="display: none;">
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
    $('table tr td').on('change', 'input[type=checkbox]', function(e)
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