<?php

namespace App\Http\Requests\Patient;

use App\Rules\PhoneValidation;
use Illuminate\Foundation\Http\FormRequest;

class CreatePatientRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'phone_number' => ['required', new PhoneValidation()],
            'address' => 'required'
        ];
    }
}
