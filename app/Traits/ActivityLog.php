<?php

namespace App\Traits;

use Spatie\Activitylog\Models\Activity;
use Illuminate\Pagination\Paginator;

/**
 * ActivityLog
 *
 * Trait voor het registreren van gebruikers activiteit in de back-end van de website.
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
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

    public function getLogs(string $type = 'default', int $perPage): Paginator 
    {
        switch ($type) {
            case 'simple':  return Activity::simplePaginate($perPage);
            case 'default': return Activity::paginate($perPage);
            default:        return Activity::paginate($perPage);   
        }
    }
}
