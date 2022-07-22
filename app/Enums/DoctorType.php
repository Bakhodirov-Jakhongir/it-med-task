<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class DoctorType extends Enum
{
    const Internist = 1; //Терапевт
    const Psychiatrist = 2; //Психиатр
    const Neurologist = 3;  //Невролог
    const GENERAL_DOCTOR = 0; // Врач общей практики
}
