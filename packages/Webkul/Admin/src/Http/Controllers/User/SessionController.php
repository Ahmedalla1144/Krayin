<?php

namespace Webkul\Admin\Http\Controllers\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\User\Models\Role;

class SessionController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        if (auth()->guard('user')->check()) {
            return redirect()->route('admin.dashboard.index');
        } else {
            if (strpos(url()->previous(), 'admin') !== false) {
                $intendedUrl = url()->previous();
            } else {
                $intendedUrl = route('admin.dashboard.index');
            }

            session()->put('url.intended', $intendedUrl);

            return view('admin::sessions.login');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate(request(), [
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (!auth()->guard('user')->attempt(request(['email', 'password']), request('remember'))) {
            session()->flash('error', trans('admin::app.sessions.login.login-error'));

            return redirect()->back();
        }

        if (auth()->guard('user')->user()->status == 0) {
            session()->flash('warning', trans('admin::app.sessions.login.activate-warning'));

            auth()->guard('user')->logout();

            return redirect()->route('admin.session.create');
        }


        session()->flash('success', trans('admin::app.settings.users.login-success'));
        $user_role = auth()->user()->role_id;

        if ($user_role === 1) {
            return redirect()->intended(route('admin.dashboard.index'));
        } elseif ($user_role === 2) {
            return redirect()->intended(view('admin::dashboard.sales'));
        } elseif ($user_role === 3) {
            return redirect()->intended(view('admin::dashboard.customers'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        auth()->guard('user')->logout();

        return redirect()->route('admin.session.create');
    }

    public function register()
    {
        if (Auth()->check()) {
            return redirect()->route('admin.session.create');
        }
        return view('admin::sessions.regisitration');
    }

    public function registerStore()
    {
        $role = Role::find(1);
        if (!$role) {
            return response()->json(['error' => 'Invalid role'], 400);
        }
        $Data = request()->validate(['name' => 'required|min:3', 'email' => 'required|email|unique:users,email', 'password' => 'required|min:6', 'confirm_password' => 'required|same:password', 'role_id' => 'required']);

        $Data['view_permission'] = 'global';
        $Data['password'] = bcrypt($Data['password']);

        $user = User::create($Data);

        auth()->login($user);


        session()->flash('success', trans('admin::app.sessions.register.success'));
        return redirect()->route('admin.dashboard.index');
    }
}
