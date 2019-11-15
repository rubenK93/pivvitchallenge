<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'offering_id',
        'customer_name',
        'quantity'
    ];

    protected $appends = [
        'total'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function offering()
    {
        return $this->belongsTo(Offering::class);
    }

    public function getTotalAttribute () {
        return $this->offering->price * $this->quantity;
    }
}
