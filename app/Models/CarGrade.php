<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $car_id
 * @property int $grade_id
 * @property string $created_at
 * @property string $updated_at
 * @property Car $car
 * @property Grade $grade
 */
class CarGrade extends Model
{
    /**
     * @var array
     */
    protected $fillable = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
}
