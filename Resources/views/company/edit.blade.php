@extends(config('role.admin_tmp'),[
	'title' => 'AdminLTE 3 | Company Edit Page',
	'content_header' => 'Company Edit Page',
	'breadcrumb' => [
			'items' => [
						"<a href='".Url('admin/')."'>Home</a>",
						"<a href='".Route('company_index')."'>Companies</a>"
					],
			'active' => "Company Edit Page",
		],
	])
@section('content')
	<div class="container-fluid">
		@include('role::messages.error')
		@include('role::messages.success')
	 	<div class="row">
	 		<div class="col-md-3"></div>
			<div class="col-md-6">
			  <div class="card card-primary">
			    <form role="form" action="{{Route('company_create_update',$data->id_companies)}}" method="post">
			    	@csrf
			      <div class="card-body">
			        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
			          	<label for="name">Comapny Name</label>
			          	<input type="text" class="form-control" name="name" id="name" placeholder="Comapny name" value="{{$data->name ?? old('name')}}">
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
			          	<textarea type="text" class="form-control" name="description" id="description" placeholder="Description">{{$data->description ?? old('description')}}</textarea>
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
			          	<input type="text" class="form-control" name="address" id="address" placeholder="Address" value="{{$data->address ?? old('address')}}">
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
			          	<input type="text" class="form-control" name="phone" id="phone" placeholder="Phone" value="{{$data->phone ?? old('phone')}}" maxlength="11">
			          	@if($errors->has('phone'))
	                    	<span class="help-block">
		          	            <strong>
		          	            	{{ $errors->first('phone') }}
		          	            </strong>
	                    	</span>
	                  	@endif
			        </div>
			        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
			          <label for="is_active">Status</label>
			          <select name="is_active" class="form-control">
			          	<option value="1" {{$data->is_active == 1 ? 'selected' : ''}}>Active</option>
			          	<option value="0" {{$data->is_active == 0 ? 'selected' : ''}}>Inactive</option>
			          </select>
			        </div>
			      </div>
			      <div class="card-footer">
			        <button type="submit" class="btn btn-primary">{{__("Update")}}</button>
			      </div>
			    </form>
			  </div>
			</div>
		</div>
	</div>
@endsection
@section('script')	
@endsection