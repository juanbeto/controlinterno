<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_user
 * @property int $id_profile
 * @property AdminProfile $adminProfile
 * @property AdminUser $adminUser
 */
class AdminUserProfile extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'ADMIN_USER_PROFILE';

    /**
     * @var array
     */
    protected $fillable = ['id_user', 'id_profile'];

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
    public function adminUser()
    {
        return $this->belongsTo('App\AdminUser', 'id_user');
    }
}
