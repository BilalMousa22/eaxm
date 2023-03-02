<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CompnyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $compnies = Company::orderBy('id', 'desc')->paginate(5);
        return response()->view('cms.compny.index',compact('compnies'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return response()->view('cms.compny.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $compnies = new Company();

        $compnies->email = $request->get('email');
        $compnies->passward = Hash::make($request->get('password'));



        $issave = $compnies->save();


        if ($issave) {
            $users = new User();


            $users->name = $request->get('name_compny');


            $users->status = $request->get('status');
            $users->dirction = $request->get('dirction');
            $users->actor()->associate($compnies);


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
        $compnies = Company::findOrFail($id); ;
        return response()->view('cms.compny.edita',compact('compnies'));
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
        $compnies = Company::findOrFail($id); ;

        $compnies->email = $request->get('email');
        $compnies->passward = Hash::make($request->get('password'));



        $issave = $compnies->save();


        if ($issave) {
            $users = new User();


            $users->name = $request->get('name_compny');


            $users->status = $request->get('status');
            $users->dirction = $request->get('dirction');
            $users->actor()->associate($compnies);


            $issave = $users->save();
            return ['redirect' => route('compnies.index')];

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
        $compny = Company::destroy($id);
        return response()->json(['icon' => 'success', 'title' => 'top'], 200);

    }
}
