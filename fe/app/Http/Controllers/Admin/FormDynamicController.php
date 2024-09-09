<?php

namespace App\Http\Controllers\Admin;

// Libraries
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

// Library Installer
use RealRashid\SweetAlert\Facades\Alert;

// Models
use App\Models\Form;
use App\Models\FormGroup;
use App\Models\FormQuestions;
// ---------------------------
use App\Models\Element;
use App\Models\Formula;

// Datatable
use App\DataTables\FormDynamicDataTable;
use App\DataTables\FormGroupDataTable;
use App\DataTables\FormQuestionDataTable;

class FormDynamicController extends Controller
{
    public $view = 'form.';
    public $route = 'forms-dynamies.';
    public $title = 'Form Dynamic';
    public $subtitle = 'List Data Form Dynamic';
    public $model;

    public function __construct(Form $model)
    {
        View::share('route', $this->route);
        View::share('view', $this->view);
        View::share('title', $this->title);
        View::share('subtitle', $this->subtitle);
        $this->model = $model;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(FormDynamicDataTable $dataTable)
    {
        return $dataTable->render($this->view . 'index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view($this->view . 'create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:1|regex:/^(?=.*[A-Z]).*$/',
        ], [
            'password.regex' => 'Password minimal harus Huruf besar 1 karakter.'
        ]);

        $input = $request->all();

        $role = Role::where('name', 'checker')->first();
        // $role = 'admin';

        if (!$role) {
            Alert::error('Error', 'Role Checker tidak ditemukan.');
            return back();
        }

        $result = $this->model->create([
            'role_id' => $role->uuid,
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password'])
        ]);

        if ($result) {
            $result->assignRole($role->name);
            Alert::success('Created', 'Create ' . $this->title . ' Success');
            return redirect()->route($this->route . 'index');
        }
        Alert::error('Created', 'Create ' . $this->title . ' Failed');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->model->where('id', $id)->first();
        return view($this->view . 'detail', [
            'data' => $data,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = $this->model->where('id', $id)->first();
        return view($this->view . 'edit', [
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $input = $request->all();

        $result = $this->model->where('id', $id)->update([
            'name' => $input['name'],
            'email' => $input['email'],
        ]);

        if ($request->password) {
            $this->model->where('id', $id)->update([
                'password' => Hash::make($input['password'])
            ]);
        }

        if ($result) {
            Alert::success('Updated', 'Update ' . $this->title . ' Success');
            return redirect()->route($this->route . 'index');
        }
        Alert::error('Updated', 'Update ' . $this->title . ' Failed');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|exists:users,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Invalid ID'], 400);
        }
        $result = $this->model->where('id', $id)->forceDelete();
        if ($result) {
            return response()->json(['success' => true, 'message' => 'Successfully deleted ' . $this->title], 200);
        }
        return response()->json(['success' => false, 'message' => 'Failed to delete ' . $this->title], 500);
    }

    // FORM GROUP CONTROLLER
    public function indexGroup(FormGroupDataTable $dataTable, $form_id)
    {
        $dataTable->setData($form_id);
        return $dataTable->render($this->view . 'form-group.index');
    }

    public function showGroup(string $group_id)
    {
        $group = FormGroup::with('form')->where('id' , $group_id)->first();
        $forms = $this->model->with('category')->where('id' , $group->form_id)->first();
        $elements = Element::all();
        $formulas = Formula::where('category_id' , $forms->category->id)->get();
        return view($this->view . 'form-group.detail' , [
            'data' => $group,
            'elements' => $elements,
            'formulas' => $formulas
        ]);
    }

    public function createGroup(string $form_id)
    {
        $forms = $this->model->with('category')->where('id' , $form_id)->first();
        $elements = Element::all();
        $formulas = Formula::where('category_id' , $forms->category->id)->get();
        return view($this->view . 'form-group.create' , [
            'form_id' => $form_id,
            'forms' => $forms,
            'elements' => $elements,
            'formulas' => $formulas
        ]);
    }

    public function editGroup(string $group_id)
    {
        $group = FormGroup::with('form')->where('id' , $group_id)->first();
        $forms = $this->model->with('category')->where('id' , $group->form_id)->first();
        $elements = Element::all();
        $formulas = Formula::where('category_id' , $forms->category->id)->get();
        return view($this->view . 'form-group.edit' , [
            'data' => $group,
            'forms' => $forms,
            'elements' => $elements,
            'formulas' => $formulas
        ]);
    }

    public function storeGroup(Request $request, $form_id)
    {
        $request->validate([
            'title' => 'required|string',
            'element_id' => 'required',
            'formula_id' => 'required',
            'sequence' => 'required|numeric',
        ]);

        $input = $request->all();

        $result = FormGroup::create([
            'title' => $input['title'],
            'form_id' => $form_id,
            'element_id' => $input['element_id'],
            'formula_id' => $input['formula_id'],
            'sequence' => $input['sequence'],
        ]);

        if ($result) {
            Alert::success('Created', 'Create ' . 'Form Group' . ' Success');
            return redirect()->route($this->route . 'show' , $form_id);
        }
        Alert::error('Created', 'Create ' . 'Form Group' . ' Failed');
        return back();
    }

    public function updateGroup(Request $request, $group_id)
    {
        $request->validate([
            'title' => 'required|string',
            'element_id' => 'required',
            'formula_id' => 'required',
            'sequence' => 'required|numeric',
        ]);

        $input = $request->all();

        $result = FormGroup::where('id' , $group_id)->update([
            'title' => $input['title'],
            'element_id' => $input['element_id'],
            'formula_id' => $input['formula_id'],
            'sequence' => $input['sequence'],
        ]);

        $group = FormGroup::where('id' , $group_id)->first();

        if ($result) {
            Alert::success('Updated', 'Update ' . 'Form Group' . ' Success');
            return redirect()->route($this->route . 'show' , $group->form_id);
        }
        Alert::error('Updated', 'Update ' . 'Form Group' . ' Failed');
        return back();
    }

    public function destroyGroup(string $id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|exists:form_groups,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Invalid ID'], 400);
        }
        $result = FormGroup::where('id', $id)->forceDelete();
        if ($result) {
            return response()->json(['success' => true, 'message' => 'Successfully deleted ' . 'Form Group'], 200);
        }
        return response()->json(['success' => false, 'message' => 'Failed to delete ' . 'Form Group'], 500);
    }

    // FORM QUESTION CONTROLLER
    public function indexQuestion(FormQuestionDataTable $dataTable, $group_id)
    {
        $dataTable->setData($group_id);
        return $dataTable->render($this->view . 'form-question.index');
    }
}
