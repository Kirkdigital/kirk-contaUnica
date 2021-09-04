<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Notes;
use App\Models\People;
use Illuminate\Support\Facades\Config;
use App\Models\Status;

class NotesController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->pegar_tenant();
        if ((session()->get('schema')) === null)
            return redirect()->route('account.index')->withErrors(['error' => __('events.select_account')]);

        $notes = Notes::with('user')->with('status')->paginate(20);
        return view('message.notesList',['notes' => $notes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //pegar schema
        $this->pegar_tenant();
        $statuses = Status::all();
        return view('message.create', ['statuses' => $statuses]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //pegar schema
        $this->pegar_tenant();
        $validatedData = $request->validate([
            'title'             => 'required|min:1|max:64',
            'content'           => 'required',
            'status_id'         => 'required',
            'applies_to_date'   => 'required|date_format:Y-m-d',
            'note_type'         => 'required'
        ]);
        $user = auth()->user();
        $note = new Notes();
        $note->title     = $request->input('title');
        $note->content   = $request->input('content');
        $note->status_id = $request->input('status_id');
        $note->note_type = $request->input('note_type');
        $note->applies_to_date = $request->input('applies_to_date');
        $note->users_id = $user->id;
        $note->save();
        $this->adicionar_log('3', 'C', $note);
        $request->session()->flash('message', 'Successfully created note');
        return redirect()->route('message.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //pegar schema
        $this->pegar_tenant();
        $note = Notes::with('user')->with('status')->find($id);
        return view('message.noteShow', ['note' => $note]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //pegar schema
        $this->pegar_tenant();
        $note = Notes::find($id);
        $statuses = Status::all();
        return view('message.edit', ['statuses' => $statuses, 'note' => $note]);
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
        //pegar schema
        $this->pegar_tenant();
        //die();
        $validatedData = $request->validate([
            'title'             => 'required|min:1|max:64',
            'content'           => 'required',
            'status_id'         => 'required',
            'applies_to_date'   => 'required|date_format:Y-m-d',
            'note_type'         => 'required'
        ]);
        $note = Notes::find($id);
        $note->title     = $request->input('title');
        $note->content   = $request->input('content');
        $note->status_id = $request->input('status_id');
        $note->note_type = $request->input('note_type');
        $note->applies_to_date = $request->input('applies_to_date');
        $note->save();
        $this->adicionar_log('3', 'U', $note);
        $request->session()->flash('message', 'Successfully edited note');
        return redirect()->route('message.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //pegar schema
        $this->pegar_tenant();
        $note = Notes::find($id);
        if ($note) {
            $note->delete();
        }
        $this->adicionar_log('3', 'D', $note);
        return redirect()->route('message.index');
    }
}
