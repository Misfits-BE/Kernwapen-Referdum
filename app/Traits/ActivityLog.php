<?php

namespace App\Traits;

use Spatie\Activitylog\Models\Activity;

/**
 * Trait ActivityLog
 *
 */
trait ActivityLog
{
    /**
     * Schrijf een activiteits log naar de databank.
     *
     * @param  mixed  $model    Het eloquent database model waar de activiteit op gebeurd
     * @param  string $message  Het bericht dat gelogd moet worden.
     * @return void
     */
    public function addActivity($model, string $message): void
    {
        activity()
            ->performedOn($model)
            ->causedBy(auth()->user())
            ->log($message);
    }
}