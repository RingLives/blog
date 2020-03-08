<?php

namespace Sohidur\Blog\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;
use Sohidur\blog\Http\Model\BlogComment;
use Illuminate\Http\Request;

class CommentController extends BaseController
{
	protected $model;

	protected $viewPath = "blog::comment.";

	public function __construct(BlogComment $blogComment) {
		$this->model = $blogComment;
	}

	public function index() {

		// $entity->meta ?? null
		// locale()
		// optional()->translate()->meta_title ?? ''

		return view($this->viewPath."index", [
			'details' => $this->model->list(),
		]);
	}

	public function create() {
		return view($this->viewPath."create");
	}

	public function store(Request $request) {
		$this->validate($request, [
			'name' => 'required|unique:'.BlogComment::class,
		]);

		$this->model->fill($request->all());
		$this->model->save();

		return redirect()->route('company_index')->withSuccess("Successfuly created new Company");
	}

	public function edit($id) {
		return view($this->viewPath."edit", [
			'data' => $this->model->findById($id),
		]);
	}

	public function update(Request $request, $id) {
		$this->validate($request, [
			'name' => 'required|unique:'.BlogComment::class.',name,'.$id.','.$this->model->getKeyName(),
		]);
		$findData = $this->model->findById($id);
		$findData->fill($request->all());
		$findData->update();

		return redirect()->route('company_index')->withSuccess("Successfuly updated new Company");
	}

	public function show($id) {}
	
	public function distroy($id) {
		$findData = $this->model->findById($id);
		$findData->delete();
		return redirect()->route('company_index')->withSuccess("Successfuly Deleted Company.");
	}
}