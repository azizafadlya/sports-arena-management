<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\TimeSlotRepositoryInterface;
use Illuminate\Http\Request;

class TimeSlotController extends Controller
{
    protected $timeSlotRepository;

    public function __construct(TimeSlotRepositoryInterface $timeSlotRepository)
    {
        $this->timeSlotRepository = $timeSlotRepository;
    }

    public function index()
    {
        return response()->json($this->timeSlotRepository->getAll());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'arena_id' => 'required|exists:arenas,id',
            'start_time' => 'required|date_format:Y-m-d H:i:s',
            'end_time' => 'required|date_format:Y-m-d H:i:s|after:start_time',
        ]);

        return response()->json($this->timeSlotRepository->create($data), 201);
    }

    public function show($id)
    {
        $timeSlot = $this->timeSlotRepository->findById($id);
        return $timeSlot ? response()->json($timeSlot) : response()->json(['message' => 'Time Slot not found'], 404);
    }

    public function destroy($id)
    {
        return $this->timeSlotRepository->delete($id)
            ? response()->json(['message' => 'Time Slot deleted successfully'])
            : response()->json(['message' => 'Time Slot not found'], 404);
    }
}

