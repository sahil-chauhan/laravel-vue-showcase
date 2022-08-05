<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\User;
use App\Models\UserAccessLevel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;
use App\Models\Account;
use App\Models\AccountUser;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::list_user_role_users();
        return view('Admin.users.index',['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $accounts = Account::get();
        $access_levels = UserAccessLevel::get();
        return view('Admin.users.create',['access_levels' => $access_levels, 'accounts' => $accounts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'access_level' => ['required','numeric'],
            'account' => ['required','numeric'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'access_level' => $request->access_level
        ]);

        AccountUser::addUserToAccount($user->id,$request->account,$request->access_level);

        return redirect()->back()->with('success','User created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('Admin.users.show',['user' => $user]);        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        $accounts = Account::get();
        $user_selected_account = $this->get_user_account($user);
        
        $response = Gate::inspect('view',$user);
        if( !$response->allowed() ) 
        { 
            abort('403',$response->message()); 
        }

        $access_levels = UserAccessLevel::get();

        return view('Admin.users.edit',[
            'access_levels' => $access_levels,
            'user' => $user,
            'accounts' => $accounts,
            'user_selected_account' => $user_selected_account,
        ]);
    }

    public function get_user_account($user)
    {
        if( $user->accounts )
        {
            return $user->accounts[0]->id ?? 0;
        }
        return 0;
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

        if( !$request->password )
        {
            unset($request['password']);
            unset($request['password_confirmation']);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255',Rule::unique('users')->ignore($user->id)],
            'password' => ['sometimes', 'string', 'min:8', 'confirmed'],
            'access_level' => ['required','numeric'],
            'account' => ['required','numeric']
        ]);

        
        $user->name = $request->name;
        $user->email = $request->email;
        if( $request->password )
        {
            $user->password = Hash::make($request->password);
        }
        $user->access_level = $request->access_level;
        $user->save();

        $this->update_user_account($user->id,$request->account,$request->access_level);

        return redirect()->back()->with('success','User updated successfully.');
    }

    public function update_user_account($user_id,$account_id,$access_level)
    {
        $account_user = AccountUser::where(['user_id' => $user_id ])->first();
        
        if( !$account_user )
        {
            AccountUser::addUserToAccount($user_id,$account_id,$access_level);
            return;
        }

        $account_user->account_id = $account_id;
        $account_user->user_id = $user_id;
        $account_user->access_level = $access_level;
        $account_user->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AccountUser::removeUserFromAccount($id);
        
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success','User deleted successfully.');
    }
}
