<?php


use Illuminate\Support\Facades\Schedule;

Schedule::command('app:sitemap-generate')->dailyAt('00:00');
