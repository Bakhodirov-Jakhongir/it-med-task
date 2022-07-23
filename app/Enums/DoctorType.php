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
    const Internist = 'INTERNIST'; //Терапевт
    const Psychiatrist = 'PSYCHIATRIST'; //Психиатр
    const Neurologist = 'NEUROLOGIST';  //Невролог
    const GENERAL_DOCTOR = 'GENERAL_DOCTOR'; // Врач общей практики
}
