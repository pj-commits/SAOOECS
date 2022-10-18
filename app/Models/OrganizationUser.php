<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class OrganizationUser extends Pivot
{
    //Pivot table organization_user
    protected $table = 'organization_user';
    protected $guarded = [];

    public function orgForm(){
        return $this->hasMany(Form::class, 'organization_user_id');
    }
    


}
