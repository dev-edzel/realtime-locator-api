<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TruncateLocationTable extends Command
{
    protected $signature = 'fresh:location';

    protected $description = 'Clears all data from the location table.';

    public function handle()
    {
        DB::table('locations')->truncate();

        $blueBackground = "\e[44m";
        $reset = "\e[0m";

        $this->line("{$blueBackground} Location table truncated successfully. {$reset}");
    }
}
