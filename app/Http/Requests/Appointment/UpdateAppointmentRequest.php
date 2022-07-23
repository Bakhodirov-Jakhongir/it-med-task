<?php

namespace App\Http\Requests\Appointment;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAppointmentRequest extends FormRequest
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
            'doctor_id' => 'exists:doctors,id',
            'patient_id' => 'exists:patients,id',
            'institution_id' => 'exists:institutions,id',
            'title' => 'string|min:3|max:255',
            'description' => 'string|min:3|max:255'
        ];
    }
}
