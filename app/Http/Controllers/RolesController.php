<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use App\Models\Menurole;
use App\Models\RoleHierarchy;
use App\Models\Roles;

class RolesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->pegar_tenant();
        $roles = Roles::all();
        return view('settings.roles.index', array(
            'roles' => $roles,
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->pegar_tenant();
        $settings = new Roles();
        $settings->delete_institution       = $request->has('delete_institution')? 1 : 0;
        $settings->delete_people       = $request->has('delete_people')? 1 : 0;
        $settings->delete_note       = $request->has('delete_note')? 1 : 0;
        $settings->delete_group       = $request->has('delete_group')? 1 : 0;
        $settings->delete_financial       = $request->has('delete_financial')? 1 : 0;
        $settings->delete_calendar       = $request->has('delete_calendar')? 1 : 0;
        $settings->view_periodo       = $request->has('view_periodo')? 1 : 0;
        $settings->view_dash       = $request->has('view_dash')? 1 : 0;
        $settings->view_detail       = $request->has('view_detail')? 1 : 0;
        $settings->view_resumo_financeiro       = $request->has('view_resumo_financeiro')? 1 : 0;
        $settings->add_people       = $request->has('add_people')? 1 : 0;
        $settings->add_institution       = $request->has('add_institution')? 1 : 0;
        $settings->edit_institution       = $request->has('edit_institution')? 1 : 0;
        $settings->add_group       = $request->has('add_group')? 1 : 0;
        $settings->edit_people       = $request->has('edit_people')? 1 : 0;
        $settings->user_id       = auth()->user()->id;
        $settings->save();
        $request->session()->flash("success", "Successfully updated");
        return redirect()->route('settings');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('settings.roles.show', array(
            'role' => Role::where('id', '=', $id)->first()
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('settings.roles.edit', array(
            'role' => Role::where('id', '=', $id)->first()
        ));
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
        $role = Role::where('id', '=', $id)->first();
        $role->name = $request->input('name');
        $role->save();
        $request->session()->flash('message', 'Successfully updated role');
        return redirect()->route('roles.edit', $id); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $role = Role::where('id', '=', $id)->first();
        $roleHierarchy = RoleHierarchy::where('role_id', '=', $id)->first();
        $menuRole = Menurole::where('role_name', '=', $role->name)->first();
        if(!empty($menuRole)){
            $request->session()->flash('message', "Can't delete. Role has assigned one or more menu elements.");
            $request->session()->flash('back', 'roles.index');
            return view('dashboard.shared.universal-info');
        }else{
            $role->delete();
            $roleHierarchy->delete();
            $request->session()->flash('message', "Successfully deleted role");
            $request->session()->flash('back', 'roles.index');
            return view('dashboard.shared.universal-info');
        }
    }
}
