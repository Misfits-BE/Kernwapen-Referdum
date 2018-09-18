<?php

namespace App\Http\Controllers\Backend\StadsMonitor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\City;
use Gate;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Backend\CityStatusValidator;
use App\Repositories\NotitionsRepository;
use Illuminate\Support\Facades\Hash;
/**
 * Class NukeFreeController
 * 
 * @author      Tim Joosten <Tim@activisme.be>
 * @copyright   2018 Tim Joosten, Activisme_BE
 * @package     App\Http\Controllers\Backend\StadsMonitor
 */
class NukeFreeController extends Controller
{
    /**
     * De variable voor de notitie repository
     *  
     * @var NotitionsRepository
     */
    protected $notitions;

    /**
     * NukeFreeController constructor 
     * 
     * @param  NotitionsRepository $notitions The repository class voor de notities
     * @return void
     */
    public function __construct(NotitionsRepository $notitions) 
    {
        $this->middleware(['auth', 'forbid-banned-user']);
        $this->notitions = $notitions;
    }

    /**
     * De functie voor het maken van een status update omtrent kernwapen vrij of niet. 
     * 
     * @param  City $city   De databank entiteit voor de gegeven stad. (findOrFail methode)
     * @param  bool $status De nieuwe status indicatie voor de gegeven stad.
     * @return View 
     */
    public function show(City $city, bool $status): View 
    {
        if (Gate::denies('kernwapen-vrij', $city)) {
            return view('backend.stadsmonitor.nuclear-free', compact('city'));
        }

        return view('backend.stadsmonitor.nuclear-not-free', compact('city'));
    }

    /**
     * Methode om een gemeente kernwapen vrij te verklaren. 
     * 
     * @param  CityStatusValidator  $input  De Form request class dat alle validatie regelt. 
     * @param  City                 $city   De databank entiteit van de gegeven stad. 
     * @return RedirectResponse
     */
    public function update(CityStatusValidator $input, City $city): RedirectResponse
    {
        if (Gate::denies('kernwapen-vrij', $city) && $city->update(['kernwapen_vrij' => true])) {
            $city->addMediaFromRequest('verklaring')->toMediaCollection('verklaringen');
            
            $this->notitions->notitionNuclearFree($city);
            flash()->info(trans('flash.city-monitor.nuclear-free-true', ['name' => $city->name]));
        } 

        return redirect()->route('admin.stadsmonitor.show', $city);
    }

    /**
     * Verwijder de kernwapen vrije status van een gemeente. 
     * 
     * @param  Requst   $reguest    De class that alle request information beschikbaar stelt.
     * @param  City     $city       De databank entiteit van de gegeven stad. 
     * @return RedirectResponse
     */
    public function destroy(Request $request, City $city): RedirectResponse 
    {
        $request->validate(['bevestiging' => 'required|string']);

        if (Gate::allows('kernwapen-vrij', $city) && Hash::check($request->bevestiging, auth()->user()->password)) {
            if ($city->update(['kernwapen_vrij' => false])) { // Het statuut is ingetrokken in de database. 
                $city->clearMediaCollection('verklaringen');  // All media will be deleted.

                $this->notitions->notitionNuclearNonFree($city);
                flash()->info('flash.city-monitor.nuclear-free-false', ['name' => $city->name]);
            }
        } else { // De gemeente is niet kernwapen vrij. 
            flash()->error('De gemeente zijn statuut als kernwapen vrije gemeente bestaat niet.');
        }

       return redirect()->route('admin.stadsmonitor.show', $city); 
    }
}
