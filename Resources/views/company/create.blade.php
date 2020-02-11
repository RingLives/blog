@extends(config('role.admin_tmp'),[
	'title' => 'AdminLTE 3 | Company Create Page',
	'content_header' => 'Company Create Page',
	'breadcrumb' => [
			'items' => [
						"<a href='".Url('admin/')."'>Home</a>",
						"<a href='".Route('company_index')."'>Companies</a>"
					],
			'active' => "Company Create Page",
		],
	])
@section('content')
	<div class="container-fluid">
	 	<div class="row">
	 		<div class="col-md-3"></div>
			<div class="col-md-6">
			  <div class="card card-primary">
			    <form role="form" action="{{Route('company_create_store')}}" method="post">
			    	@csrf
			      <div class="card-body">
			        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
			          	<label for="name">Company Name</label>
			          	<input type="text" class="form-control" name="name" id="name" placeholder="Company name" value="{{old('name')}}">
	                  	@if($errors->has('name'))
	                    	<span class="help-block">
		          	            <strong>
		          	            	{{ $errors->first('name') }}
		          	            </strong>
	                    	</span>
	                  	@endif
			        </div>
			        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
			          	<label for="description">Description</label>
			          	<textarea type="text" class="form-control" name="description" id="description" placeholder="Description">{{old('description')}}</textarea>
			          	@if($errors->has('description'))
	                    	<span class="help-block">
		          	            <strong>
		          	            	{{ $errors->first('description') }}
		          	            </strong>
	                    	</span>
	                  	@endif
			        </div>
			        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
			          	<label for="address">Address</label>
			          	<input type="text" class="form-control" name="address" id="address" placeholder="Address" value="{{old('address')}}">
			          	@if($errors->has('address'))
	                    	<span class="help-block">
		          	            <strong>
		          	            	{{ $errors->first('address') }}
		          	            </strong>
	                    	</span>
	                  	@endif
			        </div>
			        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
			          	<label for="phone">Phone</label>
			          	<input type="text" class="form-control" name="phone" id="phone" placeholder="Phone" value="{{old('phone')}}" maxlength="11">
			          	@if($errors->has('phone'))
	                    	<span class="help-block">
		          	            <strong>
		          	            	{{ $errors->first('phone') }}
		          	            </strong>
	                    	</span>
	                  	@endif
			        </div>
			        <div class="form-group">
			          <label for="is_active">Status</label>
			          <select name="is_active" class="form-control">
			          	<option value="1">Active</option>
			          	<option value="0">Inactive</option>
			          </select>
			        </div>
			      </div>
			      <div class="card-footer">
			        <button type="submit" class="btn btn-primary">{{__("Create")}}</button>
			      </div>
			    </form>
			  </div>
			</div>
		</div>
	</div>
@endsection
@section('script')	
@endsection