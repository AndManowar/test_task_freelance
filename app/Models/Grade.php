<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $engine_desc
 * @property string $wheeldrive
 * @property float $price
 * @property float $pricedDiscount
 * @property string $engine
 * @property string $transmission
 * @property string $body
 * @property string $created_at
 * @property string $updated_at
 * @property CarGrade[] $carGrades
 * @property GradeColor[] $gradeColors
 * @property GradeFeature[] $gradeFeatures
 * @property GradeSpecification[] $gradeSpecifications
 */
class Grade extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['title', 'engine_desc', 'wheeldrive', 'price', 'pricedDiscount', 'engine', 'transmission', 'body', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function carGrades()
    {
        return $this->hasMany(CarGrade::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gradeColors()
    {
        return $this->hasMany(GradeColor::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gradeFeatures()
    {
        return $this->hasMany(GradeFeature::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gradeSpecifications()
    {
        return $this->hasMany(GradeSpecification::class);
    }
}
