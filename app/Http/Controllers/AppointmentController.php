<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with('service')
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->paginate(15);

        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        $services = Service::where('active', true)->get();

        return view('appointments.create', compact('services'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'patient_name' => ['required', 'string', 'max:120'],
            'patient_email' => ['nullable', 'email', 'max:255'],
            'patient_phone' => ['required', 'string', 'max:20'],
            'service_id' => [
                'nullable',
                'exists:services,id',
            ],
            'appointment_date' => [
                'required',
                'date',
                'after_or_equal:today',
            ],
            'appointment_time' => ['required', 'date_format:H:i'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);

        $data['status'] = 'pendiente';

        Appointment::create($data);

        return redirect()
            ->route('appointments.index')
            ->with('success', 'Cita registrada correctamente.');
    }

    public function edit(Appointment $appointment)
    {
        $services = Service::where('active', true)->get();

        return view(
            'appointments.edit',
            compact('appointment', 'services')
        );
    }

    public function update(
        Request $request,
        Appointment $appointment
    ) {
        $data = $request->validate([
            'patient_name' => ['required', 'string', 'max:120'],
            'patient_email' => ['nullable', 'email', 'max:255'],
            'patient_phone' => ['required', 'string', 'max:20'],
            'service_id' => ['nullable', 'exists:services,id'],
            'appointment_date' => [
                'required',
                'date',
                'after_or_equal:today',
            ],
            'appointment_time' => ['required', 'date_format:H:i'],
            'status' => [
                'required',
                Rule::in([
                    'pendiente',
                    'confirmada',
                    'completada',
                    'cancelada',
                ]),
            ],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);

        $appointment->update($data);

        return redirect()
            ->route('appointments.index')
            ->with('success', 'Cita actualizada.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()
            ->route('appointments.index')
            ->with('success', 'Cita eliminada.');
    }
}