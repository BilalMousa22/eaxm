<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Company_branch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CompnyBranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $compnies = User::where('actor_type', 'App\Models\Company
        ')->orderBy('id', 'desc')->paginate(5);
        return response()->view('cms.compny-branch.index',compact('compnies'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $compnies = Company::orderBy('id', 'desc')->paginate(5);

        return response()->view('cms.compny-branch.create' ,compact('compnies'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Company_branch = new Company_branch();

        $Company_branch->email = $request->get('email');
        $Company_branch->passward = Hash::make($request->get('password'));
        $Company_branch->compny_id = $request->get('compny_id');



        $issave = $Company_branch->save();


        if ($issave) {
            $users = new User();


            $users->name = $request->get('name_compny');


            $users->status = $request->get('status');
            $users->dirction = $request->get('dirction');

            $users->actor()->associate($Company_branch);


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
        $Company_branch = Company_branch::findOrFail($id); ;
        return response()->view('cms.compny-branch.edita',compact('compny_branch'));
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
        $Company_branch = Company_branch::findOrFail($id); ;



        $Company_branch->email = $request->get('email');
        $Company_branch->passward = Hash::make($request->get('password'));



        $issave = $Company_branch->save();


        if ($issave) {
            $users = new User();


            $users->name = $request->get('name_compny');


            $users->status = $request->get('status');
            $users->dirction = $request->get('dirction');
            $users->compny_id = $request->get('compny_id');
            $users->actor()->associate($Company_branch);


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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $compny = Company_branch::destroy($id);
        return response()->json(['icon' => 'success', 'title' => 'top'], 200);

    }
}
