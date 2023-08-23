<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;

class ProjectController extends Controller
{

    public function projectsIndex() {

        $projects = Project :: all();

        return response()->json([
            'projects' => $projects
        ]);
    }

    public function projectIndexPage() {

        $projects = Project :: paginate(10);

        return response()->json([
            'projects' => $projects
        ]);
    }

    public function projectShow($id) {

        $project = Project :: with('type', 'technologies') -> findOrFail($id);

        return response() -> json([
            'project' => $project
        ]);
    }

    public function projectStore(Request $request) {

        $data = $request -> all();

        $project = Project :: create($data);
        $project -> technologies() -> attach($data['technologies']);

        return response() -> json([
            'project_id' => $project -> id
        ]);
    }

    public function getTypes() {

        $types = Type :: all();

        return response() -> json([
            'types' => $types
        ]);
    }
    public function getTechnologies() {

        $technologies = Technology :: all();

        return response() -> json([
            'technologies' => $technologies
        ]);
    }
}
