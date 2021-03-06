<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Filters\QueryFilters;

class Schedule extends Model
{
    use SoftDeletes;

    //
    protected $fillable = [
        'code', 'datetime', 'description', 'typesport_id', 
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

	public function typeSport()
    {
        return $this->belongsTo('App\TypeSport', 'typesport_id');
    }

    public function scheduleDetails()
    {
        return $this->hasMany('App\scheduleDetail', 'schedule_id');
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
