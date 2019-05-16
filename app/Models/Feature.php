<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $feature
 * @property string $created_at
 * @property string $updated_at
 * @property GradeFeature[] $gradeFeatures
 */
class Feature extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['feature', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gradeFeatures()
    {
        return $this->hasMany(GradeFeature::class);
    }
}
