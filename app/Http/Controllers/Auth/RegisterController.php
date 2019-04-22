<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Office;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Spatie\Permission\Models\Role;
use Illuminate\Auth\Events\Registered;
use Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    // use RedirectsUsers;

     /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $offices = Office::all();
        $roles = Role::all();
        $user_DT = User::withTrashed()->get();

        return  view('auth.register', compact('roles','offices', 'user_DT'));
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/register';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','role:Admin','permission:full control']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'wholename' => 'required|string|max:100',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|confirmed',
            'office' => 'required|numeric',
            'contacts' => 'required|numeric',
            'user_role' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \Augustus\User
     */
    protected function create(array $data)
    {
        return User::create([
            'wholename' => $data['wholename'],
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
            'office_id' => $data['office'],
            'contact_number' => $data['contacts'],
        ])->assignRole($data['user_role']);      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $offices = Office::all();
        $roles = Role::all();
        $user_DT = User::withTrashed()->get();
        $user_data = User::find($id);
        return view('auth.edituser', compact('offices', 'roles', 'user_DT', 'user_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $input = $request->except('user_role');

        $user->update([
            'wholename' => $input['wholename'],
            'office_id' => $input['office'],
            'contact_number' => $input['contacts'],
        ]);

        if ($request->user_role <> '') {
            $user->roles()->sync($request->user_role);        
        }        
        else {
            $user->roles()->detach(); 
        }

        return redirect()->route('register')->with('success','User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('register')->with('info','User has been deactivated.');

    }
    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        //
        $restore_user = User::withTrashed()->where('id', $id)->restore();
        return redirect()->route('register')->with('success','User has been reactivated.');
    }
}
