<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $grade_id
 * @property int $specification_id
 * @property string $created_at
 * @property string $updated_at
 * @property Grade $grade
 * @property TechnicalSpecification $technicalSpecification
 */
class GradeSpecification extends Model
{
    /**
     * @var array
     */
    protected $fillable = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function technicalSpecification()
    {
        return $this->belongsTo(TechnicalSpecification::class, 'specification_id');
    }
}
