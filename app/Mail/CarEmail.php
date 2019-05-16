<?php

namespace App\Mail;

use App\Models\CarGrade;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class CarEmail
 * @package App\Mail
 */
class CarEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var CarGrade
     */
    private $carGrade;

    /**
     * Create a new message instance.
     *
     * @param CarGrade $carGrade
     */
    public function __construct(CarGrade $carGrade)
    {
        $this->carGrade = $carGrade;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('blocks.car-info', [
            'carGrade' => $this->carGrade
        ]);
    }
}
