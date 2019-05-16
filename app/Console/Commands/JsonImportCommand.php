<?php

namespace App\Console\Commands;

use App\Models\Car;
use App\Models\CarGrade;
use App\Models\Color;
use App\Models\Feature;
use App\Models\Grade;
use App\Models\GradeColor;
use App\Models\GradeFeature;
use App\Models\GradeSpecification;
use App\Models\TechnicalSpecification;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

/**
 * Class JsonImportCommand
 * @package App\Console\Commands
 */
class JsonImportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'json:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data from json to db';

    /**
     * @var string
     */
    protected $fileUrl = 'http://toyota-credit.360d.ru/cars/Models/all.json';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     * @throws Exception
     */
    public function handle(): void
    {
        echo 'Parsing JSON data' . PHP_EOL;
        $this->insertData($this->parseJson());
        echo 'Parsed' . PHP_EOL;
    }

    /**
     * @return array
     * @throws Exception
     */
    protected function parseJson(): array
    {
        $jsonData = $this->getJsonDataAsArray();
        $cars = [];

        foreach ($jsonData as $carData) {
            $carData = reset($carData);
            $cars[$carData->title]['car_id'] = $this->getInsertedOrExistingEntityId(
                Car::class,
                'title',
                $carData->title,
                [
                    'title'      => $carData->title,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            );

            // Collecting Grades
            foreach ($carData->grades as $grade) {
                $cars[$carData->title]['grades'][$grade->id] = [
                    'car_id'   => $cars[$carData->title]['car_id'],
                    'grade_id' => $this->getInsertedOrExistingEntityId(
                        Grade::class,
                        'external_id',
                        $grade->id,
                        [
                            'title'           => $grade->title,
                            'external_id'     => $grade->id,
                            'engine_desc'     => $grade->engine_desc,
                            'wheeldrive'      => $grade->wheeldrive,
                            'price'           => (int)$grade->price,
                            'priced_discount' => (int)$grade->pricediscount,
                            'engine'          => $grade->engine,
                            'transmission'    => $grade->transmission,
                            'body'            => $grade->body,
                            'created_at'      => Carbon::now(),
                            'updated_at'      => Carbon::now()
                        ]
                    )
                ];

                // Collecting Features
                foreach ($grade->features as $feature) {
                    $featureId = $this->getInsertedOrExistingEntityId(
                        Feature::class,
                        'feature',
                        $feature,
                        [
                            'feature'    => $feature,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ]
                    );
                    $cars[$carData->title]['grades'][$grade->id]['features'][$featureId.$cars[$carData->title]['grades'][$grade->id]['grade_id']] = [
                        'grade_id'   => $cars[$carData->title]['grades'][$grade->id]['grade_id'],
                        'feature_id' => $featureId
                    ];
                }

                foreach ($grade->colors as $color) {
                    $cars[$carData->title]['grades'][$grade->id]['colors'][$color->id] = [
                        'grade_id' => $cars[$carData->title]['grades'][$grade->id]['grade_id'],
                        'color_id' => $this->getInsertedOrExistingEntityId(
                            Color::class,
                            'code',
                            $color->code,
                            [
                                'rgb'        => $color->rgb,
                                'code'       => $color->code,
                                'title'      => $color->title,
                                'type'       => $color->type,
                                'price'      => $color->price,
                                'swatch'     => $color->swatch,
                                'image'      => $color->image,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now()
                            ]
                        )
                    ];
                }

                foreach ($grade->technicalSpecification as $specification) {
                    $cars[$carData->title]['grades'][$grade->id]['specifications'][$specification->title] = [
                        'grade_id'         => $cars[$carData->title]['grades'][$grade->id]['grade_id'],
                        'specification_id' => $this->getInsertedOrExistingEntityId(
                            TechnicalSpecification::class,
                            'title',
                            $specification->title,
                            [
                                'title'      => $specification->title,
                                'details'    => $specification->details,
                                'type'       => $specification->type,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now()
                            ]
                        )
                    ];
                }
            }
        }

        return $cars;
    }

    /**
     * @param array $cars
     * @return void
     */
    protected function insertData(array $cars): void
    {
        foreach ($cars as $car) {
            foreach ($car['grades'] as $grade) {
                CarGrade::query()->insert(['car_id' => $grade['car_id'], 'grade_id' => $grade['grade_id']]);
                GradeFeature:: query()->insert($grade['features']);
                GradeColor::query()->insert($grade['colors']);
                GradeSpecification::query()->insert($grade['specifications']);
            }
        }
    }

    /**
     * @param string $model
     * @param array $data
     * @return void
     */
    protected function insertEntities(string $model, array $data): void
    {
        $model::query()->insert($data);
    }

    /**
     * @param string $model
     * @param string $fieldName
     * @param $value
     * @param array $dataToInsert
     * @return int
     */
    protected function getInsertedOrExistingEntityId(string $model, string $fieldName, $value, array $dataToInsert): int
    {
        $entity = $model::query()->select('id')->where($fieldName, $value)->get()->first();

        if (is_null($entity)) {
            return $model::query()->insertGetId($dataToInsert);
        }

        return $entity->id;
    }

    /**
     * @return array
     * @throws Exception
     */
    protected function getJsonDataAsArray(): array
    {
        $client = new Client();

        $response = $client->get($this->fileUrl);

        if ($response->getStatusCode() !== 200) {
            throw new Exception("Error while getting json");
        }

        return json_decode($response->getBody()->getContents());
    }
}
