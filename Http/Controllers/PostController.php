<?php

namespace Sohidur\Blog\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;
use Sohidur\Blog\Http\Model\BlogCategory;
use Sohidur\Blog\Http\Model\BlogPost;
use Illuminate\Http\Request;

class PostController extends BaseController
{
	protected $model;

	protected $viewPath = "blog::post.";

	public function __construct(BlogPost $blogPost) {
		$this->model = $blogPost;
	}

	public function index() {
		return view($this->viewPath."index", [
			'details' => $this->model->list(),
		]);
	}

	public function create() {
		return view($this->viewPath."create", [
			'categories' => BlogCategory::getCategory(),
		]);
	}

	public function store(Request $request) {
		$this->validate($request, [
			'title' => 'required|unique:'.BlogPost::class,
		]);
		$request = $request->all();
		$this->model->fill($request);
		$this->model->save();

		if($request->ajax())
		{
			return response()->json($this->model);
		}
		
		return redirect()->route('post_index')->withSuccess("Successfuly created new post");
	}

	public function edit($id) {
		return view($this->viewPath."edit", [
			'data' => $this->model->findById($id),
			'categories' => BlogCategory::getCategory(),
		]);
	}

	public function update(Request $request, $id) {
		$this->validate($request, [
			'title' => 'required|unique:'.BlogPost::class.',title,'.$id.','.$this->model->getKeyName(),
		]);
		
		$request = $request->all();
		$request['is_active'] = $request['is_active'] ?? 'off';
		$request['disabled'] = $request['disabled'] ?? 'off';

		$findData = $this->model->findById($id);
		$findData->fill($request);
		$findData->update();

		return redirect()->route('post_index')->withSuccess("Successfuly updated post");
	}

	public function show($id) {}
	
	public function distroy($id) {
		$findData = $this->model->findById($id);
		$findData->delete();
		return redirect()->route('post_index')->withSuccess("Successfuly Deleted post.");
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

	public function disabled(Request $request, $id)
	{	
		$request = [];
		$findData = $this->model->find($id);
		$request['disabled'] = $findData->disabled ? 'off' : 'on';
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