<?php

namespace App;

use App\User;
use App\Asset;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $guarded = [];

    /**
     * Group has many Assets.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assets()
    {
        return $this->belongsToMany(Asset::class);
    }

    /**
     * Group has many Users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
