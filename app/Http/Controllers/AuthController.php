<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        DB::table('authentication')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'user_password' => bcrypt($request->user_password),
            'role' => $request->role,
        ]);

        return redirect()->route("response.show",[
            'status' => "success",
            'message' => "Registered successfully as $request->role",
            'code' => 201,
            'redirectUrl' => '/login'
        ]);
    }

    public function login(Request $request)
    {
        try{

            $user = DB::table('authentication')
            ->where('email', $request->email)
            ->where('role', $request->role)
            ->first();

            if ($user && password_verify($request->password, $user->user_password)) {
                session(['role' => $user->role, 'isLogin' => true, 'email' => $user->email, 'id' => $user->id]);

                return redirect()->route("response.show",[
                    'status' => "success",
                    'message' => "Logged in successfully.",
                    'code' => 201,
                    'redirectUrl' => '/'
                ]);
            }

            return redirect()->route("response.show",[
                'status' => "error",
                'message' => "Invalid Credentials.",
                'code' => 400,
                'redirectUrl' => '/login'
            ]);
        }
        catch(Excetion $E){
            return redirect()->route("response.show",[
                'status' => "error",
                'message' => "Error in login function.",
                'code' => 500,
                'redirectUrl' => '/login'
            ]);
        } 

    }

    public function adminLogin(Request $request)
    {
        try {

            $user = DB::table('authentication')
                ->where('email', $request->email)
                ->where('role', 'admin')
                ->first();

            if ($user && password_verify($request->password, $user->user_password)) {
                session(['role' => $user->role, 'isLogin' => true, 'email' => $user->email, 'id' => $user->id]);

                return redirect()->route("response.show",[
                    'status' => "success",
                    'message' => "Logged in successfullyy.",
                    'code' => 200,
                    'redirectUrl' => '/'
                ]);
            }

            return redirect()->route("response.show",[
                'status' => "error",
                'message' => "Invalid Credentials.",
                'code' => 401,
                'redirectUrl' => '/login'
            ]);
        } catch (Exception $E) {
            return redirect()->route("response.show",[
                'status' => "error",
                'message' => "Error in login function.",
                'code' => 500,
                'redirectUrl' => '/login'
            ]);
        }
    }
}
