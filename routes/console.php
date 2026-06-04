<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('telescope:prune --hours=48')->daily();
Schedule::command('ch:check-resource-urls')->everyFourHours();
Schedule::command('ch:notify-invalid-resources')->twiceDaily();
Schedule::command('ch:prune-apple-music-checks')->weekly();
Schedule::command('horizon:snapshot')->everyFiveMinutes();
