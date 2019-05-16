<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $details
 * @property string $type
 * @property string $created_at
 * @property string $updated_at
 * @property GradeSpecification[] $gradeSpecifications
 */
class TechnicalSpecification extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['title', 'details', 'type'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gradeSpecifications()
    {
        return $this->hasMany(GradeSpecification::class, 'specification_id');
    }
}
