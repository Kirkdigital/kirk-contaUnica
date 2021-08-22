<?php
  
namespace App\Excel;

use App\Http\Controllers\FullCalenderController;
use App\Models\Balance;
use App\Models\Event;
use App\Models\Group;
use App\Models\Notes;
use App\Models\People;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\Config;

  
class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        Config::set('database.connections.tenant.schema', session()->get('conexao')); 
        return People::all();
        return Group::all();
        return Balance::all();
        return Event::all();
        return Notes::all();
    }
}