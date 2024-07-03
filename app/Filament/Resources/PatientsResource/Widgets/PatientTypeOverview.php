<?php

namespace App\Filament\Resources\PatientsResource\Widgets;

use App\Models\Patient;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PatientTypeOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Cats', Patient::query()->where('type', 'Cat')->count()),
            Stat::make('Dog', Patient::query()->where('type', 'Dog')->count()),
            Stat::make('Rabbit', Patient::query()->where('type', 'Rabbit')->count()),
        ];
    }
}
