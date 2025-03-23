<?php

namespace App\Enums;

enum CharacterStatus: string {
    case ALIVE = "Alive";
    case DEAD = "Dead";
    case unknown = "unknown";
}
