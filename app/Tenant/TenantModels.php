<?php

namespace App\Tenant;

use App\Models\Company;
use Illuminate\Database\Eloquent\Model;

trait TenantModels
{
    /**
     * inicia configurações do model
     */
    protected static function boot()
    {
        parent::boot();

        /**
         * adiciona scope global
         */
        static::addGlobalScope(new TenantScope());

        static::creating(function(Model $obj){
            $company = \Tenant::getTenant();
            if($company){
                $obj->company_id = $company->id;
            }
        });
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
