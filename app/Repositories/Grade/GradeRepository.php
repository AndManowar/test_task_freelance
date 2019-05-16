<?php
/**
 * Created by PhpStorm.
 * User: manowartop
 * Date: 2019-05-16
 * Time: 20:23
 */

namespace App\Repositories\Grade;

use App\Models\Grade;

/**
 * Class GradeRepository
 * @package App\Repositories\Grade
 */
class GradeRepository
{
    /**
     * @param int $carId
     * @return array
     */
    public function getGrades(int $carId): array
    {
        return Grade::query()
            ->join('car_grades', 'grade_id', '=', 'grades.id')
            ->where('car_id', $carId)
            ->get()
            ->all();
    }
}
