<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $grade_id
 * @property int $feature_id
 * @property string $created_at
 * @property string $updated_at
 * @property Feature $feature
 * @property Grade $grade
 */
class GradeFeature extends Model
{
    /**
     * @var array
     */
    protected $fillable = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function feature()
    {
        return $this->belongsTo(Feature::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
}
