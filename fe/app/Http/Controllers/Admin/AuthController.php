<?php

namespace App\Http\Controllers\Admin;

// LIBRARY LOCAL
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// MODELS
use App\Models\User;

// Library Installer
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public $view = 'auth.';
    public $route = 'authentications.';
    public $title = 'Smart Building IKN - Auth';
    public $model;

    public function __construct(User $model)
    {
        $this->model = $model;
        View::share('view', $this->view);
        View::share('route', $this->route);
        View::share('title', $this->title);
    }

    /**
     * Display a listing of the resource.
     */
    public function login()
    {
        return view($this->view . 'login');
    }

    public function home()
    {
        return view($this->view . 'home');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function forgotPassword()
    {
        return view($this->view . 'forgot-password');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect()->route($this->route.'login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return view('dashboard.index');

        // $validator = Validator::make($request->all(), [
        //     'email' => 'required|email|exists:users,email',
        //     'password' => 'required'
        // ], [
        //     'email.exists' => 'The email address does not exist in our records.'
        // ]);

        // if ($validator->fails()) {
        //     $errors = $validator->errors();
        //     alert()->error('Validation Error', $errors->first())->persistent(true, false);
        //     return back();
        // }

        // $credentials = $request->only('email', 'password');
        // if (Auth::attempt($credentials)) {
        //     $user = User::where('email', $request->email)->first();
        //     $roleName = $user->role->name;
        //     if ($roleName === 'admin' || $roleName === 'checker') {
        //         return redirect()->route('dashboard');
        //     } else {
        //         alert()->error('Access Denied', 'You do not have permission to access this page.')->persistent(true, false);
        //         Auth::logout();
        //         return back();
        //     }
        // }

        // $errors = $validator->errors();
        // alert()->error('Validation Error', 'The email address does not exist in our records.')->persistent(true, false);
        // return back();
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
