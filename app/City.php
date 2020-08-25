<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ["province_id", "name", "type", "postal_code"];

    public function province() {
        return $this->belongsTo(Province::class);
    }
}
