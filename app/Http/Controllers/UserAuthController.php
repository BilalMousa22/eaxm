<?php

namespace App\Http\Controllers;

use App\Models\Admin;

use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use Spatie\Permission\Models\Role;

class UserAuthController extends Controller
{
    public function showLogin($guard){
        return response()->view('cms.auth.login' , compact('guard'));
    }

    public function login(Request $request){

        $validator = Validator($request->all() ,[
            'email' => 'required|email' ,
            'password' => 'required|string',
        ]);

        $credintials =[
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ] ;
        if(! $validator->fails()){
            if(Auth::guard($request->get('guard'))->attempt($credintials)){
                return response()->json(['icon' => 'success' , 'title' =>'Login is Succesfully' ] , 200);
            }
            else {
                return response()->json(['icon' => 'error' , 'title' =>'Login is Failed' ] , 400);

            }
        }
        else{
            return response()->json(['icon' => 'error' , 'title' =>$validator->getMessageBag()->first() ] , 400);
        }

    }

    public function logout(Request $request){
        $guard = auth('admin')->check() ? 'admin' : 'author';
        Auth::guard($guard)->logout();
        $request->session()->invalidate();
        return redirect()->route('view.login' , $guard);


    }

    public function editProfile1(Request $request){
        if (Auth::guard('admin')->id()){
            $admins = Admin::findOrFail(Auth::guard('admin')->id());
            $cities = City::all();
            return response()->view('cms.auth.edit' ,compact('admins' , 'cities'));

        }


    }

    public function UpdateProfile1(Request $request){

        if (Auth::guard('admin')->id()){

            $validator = Validator($request->all() , [
                'password' => 'nullable',
            ]);

            if(! $validator->fails()){
                $admins = Admin::findOrFail(Auth::guard('admin')->id());

                $admins->email = $request->get('email');
                $isSaved = $admins->save();

                if($isSaved){
                    $users = $admins->user;

                    if (request()->hasFile('image')) {

                        $image = $request->file('image');

                        $imageName = time() . 'image.' . $image->getClientOriginalExtension();

                        $image->move('storage/images/admin', $imageName);

                        $users->image = $imageName;
                        }

                    $users->first_name = $request->get('first_name');
                    $users->last_name = $request->get('last_name');
                    $users->status = $request->get('status');
                    $users->gender = $request->get('gender');
                    $users->date = $request->get('date');
                    $users->city_id = $request->get('city_id');
                    $users->address = $request->get('address');
                    $users->mobile = $request->get('mobile');
                    $users->actor()->associate($admins);

                    $isSaved = $users->save();

                    return ['redirect'=>route('admins.index')];

                }
            }
            else{
                return response()->json(['icon' => 'error' , 'title' => $validator->getMessageBag()->first()] ,400);
            }

        }

    }


    public function changePassword(Request $request){
        return response()->view('cms.admins.changePassword');
    }


    public function updatePassword(Request $request){

        $guard = auth('admin')->check() ? 'admin' : 'author';
        $validator = Validator($request->all() ,[
            'password' => 'required|string|current_password:' .$guard,
            'new_password' =>  'required|string|min:3|max:20|confirmed',
            'new_password_confirmation' => 'required|string|min:3|max:20',
        ]);

        if( !$validator->fails()){
            $user = auth($guard)->user();
            $user->password = Hash::make($request->get('new_password'));

            $isSaved = $user->save();

            return response()->json([
                'icon' => $isSaved ? 'success' : 'error',
                'title' => $isSaved ? "Change Password Successfully" : "Change Password is Failed",
            ] , $isSaved ? 200 : 400);
        }
        else{
            return response()->json([
                'icon' => 'error' ,
                'title' => $validator->getMessageBag()->first(),
            ],400);
        }

    }

    public function editProfile(Request $request){

        if (Auth::guard('admin')->id()){
            $admins = Admin::findOrFail(Auth::guard('admin')->id());
            $cities = City::all();
            return response()->view('cms.Auth.edit' ,compact('admins' , 'cities'));

        }

    }

    public function updateProfile(Request $request){
        $validator = Validator($request->all() , [
            'password' => 'nullable',
        ]);

        if(! $validator->fails()){
            $admins = Admin::findOrFail(Auth::guard('admin')->id());

            $admins->email = $request->get('email');
            $isSaved = $admins->save();

            if($isSaved){
                $users = $admins->user;
                // $roles = Role::findOrFail($request->get('role_id'));
                // $admins->assignRole($roles->name);

                if (request()->hasFile('image')) {

                    $image = $request->file('image');

                    $imageName = time() . 'image.' . $image->getClientOriginalExtension();

                    $image->move('storage/images/admin', $imageName);

                    $users->image = $imageName;
                    }

                $users->first_name = $request->get('first_name');
                $users->last_name = $request->get('last_name');
                $users->status = $request->get('status');
                $users->gender = $request->get('gender');
                $users->date_of_birth = $request->get('date');
                $users->city_id = $request->get('city_id');
                $users->address = $request->get('address');
                $users->mobile = $request->get('mobile');
                $users->actor()->associate($admins);

                $isSaved = $users->save();

                return ['redirect'=>route('admins.index')];

            }
        }
        else{
            return response()->json(['icon' => 'error' , 'title' => $validator->getMessageBag()->first()] ,400);
        }
    }
}
