<?php

namespace App\Enums;

enum CharacterGender: string
{
    case MALE = "male";
    case FEMALE = "female";
    case GENDERLESS = "genderless";
    case UNKNOWN = "unknown";
}
