@extends(config('role.admin_tmp'),[
	'title' => 'AdminLTE 3 | Category Create Page',
	'content_header' => 'Category Create Page',
	'breadcrumb' => [
			'items' => [
						"<a href='".Url('admin/')."'>Home</a>",
						"<a href='".Route('category_index')."'>Categories</a>"
					],
			'active' => "Create",
		],
	])
@section('content')
	<div class="container-fluid">
	 	<div class="row">
	 		<div class="col-md-3"></div>
			<div class="col-md-6">
			  <div class="card card-primary">
			    <form role="form" action="{{Route('category_store')}}" method="post">
			    	@csrf
			      	<div class="card-body">
				        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
				          	<label for="title">Title</label>
				          	<input type="text" class="form-control" name="title" id="title" placeholder="Title">
				          	@if($errors->has('title'))
		                    	<span class="help-block">
			          	            <strong>
			          	            	{{ $errors->first('title') }}
			          	            </strong>
		                    	</span>
		                  	@endif
				        </div>
				        <div class="form-group{{ $errors->has('short_description') ? ' has-error' : '' }}">
				          	<label for="short_description">Short Description</label>
				          	<textarea class="form-control" name="short_description" id="short_description" placeholder="Short Description"></textarea>
				          	@if($errors->has('short_description'))
		                    	<span class="help-block">
			          	            <strong>
			          	            	{{ $errors->first('short_description') }}
			          	            </strong>
		                    	</span>
		                  	@endif
				        </div>
				        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
				          	<label for="description">Description</label>
				          	<textarea class="form-control" name="description" id="description" placeholder="Description"></textarea>
				          	@if($errors->has('description'))
		                    	<span class="help-block">
			          	            <strong>
			          	            	{{ $errors->first('description') }}
			          	            </strong>
		                    	</span>
		                  	@endif
				        </div>
				        <div class="form-group{{ $errors->has('is_active') ? ' has-error' : '' }}">
				          	<label for="is_active">Status : </label>
				          	<input 
				          		type="checkbox"
				          		checked
				          		data-toggle="toggle"
				          		data-on="On"
				          		data-off="Off"
				          		data-width="70"
				          		data-offstyle="{{config('blog.button.off')}}"
				          		data-onstyle="{{config('blog.button.on')}}"
				          		name="is_active"
				          		id="is_active"
				          	/>

				          	@if($errors->has('is_active'))
		                    	<span class="help-block">
			          	            <strong>
			          	            	{{ $errors->first('is_active') }}
			          	            </strong>
		                    	</span>
		                  	@endif
				        </div>
			      	</div>
			      	<div class="card-footer">
			        	<button type="submit" class="btn btn-{{config('blog.button.create')}}">{{__('Create')}}</button>
			      	</div>
			    </form>
			  </div>
			</div>
		</div>
	</div>
@endsection
@section('script')	
@endsection