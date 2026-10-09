
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestión de citas</title>
</head>
<body>
    <h1>Gestión de citas</h1>

    <p>Sesión: {{ auth()->user()->name }}</p>

    <a href="{{ route('appointments.create') }}">
        Registrar cita
    </a>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>Paciente</th>
                <th>Teléfono</th>
                <th>Servicio</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->patient_name }}</td>
                    <td>{{ $appointment->patient_phone }}</td>
                    <td>
                        {{ $appointment->service?->name ?? 'Sin servicio' }}
                    </td>
                    <td>
                        {{ $appointment->appointment_date->format('d/m/Y') }}
                    </td>
                    <td>
                        {{ substr($appointment->appointment_time, 0, 5) }}
                    </td>
                    <td>{{ $appointment->status }}</td>
                    <td>
                        <a href="{{ route('appointments.edit', $appointment) }}">
                            Editar
                        </a>

                        <form method="POST"
                              action="{{ route('appointments.destroy', $appointment) }}"
                              onsubmit="return confirm('¿Eliminar esta cita?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No hay citas registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $appointments->links() }}
</body>
</html>
