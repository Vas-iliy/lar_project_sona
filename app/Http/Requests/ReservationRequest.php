<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'checkIn' => 'required',
            'checkOut' => 'required|different:checkIn',
            'guest' => 'required',
            'room' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|integer',
        ];
    }
}
