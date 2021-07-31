<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTenantRequest;
use App\Models\Institution;
use Hyn\Tenancy\Repositories\HostnameRepository;
use Hyn\Tenancy\Repositories\WebsiteRepository as HynWebsiteRepository;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class TenantController extends Controller
{
    public function store(Request $request){
        $tenant = Str::slug($request->tenant);

        $institutuin = new Institution();
        //$institutuin->uuid = $this->setLimitCharacters($tenant);
        app(Institution::class)->create( $institutuin );

        $user = auth()->user();

        $schema = Institution::create( [

            'name' => $request->name_company,
            'email' => $request->email,
            'doc' => $request->doc  , 
            'mobile' => $request->mobile  ,  
            'tenant' => $request->tenant, 
            'address1' => $request->address1  ,    
            'address2' => $request->address2,
            'city' =>  $request->city  ,     
            'state' =>  $request->state  ,
            'cep' => $request->cep    ,
            'status_id' => '5',
            'country' => $request->country   ,
            'integrador' => $user->id

        ] );
        $schema = app(Institution::class)->create( $schema );
        app(HostnameRepository::class)->attach( $schema, $institutuin );

        return response()->json( [ $this->runMigrations($institutuin), $schema ], 200);
    }


    public function runMigrations(Institution $website){
        $migrated = Artisan::call('tenancy:migrate', [
            '--website_id' => $website->id,
        ]);

        if( !$migrated ){ // return FALSE for sucess
            return 'Tenant criado com sucesso.';
        }
        return 'Erro ao rodar migrations.';
    }
}