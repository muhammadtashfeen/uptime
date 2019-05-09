<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DownTime extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'downtime';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
}
