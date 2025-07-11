<?php

namespace App\Http\Requests;

use App\Rules\DateBetween;
use App\Rules\TimeBetween;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UniqueReservationDate;

class ReservationStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email'],
            'res_date' => ['required', 'date', new UniqueReservationDate],
            'tel_number' => ['required'],
            'service_id' => ['required'],
            'cateringoption_id' => ['required'],
            'package_id' => ['required'],
            'guest_number' => ['required'],
        ];
    }
    
}
