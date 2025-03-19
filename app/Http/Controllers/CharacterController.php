<?php

namespace App\Http\Controllers;

use App\Enums\CharacterStatus;
use App\Jobs\AddCharacterToDatabase;
use App\Models\Character;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class CharacterController extends Controller
{
    public function index(Request $request) {
        try {
            $request = Http::rickApi()->get('/character/');
            if(!$request->successful()) {
                throw new \Exception('Failed to get character index');
            }

            $requestData = $request->json();
            dd($requestData);


        } catch (\Throwable $t) {
            Log::error($t->getMessage());
            return redirect()->to('/dashboard');
        }
    }

    public function characterProfile(Request $request, string $id) {
        try {
            $character = Character::where(['api_id' => $id])->first();

            if(!$character->exists()) {

                $request = Http::rickApi()->get("/character/$id");

                if(!$request->successfull()) {
                    throw new \Exception('Failed to get character profile');
                }

                $requestData = $request->json();

                AddCharacterToDatabase::dispatch($id, $requestData);

                $requestData['api_id'] = $requestData['id'];
                unset($requestData['id']);

                $character = $requestData;

            }

            return Inertia::render('characters.characterProfile', [
                    'character' => $character
            ]);

        } catch (\Throwable $t) {
            Log::error($t->getMessage());

            return redirect()->to('/characters');
        }
    }
}
