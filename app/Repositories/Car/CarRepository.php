<?php
/**
 * Created by PhpStorm.
 * User: manowartop
 * Date: 2019-05-16
 * Time: 20:17
 */

namespace App\Repositories\Car;

use App\Models\Car;
use App\Models\CarGrade;
use Exception;

/**
 * Class CarRepository
 * @package App\Repositories\Car
 */
class CarRepository
{
    /**
     * @return array
     */
    public function getCarsForSelect(): array
    {
        return Car::query()->get()->all();
    }

    /**
     * @param int $carId
     * @param int $gradeId
     * @return CarGrade
     * @throws Exception
     */
    public function getCarInfo(int $carId, int $gradeId): CarGrade
    {
        // To be sure that grade is unique
        /** @var CarGrade $carGrade */
        $carGrade = CarGrade::query()->where([['car_id', $carId], ['grade_id', $gradeId]])->get()->first();

        if (!$carGrade) {
            throw new Exception("Car and grade not found");
        }

        return $carGrade;
    }
}
