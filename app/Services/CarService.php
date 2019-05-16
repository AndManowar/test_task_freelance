<?php
/**
 * Created by PhpStorm.
 * User: manowartop
 * Date: 2019-05-16
 * Time: 21:36
 */

namespace App\Services;

use App\Mail\CarEmail;
use App\Repositories\Car\CarRepository;
use Illuminate\Support\Facades\Mail;

/**
 * Class CarService
 * @package App\Services
 */
class CarService
{
    /**
     * @var CarRepository
     */
    protected $carRepository;

    /**
     * CarService constructor.
     * @param CarRepository $carRepository
     */
    public function __construct(CarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    /**
     * @param array $data
     * @throws \Exception
     */
    public function sendData(array $data): void
    {
        Mail::to($data['email'])
            ->send(new CarEmail($this->carRepository->getCarInfo($data['car_id'], $data['grade_id'])));
    }
}
