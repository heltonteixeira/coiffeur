<?php

namespace App;

use App\Job;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->slug = str_slug($model->name);

            return true;
        });
    }

    protected $guarded = [];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function price($value = null)
    {
        return 'R$' . number_format($value, 2, ',', '.');
    }

    public function totalJobs()
    {
        return $this->jobs->count();
    }

    public function totalJobsLastMonth()
    {
        return $this->jobs()
            ->accomplished('last month')
            ->count();
    }

    public function totalJobsLastWeek()
    {
        return $this->jobs()
            ->accomplished('last week')
            ->count();
    }

    public function totalEarned()
    {
        return $this->jobs->sum('total_cost');
    }

    public function totalEarnedThisWeek()
    {
        return $this->jobs()->accomplished('this week')->sum('total_cost');
    }

    public function totalEarnedLastWeek()
    {
        return $this->jobs()->accomplished('last week')->sum('total_cost');
    }

    public function totalEarnedThisMonth()
    {
        return $this->jobs()->accomplished('this month')->sum('total_cost');
    }

    public function totalEarnedLastMonth()
    {
        return $this->jobs()->accomplished('last month')->sum('total_cost');
    }

    public function description()
    {
        return $this->description ?: '<em>No description.</em>';
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
