<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    <title>Celke Financeiro</title>
</head>
<body>

    <header class="p-3 text-bg-primary">
        <div class="container">
          <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
    
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
              <li><a href=" {{ route('conta.index') }} " class="nav-link px-2 text-white">Home</a></li>
              <li><a href=" {{ route('conta.index') }} " class="nav-link px-2 text-white">Contas</a></li>
            </ul>
    
            <div class="text-end">
              <button type="button" class="btn btn-warning">Login</button>
            </div>
          </div>
        </div>
      </header>

      <div class="container">
        @yield('content')
      </div>
    

    <script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>