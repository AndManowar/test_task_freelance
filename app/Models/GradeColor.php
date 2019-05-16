<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $grade_id
 * @property int $color_id
 * @property string $created_at
 * @property string $updated_at
 * @property Color $color
 * @property Grade $grade
 */
class GradeColor extends Model
{
    /**
     * @var array
     */
    protected $fillable = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
}
