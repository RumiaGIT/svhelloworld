<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContributionCategory extends Model
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
    protected $table = 'contribution_categories';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'alias',
        'user_category_alias',
    ];
}
