<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Bienvenido a OdontoClinik</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
    }

    .navbar-brand {
      font-weight: bold;
      font-size: 1.6rem;
    }

    .carousel-item img {
      width: 100%;
      height: 600px;
      object-fit: cover;
    }

    #nosotros p {
      text-align: justify;
      line-height: 1.6;
    }

    .img-nosotros {
      max-width: 100%;
      height: auto;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      border-radius: 15px;
    }

    footer {
      background: linear-gradient(45deg, #0d6efd, #6610f2);
      color: white;
    }

    .btn-primary {
      transition: 0.3s;
    }

    .btn-primary:hover {
      background-color: #0056b3;
      border-color: #0056b3;
    }
  </style>
</head>
<body>

  <!-- Barra de navegación -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
      <a class="navbar-brand" href="#">🦷 OdontoClinik</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav align-items-center">
          <li class="nav-item"><a class="nav-link active fw-semibold" href="#inicio">Inicio</a></li>
          <li class="nav-item"><a class="nav-link fw-semibold" href="#nosotros">Nosotros</a></li>
          <li class="nav-item ms-2">
            <a class="btn btn-primary fw-bold" href="{{ route('login') }}">Iniciar Sesión</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Carrusel de imágenes -->
  <section id="inicio" class="mb-5">
    <div id="carouselOdonto" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner rounded shadow-sm">
        <div class="carousel-item active">
          <img src="{{ asset('images/NICO.webp') }}" class="d-block" alt="Odontología 1">
        </div>
        <div class="carousel-item">
          <img src="{{ asset('images/ortodoncia.jpg') }}" class="d-block" alt="Odontología 2">
        </div>
        <div class="carousel-item">
          <img src="{{ asset('images/diente.jpg') }}" class="d-block" alt="Odontología 3">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselOdonto" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselOdonto" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
    </div>
  </section>

  <!-- Sección Nosotros -->
  <section id="nosotros" class="py-5 bg-light">
    <div class="container">
      <h2 class="text-center mb-5 fw-bold">Sobre Nosotros</h2>
      <div class="row align-items-center">
        <div class="col-md-6 text-center mb-4 mb-md-0">
          <img src="{{ asset('images/sonrisa.webp') }}" class="img-fluid img-nosotros" alt="Sobre nosotros">
        </div>
        <div class="col-md-6">
          <p class="lead">
            En <strong>OdontoClinik</strong>, nos dedicamos a cuidar tu sonrisa con profesionalismo, ética y tecnología de punta.
            Contamos con un equipo de especialistas en salud oral comprometidos con brindarte la mejor atención en un ambiente cálido y seguro.
          </p>
          <p>
            Ofrecemos tratamientos personalizados en odontología general, estética, ortodoncia y más. ¡Tu sonrisa es nuestra prioridad!
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="text-center py-3 mt-5">
    <p class="mb-0">&copy; 2025 OdontoClinik. Todos los derechos reservados.</p>
  </footer>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
