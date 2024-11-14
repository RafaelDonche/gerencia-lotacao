<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <title>{{ env('APP_NAME') }}</title>

    {{-- styles --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('select2-4.1.0/dist/css/select2.min.css') }}">

    {{-- script --}}
    <script src="{{ asset('js/jquery.js') }}"></script>
</head>

<body>

    <div class="container p-0">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark justify-content-center">
            <a class="nav-link {{ str_contains(Route::current()->uri, 'dashboard') ? 'link-active' : '' }}"
                href="{{ route('dashboard') }}">Dashboard</a>
            <a class="nav-link {{ str_contains(Route::current()->uri, 'salas') ? 'link-active' : '' }}"
                href="{{ route('salas.index') }}">Salas</a>
            <a class="nav-link {{ str_contains(Route::current()->uri, 'espacoCafes') ? 'link-active' : '' }}"
                href="{{ route('espacoCafes.index') }}">Espaços de café</a>
            <a class="nav-link {{ str_contains(Route::current()->uri, 'pessoas') ? 'link-active' : '' }}"
                href="{{ route('pessoas.index') }}">Pessoas</a>
        </nav>
    </div>

    <main class="content py-0">
        <div class="container p-0">
            @include('sweetalert::alert')
            @yield('content')
        </div>
    </main>

    <!-- Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Bootstrap JS -->
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/js/bootstrap.min.js"></script> --}}

    <script src="{{ asset('js/fontawesome.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/functions.js') }}"></script>
    <script src="{{ asset('js/prevent_multiple_submits.js') }}"></script>
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('select2-4.1.0/dist/js/select2.min.js')}}"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                language: {
                    noResults: function() {
                        return "Nenhum resultado encontrado";
                    }
                },
                closeOnSelect: true,
                width: '100%',
            });

            $('.select2-multiple').select2({
                language: {
                    noResults: function() {
                        return "Nenhum resultado encontrado";
                    }
                },
                closeOnSelect: false,
                width: '100%',
            });

            $('.datatable').DataTable({
                oLanguage: {
                    sLengthMenu: "Mostrar _MENU_ registros por página",
                    sZeroRecords: "Nenhum registro encontrado",
                    sInfo: "Mostrando _START_ / _END_ de _TOTAL_ registro(s)",
                    sInfoEmpty: "Mostrando 0 / 0 de 0 registros",
                    sInfoFiltered: "(filtrado de _MAX_ registros)",
                    sSearch: "Pesquisar: ",
                    oPaginate: {
                        sFirst: "Início",
                        sPrevious: "Anterior",
                        sNext: "Próximo",
                        sLast: "Último"
                    }
                },
            });
        });
    </script>

    @yield('scripts')
</body>
</html>
