<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Config;

class FullCalenderController extends Controller
{
    /**
    * Write code on Method
    *
    * @return response()
    */
   public function index(Request $request)
   {
    $this->pegar_tenant();
    if ((session()->get('schema')) === null)
        return redirect()->route('account.index')->withErrors(['error' => __('events.select_account')]);
        
       $this->pegar_tenant();
       if($request->ajax()) {
      
            $data = Event::whereDate('start', '>=', $request->start)
                      ->whereDate('end',   '<=', $request->end)
                      ->get(['id', 'title', 'start', 'end']);
 
            return response()->json($data);
       }
 
       return view('dashboard.calender.fullcalender');
   }

   /**
    * Write code on Method
    *
    * @return response()
    */
   public function ajax(Request $request)
   {
    $this->pegar_tenant();
       switch ($request->type) {
          case 'add':
             $event = Event::create([
                 'title' => $request->title,
                 'start' => $request->start,
                 'end' => $request->end,
             ]);
             $this->adicionar_log('4', 'C', $event);
             return response()->json($event);
            break;
 
          case 'update':
             $event = Event::find($request->id)->update([
                 'title' => $request->title,
                 'start' => $request->start,
                 'end' => $request->end,
             ]);
             $this->adicionar_log('4', 'U', $event);
             return response()->json($event);
            break;
 
          case 'delete':
              $student = Event::where('id', $request->id)->get()->toJson();
             $event = Event::find($request->id)->delete();
             $this->adicionar_log('4', 'D', $student);
             return response()->json($event);
            break;
            
          default:
            # code...
            break;
       }
   }
}
