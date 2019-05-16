<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $rgb
 * @property string $code
 * @property string $title
 * @property string $type
 * @property float $price
 * @property string $swatch
 * @property string $image
 * @property GradeColor[] $gradeColors
 */
class Color extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['rgb', 'code', 'title', 'type', 'price', 'swatch', 'image'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gradeColors()
    {
        return $this->hasMany(GradeColor::class);
    }
}
