<?php

namespace App\Traits;

use Illuminate\Pagination\Paginator;
use Spatie\Activitylog\Models\Activity;

/**
 * ActivityLog
 *
 * Trait voor het registreren van gebruikers activiteit in de back-end van de website.
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     \App\Traits
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

    /**
     * Haal alle gelogde activiteiten in het systeem uit de databank.
     *
     * @param  string   $type       Het type van de paginatie instantie.
     * @param  int      $perPage    Het aantal logs dat men wilt weergeven per pagina.
     * @return \Illuminate\Pagination\Paginator
     */
    public function getLogs(string $type, int $perPage): Paginator
    {
        $activity = Activity::with(['causer' => function ($query) {
            $query->withTrashed();
        }]);

        switch ($type) {
            case 'simple':  return $activity->simplePaginate($perPage);
            case 'default': return $activity->paginate($perPage);
            default:        return $activity->paginate($perPage);
        }
    }

    /**
     * Zoek een specifieke gebruikers log in de databank.
     *
     * @param  string   $term       De door de gebruiker gegeven term waarop gezocht word.
     * @param  string   $type       Het type van de paginatie instantie.
     * @param  int      $perPage    Het aantal logs dat men wilt weergeven per pagina.
     * @return \Illuminate\Pagination\Paginator
     */
    public function searchLogs(string $term, string $type, int $perPage): Paginator
    {
        $query = Activity::with(['causer' => function ($query) {
            $query->withTrashed();
        }])->where('description', 'LIKE', "%{$term}%");

        switch ($type) {
            case 'simple':  return $query->simplePaginate($perPage);
            case 'default': return $query->paginate($perPage);
            default:        return $query->paginate($perPage);
        }
    }
}
