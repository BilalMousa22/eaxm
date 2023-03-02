<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $admins = Admin::orderBy('id', 'desc')->paginate(5);
        return response()->view('cms.admins.index',compact('admins'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $cities = City::all();
        return response()->view('cms.admins.create',compact('cities'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Admins = new Admin();

        $Admins->email = $request->get('email');
        $Admins->password = Hash::make($request->get('password'));



        $issave = $Admins->save();


        if ($issave) {
            $users = new User();

            if (request()->hasFile('image')) {

                $image = $request->file('image');

                $imageName = time() . 'image.' . $image->getClientOriginalExtension();

                $image->move('storage/images/admin', $imageName);

                $users->image = $imageName;
            }
            $users->first_name = $request->get('first_name');
            $users->last_name = $request->get('last_name');
            $users->mobile = $request->get('mobile');
            $users->address = $request->get('address');
            $users->date_of_birth = $request->get('date_of_birth');
            $users->status = $request->get('status');
            $users->city_id = $request->get('city_id');
            $users->actor()->associate($Admins);


            $issave = $users->save();

            if ($issave) {


                return response()->json(['icon' => 'success', 'title' => 'sucsse']);
            } else {

                return response()->json(['icon' => 'error', 'title' => 'error'], 400);
            }


        } else {

            return response()->json(['icon' => 'error', 'title' => 'error'], 400);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admins = Admin::findOrFail($id);
        $cities  = City::all();
        return response()->view('cms.admins.edita',compact('cities' ,'admins'));

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
        $Admins = Admin::findOrFail($id);

        $Admins->email = $request->get('email');



        $issave = $Admins->save();


        if ($issave) {
            $users = new User();

            if (request()->hasFile('image')) {

                $image = $request->file('image');

                $imageName = time() . 'image.' . $image->getClientOriginalExtension();

                $image->move('storage/images/admin', $imageName);

                $users->image = $imageName;
            }
            $users->first_name = $request->get('first_name');
            $users->last_name = $request->get('last_name');
            $users->mobile = $request->get('mobile');
            $users->address = $request->get('address');
            $users->date_of_birth = $request->get('date_of_birth');
            $users->status = $request->get('status');
            $users->city_id = $request->get('city_id');
            $users->actor()->associate($Admins);


            $issave = $users->save();

            return ['redirect' => route('admins.index')];


            if ($issave) {


                return response()->json(['icon' => 'success', 'title' => 'sucsse']);
            } else {

                return response()->json(['icon' => 'error', 'title' => 'error'], 400);
            }


        } else {

            return response()->json(['icon' => 'error', 'title' => 'error'], 400);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::destroy($id);
        return response()->json(['icon' => 'success', 'title' => 'top'], 200);

    }
}
