<?php

namespace Sohidur\Blog\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;
use Sohidur\Blog\Http\Model\BlogCategory;
use Illuminate\Http\Request;
use Validator;

class CategoryController extends BaseController
{
	protected $model;

	protected $error;

	protected $viewPath = "blog::category.";

	public function __construct(BlogCategory $blogCategory) {
		$this->model = $blogCategory;
	}

	public function index() {
		return view($this->viewPath."index", [
			'details' => $this->model->list(),
		]);
	}

	public function create() {
		return view($this->viewPath."create");
	}

	public function store(Request $request) {
		// $this->validate($request, [
		// 	'title' => 'required|unique:'.BlogCategory::class,
		// ]);

		$validator = Validator::make($request->all(),[
			'title' => 'required|unique:'.BlogCategory::class,
		]);

		if($validator->fails())
        {
        	if($request->ajax())
        	{
        		return response()->json([
        			'flug' => false,
        			'msg' => 'Validation error',
        			'errors' => $validator->messages()
        		]);
        	}
            
            return redirect()->back()->withInput($request->input())->withErrors($validator->messages());
        }

		$this->model->fill($request->all());
		$this->model->save();

		if($request->previous_url) {
			return redirect($request->previous_url);
		}

		if($request->ajax())
		{
			return response()->json([
        			'flug' => true,
        			'msg' => 'Successfuly create',
        			'data' => $this->model
        		]);
		}

		return redirect()->route('category_index')->withSuccess("Successfuly created new Category");
	}

	public function edit($id) {
		return view($this->viewPath."edit", [
			'data' => $this->model->findById($id),
		]);
	}

	public function update(Request $request, $id) {
		$this->validate($request, [
			'title' => 'required|unique:'.BlogCategory::class.',title,'.$id.','.$this->model->getKeyName(),
		]);
		$request = $request->all();
		$request['is_active'] = $request['is_active'] ?? 'off';
		$findData = $this->model->findById($id);
		$findData->fill($request);
		$findData->update();

		return redirect()->route('category_index')->withSuccess("Successfuly updated Category");
	}

	public function show($id) {}
	
	public function distroy($id) {
		$findData = $this->model->findById($id);
		$findData->delete();
		return redirect()->route('category_index')->withSuccess("Successfuly Deleted Category.");
	}

	public function active(Request $request, $id)
	{
		$request = [];
		$findData = $this->model->find($id);
		$request['is_active'] = $findData->is_active ? 'off' : 'on';
		$findData->fill($request);
		$findData->update();

		if(request()->ajax())
		{
			return response()->json([
				'flug' => true,
				'message' => "Successfuly status update",
				'data' => [],
			]);
		}

		return redirect()->back()->withSuccess('Successfuly status update');
	}
}