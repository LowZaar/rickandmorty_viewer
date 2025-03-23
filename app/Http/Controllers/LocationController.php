<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class LocationController extends Controller
{
    public function index(Request $request)
    {
        try {

            $query = $request->validate([
                'page' => 'nullable|numeric',
            ]);


            $apiRequest = Http::rickApi()->get("/location", $query);

            if (!$apiRequest->successful()) {
                throw new \Exception('Failed to get character index');
            }

            $requestData = $apiRequest->json();

            $locationList = collect($requestData['results']);

            dd($locationList);


            $locations = new LengthAwarePaginator(
                $locationList,
                $requestData['info']['count'],
                20,
                $query['page'] ?? 1,
                [
                    'path' => 'locations',
                ]
            )->withQueryString();


            return Inertia::render('locations/index', [
                'locations' => $locations,
                'info' => $requestData['info']['count'],

            ]);

        } catch (\Throwable $t) {
            Log::error($t);
            return redirect()->to('/');
        }
    }

    public function showLocation(Request $request)
    {
        dd(1);
    }

}
