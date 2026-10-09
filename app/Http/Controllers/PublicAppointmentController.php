<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Http\Request;

class PublicAppointmentController extends Controller
{
    public function create()
    {
        $services = Service::where('active', true)->get();

        return view('public.appointment', compact('services'));
    }

    public function store(Request $request)
    {
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
        ]);

        $data['status'] = 'pendiente';

        Appointment::create($data);

        return redirect()
            ->route('home')
            ->with(
                'success',
                'Tu solicitud fue recibida. Espera la confirmación del consultorio.'
            );
    }
}