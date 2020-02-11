<?php

namespace Maxpro\Blog\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;
use Maxpro\Role\Http\Model\Company;
use Illuminate\Http\Request;

class CompanyController extends BaseController
{
	public function index() {
		return view("role::company.index", [
			'details' => Company::list(),
		]);
	}
	public function create() {
		return view("role::company.create");
	}
	public function store(Request $request) {
		$this->validate($request, [
			'name' => 'required|unique:'.Company::class,
		]);
		$findData = new Company();
		$findData->fill($request->all());
		$findData->save();
		return redirect()->route('company_index')->withSuccess("Successfuly created new Company");
	}
	public function edit($id) {
		return view("role::company.edit", [
			'data' => Company::findById($id),
		]);
	}
	public function update(Request $request, $id) {
		$this->validate($request, [
			'name' => 'required|unique:'.Company::class.',name,'.$id.','.(new Company())->getKeyName(),
		]);
		$findData = Company::findById($id);
		$findData->fill($request->all());
		$findData->update();
		return redirect()->route('company_index')->withSuccess("Successfuly updated new Company");
	}
	public function show($id) {}
	public function distroy($id) {
		$findData = Company::findById($id);
		$findData->delete();
		return redirect()->route('company_index')->withSuccess("Successfuly Deleted Company.");
	}
}