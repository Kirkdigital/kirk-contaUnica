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
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->pegar_tenant();
        $role = Roles::find($id);
        return view('settings.roles.show', array(
            'role' => $role
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
        $this->pegar_tenant();
        $role = Roles::find($id);
        return view('settings.roles.edit', array(
            'role' => $role
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
        $this->pegar_tenant();
        $role = Roles::find($id);
        $role->name       = $request->input('name');
        //pessoa
        $role->edit_people       = $request->has('edit_people')? 1 : 0;
        $role->view_people       = $request->has('view_people')? 1 : 0;
        $role->add_people       = $request->has('add_people')? 1 : 0;
        $role->delete_people       = $request->has('delete_people')? 1 : 0;
        //grupo
        $role->add_group       = $request->has('add_group')? 1 : 0;
        $role->edit_group       = $request->has('edit_group')? 1 : 0;
        $role->view_group       = $request->has('view_group')? 1 : 0;
        $role->delete_group       = $request->has('delete_group')? 1 : 0;
        //recado
        $role->add_message       = $request->has('add_message')? 1 : 0;
        $role->edit_message       = $request->has('edit_message')? 1 : 0;
        $role->view_message       = $request->has('view_message')? 1 : 0;
        $role->delete_message       = $request->has('delete_message')? 1 : 0;
        //financeiro
        $role->add_entrada_financial       = $request->has('add_entrada_financial')? 1 : 0;
        $role->add_retirada_financial       = $request->has('add_retirada_financial')? 1 : 0;
        $role->edit_financial       = $request->has('edit_financial')? 1 : 0;
        $role->view_financial       = $request->has('view_financial')? 1 : 0;
        $role->delete_financial       = $request->has('delete_financial')? 1 : 0;
        //calendar
        $role->add_calendar       = $request->has('add_calendar')? 1 : 0;
        $role->edit_calendar       = $request->has('edit_calendar')? 1 : 0;
        $role->view_calendar       = $request->has('view_calendar')? 1 : 0;
        $role->delete_calendar       = $request->has('delete_calendar')? 1 : 0;
        //settings
        $role->settings_general       = $request->has('settings_general')? 1 : 0;
        $role->settings_email       = $request->has('settings_email')? 1 : 0;
        $role->settings_meta       = $request->has('settings_meta')? 1 : 0;
        $role->settings_social       = $request->has('settings_social')? 1 : 0;
        $role->settings_roles       = $request->has('settings_roles')? 1 : 0;
        //dash
        $role->view_periodo       = $request->has('view_periodo')? 1 : 0;
        $role->view_dash       = $request->has('view_dash')? 1 : 0;
        $role->view_detail       = $request->has('view_detail')? 1 : 0;
        $role->view_resumo_financeiro       = $request->has('view_resumo_financeiro')? 1 : 0;
        $role->save();
        $request->session()->flash("success", "Successfully updated");
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
        $this->pegar_tenant();
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
