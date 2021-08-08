<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;

class Institution extends Model
{

    use HasFactory;
     
    protected $table = 'public.accounts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_company', 'integrador', 'email', 'mobile', 'address1', 'address2', 'tenant', 'type', 'doc', 'cep', 'state', 'city', 'country',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
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
        'deleted_at', 'updated_at',
    ];

    public function status()
    {
        return $this->belongsTo('App\Models\Status', 'status_id');
    }
    public function AccountList()
    {
        return $this->belongsTo('App\Models\Users_Account', 'account_id');
    }
}
