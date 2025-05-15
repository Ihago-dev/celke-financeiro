@extends('layouts.admin')

@section('content')
    <body >
        <h1>Projeto Laravel Financeiro</h1>

        <a href="{{ route('conta.index') }}">Listar as Contas</a>
    </body>
@endsection

