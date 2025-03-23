<?php

namespace App\Jobs;

use App\Models\Character;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Arr;

class AddCharacterToDatabase implements ShouldQueue
{
    use Queueable;

    protected mixed $characterData;

    /**
     * Create a new job instance.
     */
    public function __construct(mixed $characterData)
    {
        $this->characterData = $characterData;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // todo
        // Cache characters, locations etc.
        //

        $character = new Character();

        $character->fill(
            Arr::except(
                $this->characterData,
                ['origin', 'location', 'episode', 'status']
            )
        );

        $character->name = $this->characterData['name'];
        $character->status = strtolower($this->characterData['status']);
        $character->species = $this->characterData['species'];
    }
}
