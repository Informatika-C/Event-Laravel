<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Dashboard', route('dashboard'));
});

Breadcrumbs::for('dashboard.contestant', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Contestant', route('dashboard.contestant'));
});
Breadcrumbs::for('dashboard.contestant.all', function ($trail) {
    $trail->parent('dashboard.contestant');
    $trail->push('All', route('dashboard.contestant.all'));
});
Breadcrumbs::for('dashboard.penyelenggara', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Penyelenggara', route('dashboard.penyelenggara'));
});
Breadcrumbs::for('dashboard.schedule', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Schedule', route('dashboard.schedule'));
});
Breadcrumbs::for('dashboard.sponsor', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Sponsor', route('dashboard.sponsor'));
});

Breadcrumbs::for('dashboard.events', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Events', route('dashboard.events'));
});

Breadcrumbs::for('dashboard.lomba', function ($trail, $event_id) {
    $trail->parent('dashboard.events');
    $trail->push('Lomba', route('dashboard.lomba', $event_id));
});

Breadcrumbs::for('home', function ($trail) {
    $trail->push('home', route('home'));
});

Breadcrumbs::for('home.eventpgs', function ($trail) {
    $trail->parent('home');
    $trail->push('Events', route('home.eventpgs'));
});

Breadcrumbs::for('home.lombapgs', function ($trail, $event_id) {
    $trail->parent('home.eventpgs');
    $trail->push('Lomba', route('home.lombapgs', $event_id));
});