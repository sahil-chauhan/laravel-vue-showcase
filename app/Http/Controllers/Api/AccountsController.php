<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class AccountsController extends Controller
{
    public function get_all_accounts(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $accounts = $user->accounts;

        return response()->json(['accounts' => $accounts], 200);
    }
}
