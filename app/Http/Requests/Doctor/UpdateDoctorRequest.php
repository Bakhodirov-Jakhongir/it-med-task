<?php

namespace App\Http\Requests\Doctor;

use App\Enums\DoctorType;
use App\Rules\PhoneValidation;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDoctorRequest extends FormRequest
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
            'name' => 'string|min:3|max:255',
            'phone_number' => ['unique:doctors,phone_number,' . $this->doctor->id, new PhoneValidation()],
            'type' => new EnumValue(DoctorType::class),
            'experience' => 'numeric'
        ];
    }
}
