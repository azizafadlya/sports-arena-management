<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\BookingRepositoryInterface;
use App\Repositories\Interfaces\TimeSlotRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    protected $bookingRepository;
    protected $timeSlotRepository;

    public function __construct(BookingRepositoryInterface $bookingRepository, TimeSlotRepositoryInterface $timeSlotRepository)
    {
        $this->bookingRepository = $bookingRepository;
        $this->timeSlotRepository = $timeSlotRepository;
    }

    public function index()
    {
        return response()->json($this->bookingRepository->getAll());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'time_slot_id' => 'required|exists:time_slots,id',
        ]);

        return DB::transaction(function () use ($data) {
            if ($this->bookingRepository->findActiveBookingByTimeSlot($data['time_slot_id'])) {
                return response()->json(['message' => 'Time slot already booked'], 400);
            }

            $booking = $this->bookingRepository->create([
                'time_slot_id' => $data['time_slot_id'],
                'user_id' => auth()->user()->id,
                'status' => 'pending',
                'expires_at' => now()->addMinutes(10),
            ]);

            return response()->json($booking, 201);
        });
    }

    public function show($id)
    {
        $booking = $this->bookingRepository->findById($id);
        return $booking ? response()->json($booking) : response()->json(['message' => 'Booking not found'], 404);
    }

    public function confirm($id)
    {
        $booking = $this->bookingRepository->findById($id);
        if (!$booking || $booking->status !== 'pending') {
            return response()->json(['message' => 'Booking not found or already confirmed'], 400);
        }

        $this->bookingRepository->update($id, ['status' => 'confirmed']);
        return response()->json(['message' => 'Booking confirmed']);
    }

    public function destroy($id)
    {
        return $this->bookingRepository->delete($id)
            ? response()->json(['message' => 'Booking deleted successfully'])
            : response()->json(['message' => 'Booking not found'], 404);
    }
}

