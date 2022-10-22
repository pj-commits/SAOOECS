<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

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

    // BELONGS TO
    public function studentOrg()
    {
        return $this->belongsToMany(Organization::class, 'organization_user','user_id','organization_id')
            ->withPivot(['position'])
            ->withPivot(['role'])
            ->withTimestamps();
        // , 'organization_user','user_id','organization_id'
    }

    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_user','user_id','role_id');
    }

    // HAS


    public function userStaff()
    {
        return $this->hasOne(Staff::class);
    }

    public function checkOrgUser()
    {
        return $this->hasMany(OrganizationUser::class);
    }

    // LOGICS
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

    public function checkPosition($position){
        $authOrgPosition = $this->belongsToMany(Organization::class, 'organization_user','user_id','organization_id')
        ->pluck('position');

        $positionArr = explode('|', $position);

        foreach($authOrgPosition as $authPosition){
            foreach($positionArr as $position){
                if($authPosition === $position){
                    return true;
                }
            }
        }
        return false;
    }

    public function isOrgMember(){
        return $this->belongsToMany(Organization::class, 'organization_user','user_id','organization_id')->exists();
    }

    public function isOrgAdviser($userId){
        return $this->belongsToMany(Organization::class, 'organization_user','user_id','organization_id')->where('user_id', $userId)->where('position', 'Adviser');
    }
    
}
