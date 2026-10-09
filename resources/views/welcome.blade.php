
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultorio Dental</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            color: #243746;
            background: #f4fbfc;
        }
        header {
            padding: 22px 8%;
            background: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }
        header a, .button {
            text-decoration: none;
            color: white;
            background: #078b91;
            padding: 12px 18px;
            border-radius: 8px;
        }
        .hero {
            padding: 85px 8%;
            background: #dff5f4;
        }
        .hero h1 {
            font-size: clamp(32px, 5vw, 52px);
            max-width: 700px;
        }
        .hero p {
            font-size: 18px;
            line-height: 1.7;
            max-width: 600px;
        }
        section { padding: 45px 8%; }
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
            gap: 18px;
        }
        .card {
            background: white;
            border-radius: 12px;
            padding: 22px;
        }
        footer {
            background: #163d48;
            color: white;
            padding: 25px 8%;
        }
    </style>
</head>
<body>
    <header>
        <strong>Consultorio Dental</strong>
        <nav>
            <a href="{{ route('login') }}">Acceso del dentista</a>
        </nav>
    </header>

    <main>
        <section class="hero">
            <h1>Una sonrisa saludable comienza aquí</h1>
            <p>
                Atención odontológica con un trato cercano.
                Conoce nuestros servicios y solicita tu cita.
            </p>
            <a class="button"
               href="{{ route('public.appointments.create') }}">
                Solicitar una cita
            </a>
        </section>

        <section>
            <h2>Nuestros servicios</h2>
            <div class="cards">
                @foreach (
                    \App\Models\Service::where('active', true)->get()
                    as $service
                )
                    <article class="card">
                        <h3>{{ $service->name }}</h3>
                        <p>{{ $service->description }}</p>
                        <p>
                            Desde ${{ number_format($service->price, 2) }}
                        </p>
                    </article>
                @endforeach
            </div>
        </section>

        <section>
            <h2>Promociones</h2>
            <div class="cards">
                @foreach (
                    \App\Models\Promotion::where('active', true)->get()
                    as $promotion
                )
                    <article class="card">
                        <h3>{{ $promotion->title }}</h3>
                        <p>{{ $promotion->description }}</p>
                        @if ($promotion->discount_percentage)
                            <strong>
                                {{ $promotion->discount_percentage }}% de descuento
                            </strong>
                        @endif
                    </article>
                @endforeach
            </div>
        </section>
    </main>

    <footer>
        Consultorio Dental · Atención con previa cita.
        <p>Agrega aquí el teléfono, domicilio y horario reales.</p>
    </footer>
</body>
</html>
