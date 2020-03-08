<div class="modal fade" id="modal-default">
	<div class="modal-dialog">
	  	<div class="modal-content">
	  		<form role="form" action="{{Route('category_store')}}" method="post">
  		    	@csrf
			    <div class="modal-header">
			      	<h4 class="modal-title">New Category</h4>
			      	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			        	<span aria-hidden="true">&times;</span>
			      	</button>
			    </div>
			    <div class="modal-body">		  		    
			        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
			          	<label for="title">Title</label>
			          	<input type="text" class="form-control required" name="title" id="cat-title" placeholder="Title">
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
			          	<textarea class="form-control" name="short_description" id="cat-short_description" placeholder="Short Description"></textarea>
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
			          	<textarea class="form-control" name="description" id="cat-description" placeholder="Description"></textarea>
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
			          		id="cat-is_active"
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
			    <div class="modal-footer justify-content-between">
			      	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			      	<button 
			      		type="submit"
			      		class="btn btn-{{config('blog.button.save')}}" 
			      		data-action="validate"
			      		data-target="{{Route('category_create')}}"
			      		data-prefix="cat-">
			      		{{__('blog::resource.button.save')}}
			      	</button>
			    </div>
			</form>
	  	</div>
	</div>
</div>

<script type="text/javascript">

	$(document).ready(function(){
		var errors = [];
		$("form").on('click', 'button, input[type=submit]', function(event) {
			if('validate' === $(this).data('action'))
			{
				event.preventDefault();
				var target = $(this).data('target');
				var method = $(this).data('method') ? $(this).data('method') : 'POST';
				var prefix = $(this).data('prefix');

				$(this).closest("form").find('.help-block').remove();
				var form = $(this).closest("form").serialize();

				$.ajax({
				    type: method,
				    url: target,
				    data: form,
				    datatype: 'json',
				    cache: false,
				    async: false,
				    success: function(myObj)
				    {
				    	if(! myObj.flug)
				    	{
				    		for (attribute in myObj.errors) {
				    			var html = "<span class='help-block span_"+prefix+attribute+"'>";
				    			    html += "<strong>";
				    			    html += myObj.errors[attribute];
				    			    html += "</strong>";
				    			    html += "</span>";

				    			    errors.push(".span_"+prefix+attribute);
				    				$(".span_"+prefix+attribute).remove();
				    				$('#'+prefix+attribute).parent().append(html);
				    		}
				    	}else{
				    		for (error in errors)
				    		{
				    			$(errors[error]).remove();
				    			errors.splice(error);
				    		}
				    	}
				    },
				    error: function(data)
				    {
				        console.log(data);
				    }
				});

				if(typeof errors.length != 'undifined' && errors.length == 0)
				{
					location.reload();
				}
			}
		})
	});

	// var required = function () {
	// 	var count = 0;
	// 	var result = 0;
	// 	$('form .required').each(function() {
	// 		var _name = $(this).prop("name").split('[]').join("");
	// 		if(! $(this).val()) {
	// 			$(".span"+_name).remove();
	// 			var html = "<span class='help-block span"+_name+"'>";
	// 			    html += "<strong>";
	// 			    html += "The "+_name+" field is required.";
	// 			    html += "</strong>";
	// 			    html += "</span>";
	// 			$(this).parent().append(html);

	// 		}else{
	// 			$(this).parent().removeClass("has-error");
	// 	    	$(".span"+_name).remove();
	// 	    	result++
	// 		}

	// 		count++;
	// 	});
	// 	if(count == result) {
	// 		return true;
	// 	}else{
	// 		event.preventDefault();
	// 	}
	// }
</script>