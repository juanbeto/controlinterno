<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_profile
 * @property int $id_roles
 * @property AdminProfile $adminProfile
 * @property AdminRole $adminRole
 */
class AdminProfileRole extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'ADMIN_PROFILE_ROLE';

    /**
     * @var array
     */
    protected $fillable = ['id_profile', 'id_roles'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function adminProfile()
    {
        return $this->belongsTo('App\AdminProfile', 'id_profile');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function adminRole()
    {
        return $this->belongsTo('App\AdminRole', 'id_roles');
    }
}
