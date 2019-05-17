<?php
/**
 * Created by PhpStorm.
 * User: manowartop
 * Date: 2019-05-16
 * Time: 20:22
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SendEmailRequest;
use App\Repositories\Car\CarRepository;
use App\Repositories\Grade\GradeRepository;
use App\Services\CarService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class ApiController
 * @package App\Http\Controllers\Api
 */
class ApiController extends Controller
{
    /**
     * @param Request $request
     * @param GradeRepository $gradeRepository
     * @return JsonResponse
     */
    public function getGrades(Request $request, GradeRepository $gradeRepository): JsonResponse
    {
        return response()->json($gradeRepository->getGrades($request->get('id', 0)));
    }

    /**
     * @param Request $request
     * @param CarRepository $carRepository
     * @return JsonResponse
     * @throws Exception
     * @throws \Throwable
     */
    public function getCarInfo(Request $request, CarRepository $carRepository): JsonResponse
    {
        return response()->json(view('blocks.car-info', [
            'carGrade' => $carRepository->getCarInfo(
                $request->get('car_id', 0),
                $request->get('grade_id', 0)
            )
        ])->render());
    }

    /**
     * @param SendEmailRequest $request
     * @param CarService $carService
     * @return JsonResponse
     * @throws Exception
     */
    public function sendEmail(SendEmailRequest $request, CarService $carService): JsonResponse
    {
        $carService->sendData($request->validated());
        return response()->json(null, 202);
    }
}
