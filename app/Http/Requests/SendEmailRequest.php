<?php
/**
 * Created by PhpStorm.
 * User: manowartop
 * Date: 2019-05-16
 * Time: 21:35
 */

namespace App\Http\Requests;

/**
 * Class SendEmailRequest
 * @package App\Http\Requests
 */
class SendEmailRequest extends Request
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'car_id'   => 'required|integer|exists:cars,id',
            'grade_id' => 'required|integer|exists:grades,id',
            'email'    => 'required|email'
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [

        ];
    }
}
