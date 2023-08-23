<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ProjectController;

Route :: prefix('v1') -> group(function() {

    Route :: get('/projects', [ProjectController :: class, 'projectsIndex']);
    Route :: get('/projects-page', [ProjectController :: class, 'projectIndexPage']);

    Route :: post('/projects', [ProjectController :: class, 'projectStore']);

    Route :: get('/projects/{id}', [ProjectController :: class, 'projectShow']);

    Route :: get('/types', [ProjectController :: class, 'getTypes']);
    Route :: get('/technologies', [ProjectController :: class, 'getTechnologies']);
});
