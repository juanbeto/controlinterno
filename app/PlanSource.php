<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 */
class PlanSource extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'PLAN_SOURCE';

    /**
     * @var array
     */
    protected $fillable = ['name'];

}
