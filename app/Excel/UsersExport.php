<?php
  
namespace App\Excel;

use App\Models\People;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
  
class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return People::all();
    }
}