<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_roles
 * @property int $id_modules
 * @property AdminModule $adminModule
 * @property AdminRole $adminRole
 */
class AdminRolMod extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'ADMIN_ROL_MOD';

    /**
     * @var array
     */
    protected $fillable = ['id_roles', 'id_modules'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function adminModule()
    {
        return $this->belongsTo('App\AdminModule', 'id_modules');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function adminRole()
    {
        return $this->belongsTo('App\AdminRole', 'id_roles');
    }
}
