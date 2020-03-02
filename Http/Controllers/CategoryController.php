<?php

namespace Sohidur\Blog\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;
use Sohidur\Blog\Http\Model\BlogCategory;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
	protected $model;

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
		$this->validate($request, [
			'title' => 'required|unique:'.BlogCategory::class,
		]);

		$this->model->fill($request->all());
		$this->model->save();

		if($request->previous_url) {
			return redirect($request->previous_url);
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
}