<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\ArenaRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArenaController extends Controller
{
    protected $arenaRepository;

    public function __construct(ArenaRepositoryInterface $arenaRepository)
    {
        $this->arenaRepository = $arenaRepository;
    }

    public function index()
    {
        return response()->json($this->arenaRepository->getAll());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $data['owner_id'] = Auth::id(); 

        return response()->json($this->arenaRepository->create($data), 201);
    }

    public function show($id)
    {
        $arena = $this->arenaRepository->findById($id);
        return $arena ? response()->json($arena) : response()->json(['message' => 'Arena not found'], 404);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'string|max:255',
            'owner_id' => 'exists:users,id', 
        ]);

        return $this->arenaRepository->update($id, $data)
            ? response()->json(['message' => 'Arena updated successfully'])
            : response()->json(['message' => 'Arena not found'], 404);
    }

    public function destroy($id)
    {
        return $this->arenaRepository->delete($id)
            ? response()->json(['message' => 'Arena deleted successfully'])
            : response()->json(['message' => 'Arena not found'], 404);
    }
}

