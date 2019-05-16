<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $created_at
 * @property string $updated_at
 * @property CarGrade[] $carGrades
 */
class Car extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['title', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function carGrades()
    {
        return $this->hasMany(CarGrade::class);
    }
}
