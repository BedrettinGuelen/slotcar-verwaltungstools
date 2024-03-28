<?php

namespace App\Enums;

enum LightingTypes: string
{
    const string NO_LIGHT = 'kein Licht';
    const string CONTINUOUS_LIGHT = 'Dauerlicht';
    const string LIGHT_SWITCH = 'mit Lichtschalter';
    const string ONLY_HEADLIGHTS = 'nur Frontscheinwerfer';
    const string ONLY_BACKLIGHTING = 'nur Rückbeleutung';
}