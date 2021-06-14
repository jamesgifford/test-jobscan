<?php

namespace App\Console\Commands;

use App\Models\Posting;
use App\Models\Skill;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImportPostings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:postings {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import job postings from .csv file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $fileName = $this->argument('file').'.csv';
        $filePath = storage_path('app/postings/'.$fileName);

        $this->info('Importing postings from ' . $fileName . '...');

        if (!file_exists($filePath)) {
            $this->error('Could not find postings file');
            return;
        }

        try {
            $fileHandle = fopen($filePath, 'r');
        }
        catch (\ErrorException $e) {
            $this->error('Could not open postings file');
            return;
        }

        while (($row = fgetcsv($fileHandle, 1000, ',')) !== false) {
            // Skip the row if it is improperly formatted
            if (! is_array($row) || count($row) !== 4) {
                continue;
            }

            list($posting_id, $title, $company, $skills) = $row;

            // Ignore the header row
            if (! (int)$posting_id) {
                continue;
            }

            $slug = urlencode(strtolower($company . '-' . $title));

            $posting = Posting::updateOrCreate(
                ['external_id' => $posting_id],
                ['title' => $title, 'company' => $company, 'slug' => $slug]
            );

            foreach (explode(',', $skills) as $skill) {
                $skill = strtolower($skill);
                $slug = urlencode($skill);

                $skill = Skill::updateOrCreate(
                    ['name' => $skill],
                    ['slug' => $slug]
                );

                $skill->postings()->syncWithoutDetaching([$posting['id']]);
            }
        }

        fclose($fileHandle);

        $this->info('done!');

        return 0;
    }
}
