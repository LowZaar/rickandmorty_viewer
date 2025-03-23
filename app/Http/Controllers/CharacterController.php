<?php

namespace App\Http\Controllers;

use App\Enums\CharacterStatus;
use App\Http\Resources\CharacterLocationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Client\Pool;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Inertia\Inertia;


class CharacterController extends Controller
{
    public function index(Request $request)
    {
        try {

            $query = $request->validate([
                'page' => "nullable|numeric",
                'name' => "nullable|string",
                "status" => [
                    "nullable",
                    Rule::enum(CharacterStatus::class)
                ]
            ]);


            $apiRequest = Http::rickApi()->get("/character", $query);

            if (!$apiRequest->successful()) {
                throw new \Exception('Failed to get character index');
            }

            $requestData = $apiRequest->json();
            $characterList = collect($requestData['results']);


            $characterList = $characterList->map(function ($character, $index) {

                $character['url'] = route("character.profile", [
                    'id' => extractIdFromUrl($character['url'])
                ]);

                return $character;
            });

            $characters = new LengthAwarePaginator(
                $characterList,
                $requestData['info']['count'],
                20,
                $query['page'] ?? 1,
                [
                    'path' => 'characters',
                ]
            )->withQueryString();

            return Inertia::render('characters/index', [
                'characters' => $characters,
                'info' => $requestData['info']['count'],
                'filters' => $query
            ]);

        } catch (\Throwable $t) {
            Log::error($t);
            return redirect()->to('/');
        }
    }

    public function characterProfile(Request $request, string $id)
    {
        try {

            $request = Http::rickApi()->get("/character/$id");

            if (!$request->successful()) {
                throw new \Exception('Failed to get character profile');
            }

            $requestData = $request->json();

            $character = $requestData;

            $character['location'] = !empty($character['location']['url']) ?
                HTTP::get($character['location']['url'])->json() : $character['location'];


            $character['origin'] = !empty($character['origin']['url']) ?
                HTTP::get($character['origin']['url'])->json() : $character['origin'];

            $character['episode'] = count($character['episode']);


            return Inertia::render('characters/characterProfile', [
                'character' => $character
            ]);
        } catch (\Throwable $t) {
            Log::error($t->getMessage());

            return redirect()->to('/characters');
        }
    }

    public function characterSearch(Request $request)
    {
        $validated = $request->validate([
            'status',
            'name',
        ]);


    }
}
