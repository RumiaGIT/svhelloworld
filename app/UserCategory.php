<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCategory extends Model
{
    /**
     * The primary key to use for this model.
     *
     * @var string
     */
    protected $primaryKey = 'alias';

    /**
     * Set whether the primary key is incrementing.
     *
     * @var bool
     */
    protected $incrementing = false;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    protected $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_categories';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'alias',
        'mailchimp_interest_id',
    ];
}
