<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable implements MustVerifyEmail
{
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function studentOrg()
    {
        return $this->belongsToMany(Organization::class, 'organization_user','user_id','organization_id')
            ->withPivot(['position'])
            ->withPivot(['role'])
            ->withTimestamps();
        // , 'organization_user','user_id','organization_id'
    }

    public function userFaculty()
    {
        return $this->hasOne(Faculty::class);
    }

    public function userStaff()
    {
        return $this->hasOne(Staff::class);
    }

    public function checkUserType($authUserType){

        $UserTypeArr = explode("|", $authUserType);

        foreach($UserTypeArr as $authUserType){
            if($this->user_type === $authUserType){
                return true;
            }
        }
        return false;
    }

    public function checkOrgRole($role, $orgId){
        $authOrgRole = $this->belongsToMany(Organization::class, 'organization_user','user_id','organization_id')->where('organization_id', '=', $orgId)
        ->pluck('role');

        if($authOrgRole->count() > 0){

            $roleArr = explode('|', $role);

            foreach($roleArr as $role){
                if($authOrgRole[0] === $role){
                    return true;
                }
            }
            return false;
        }
        return false;
    }

    public function checkRole($role){
        $authOrgRole = $this->belongsToMany(Organization::class, 'organization_user','user_id','organization_id')
        ->pluck('role');

        $roleArr = explode('|', $role);

        foreach($authOrgRole as $authRole){
            foreach($roleArr as $role){
                if($authRole === $role){
                    return true;
                }
            }
        }
        return false;
    }
    public function isOrgMember(){
        return $this->belongsToMany(Organization::class, 'organization_user','user_id','organization_id')->exists();
    }
}
