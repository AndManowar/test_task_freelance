<?php
/**
 * Created by PhpStorm.
 * User: manowartop
 * Date: 2019-05-16
 * Time: 20:13
 */

namespace App\Http\Controllers;

use App\Repositories\Car\CarRepository;
use Illuminate\View\View;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * @var CarRepository
     */
    private $carRepository;

    /**
     * HomeController constructor.
     * @param CarRepository $carRepository
     */
    public function __construct(CarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view('main', [
            'carModels' => $this->carRepository->getCarsForSelect()
        ]);
    }
}
