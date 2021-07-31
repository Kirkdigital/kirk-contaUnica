<?php
  
namespace App\Excel;
  
use App\Models\People;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
  
class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new People([
            'name'     => $row['name'],
            'email'    => $row['email'], 
            'mobile'    => $row['mobile'], 
            //'password' => Hash::make($row['password']),
        ]);
    }
}