<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Filters\QueryFilters;

class KindSport extends Model
{
    use SoftDeletes;

    //
    protected $fillable = [
        'name', 'description', 'branchsport_id'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

	/* Metode tambahan untuk model Branch Sport. */

	/**
     * Relation Method(s).
     *
     */

    public function branchSport()
    {
        return $this->belongsTo('App\BranchSport', 'branchsport_id');
    }

    public function typeSports()
    {
        return $this->hasMany('App\TypeSport', 'kindsport_id');
    }

    /**
     * Filtering Branch Sport Berdasarakan Request User
     * @param $query
     * @param QueryFilters $filters
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, QueryFilters $filters)
    {
        return $filters->apply($query);
    }

}
