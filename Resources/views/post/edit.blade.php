@extends(config('blog.admin_tmp'),[
	'title' => 'AdminLTE 3 | Post Edit Page',
	'content_header' => 'Post Edit Page',
	'breadcrumb' => [
			'items' => [
						"<a href='".Url('admin/')."'>Home</a>",
						"<a href='".Route('post_index')."'>Post</a>"
					],
			'active' => "Update",
		],
	])
@section('content')
	<div class="container-fluid">
	 	<div class="row">
	 		<div class="col-md-3"></div>
			<div class="col-md-6">
			  <div class="card card-primary">
			    <form role="form" action="{{Route('post_update',$data->id)}}" method="post">
			    	@csrf
			    	@method('put')
			      	<div class="card-body">
				        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
				          	<label for="title">{{__("blog::attribute.title")}}</label>
				          	<input type="text" class="form-control" name="title" id="title" placeholder="Title" value="{{old('title') ?? $data->title}}">
				          	@if($errors->has('title'))
		                    	<span class="help-block">
			          	            <strong>
			          	            	{{ $errors->first('title') }}
			          	            </strong>
		                    	</span>
		                  	@endif
				        </div>
				        <div class="form-group{{ $errors->has('short_description') ? ' has-error' : '' }}">
				          	<label for="short_description">{{__('blog::attribute.short_description')}}</label>
				          	<textarea class="form-control" name="short_description" id="short_description" placeholder="Short Description">{{old('short_description') ?? $data->short_description}}</textarea>
				          	@if($errors->has('short_description'))
		                    	<span class="help-block">
			          	            <strong>
			          	            	{{ $errors->first('short_description') }}
			          	            </strong>
		                    	</span>
		                  	@endif
				        </div>
				        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
				          	<label for="description">{{__('blog::attribute.description')}}</label>
				          	<textarea class="form-control" name="description" id="description" placeholder="Description">{{old('description') ?? $data->description}}</textarea>
				          	@if($errors->has('description'))
		                    	<span class="help-block">
			          	            <strong>
			          	            	{{ $errors->first('description') }}
			          	            </strong>
		                    	</span>
		                  	@endif
				        </div>
				        <div class="form-group{{ $errors->has('blog_category_id') ? ' has-error' : '' }}">
				          	<label for="blog_category_id">{{__('blog::attribute.blog_category_id')}}</label>

				          	<div class="row">
				          		<div class="col-md-8">
						          	<select name="blog_category_id" class="form-control" id="blog_category_id">
							          	<option value="">--Select--</option>
							          	@if(isset($categories) && count($categories) > 0)
							          		@foreach($categories as $category)
							          			<option 
							          				value="{{$category->id ?? ''}}"
							          				{{($data->blog_category_id == $category->id) ? 'selected' : ''}}
							          				>
							          				{{$category->title ?? ''}}
							          			</option>
							          		@endforeach
							          	@endif
						          	</select>
						          	@if($errors->has('blog_category_id'))
				                    	<span class="help-block">
					          	            <strong>
					          	            	{{ $errors->first('blog_category_id') }}
					          	            </strong>
				                    	</span>
				                  	@endif
				                </div>

				                <div class="col-md-4">
		                  			<button type="button" class="form-control btn btn-{{config('blog.button.info')}}" data-toggle="modal" data-target="#modal-default">
				                	  {{__("blog::resource.button.new")}}
				                	</button>
		                  		</div>
		                  	</div>
				        </div>
				        <div class="form-group{{ $errors->has('publish_on') ? ' has-error' : '' }}">
				          	<label for="publish_on">{{__('blog::attribute.publish_on')}}</label>
				          	<input type="date" class="form-control select2" name="publish_on" id="publish_on" value="{{$data->publish_on}}">
				          	@if($errors->has('publish_on'))
		                    	<span class="help-block">
			          	            <strong>
			          	            	{{ $errors->first('publish_on') }}
			          	            </strong>
		                    	</span>
		                  	@endif
				        </div>

				        <div class="form-group{{ $errors->has('disabled') ? ' has-error' : '' }}">
				          	<label for="is_active">{{__('blog::attribute.disabled')}} : </label>
				          	<input 
				          		type="checkbox" 
				          		{{ $data->disabled ? 'checked' : ''}}
				          		data-toggle="toggle" 
				          		data-on="On" 
				          		data-off="Off" 
				          		data-width="70" 
				          		data-offstyle="{{config('blog.button.off')}}"
				          		data-onstyle="{{config('blog.button.on')}}"
				          		name="disabled"
				          		id="disabled"
				          	/>

				          	@if($errors->has('disabled'))
		                    	<span class="help-block">
			          	            <strong>
			          	            	{{ $errors->first('disabled') }}
			          	            </strong>
		                    	</span>
		                  	@endif
				        </div>
				        <div class="form-group{{ $errors->has('is_active') ? ' has-error' : '' }}">
				          	<label for="is_active">{{__('blog::attribute.is_active')}} : </label>
				          	<input 
				          		type="checkbox"
				          		{{ $data->is_active ? 'checked' : ''}}
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
				        	<button type="submit" class="btn btn-{{config('blog.button.update')}}">{{__('blog::resource.button.update')}}</button>
				      </div>
			    </form>
			  </div>
			</div>
		</div>
	</div>
	@include('blog::category.modal')
@endsection
@section('script')
@endsection