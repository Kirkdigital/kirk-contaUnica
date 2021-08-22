<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;

class People extends Model
{

    use HasFactory;

    protected $connection = 'tenant';
    protected $table = 'people';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'mobile', 'birth_at', 'address', 'country', 'state', 'city', 'role', 'cep', 
        'is_verify', 'is_visitor', 'is_transferred',
        'is_responsible',
        'is_conversion',
        'is_baptism',
        'is_newvisitor',
        'note',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'is_active',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function status()
    {
        return $this->belongsTo('App\Models\Status', 'status_id');
    }
    
    public function historics()
    {
        return $this->hasMany(Historic::class);
    }
    
    public function getSender($sender)
    {
        return $this->where('name', 'LIKE', "%$sender%")
                    ->orWhere('email', $sender)
                    ->get()
                    ->first();    
    }   
    public function acesso()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function search(Array $data, $totalPagesPaginate)
    {
        return $this->where(function ($query) use ($data){
            if (isset($data['status']))
                $query->where('status', $data['status']);

            if (isset($data['name']))
                $query->where('name',  'LIKE','%' . $data['name']. '%');
       
        })
        ->paginate($totalPagesPaginate);
    }
}
