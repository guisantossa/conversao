@extends('layouts.main')

@section('title', 'Conversões Moeda')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Log de Conversões</li>
    </ol>
</nav>
<table class="table table-borderless table-hover table-sm table-striped">
<thead class='thead-light'>
    <tr>
    <th scope="col">Valor Original</th>
    <th scope="col">Moeda original</th>
    <th scope="col">Valor Convertido</th>
    <th scope="col">Moeda Convertida</th>
    <th scope="col">Cotação</th>
    <th scope="col">Horario da Conversão</th>
    <th scope="col">usuário</th>
    </tr>
</thead>
<tbody>
@foreach($coins as $coin)
    <tr class='table-row'>
    <td>{{ number_format($coin->valor_original, 2, ',', '.') }}</td>
    <td>{{ $coin->moeda_original }}</td>
    <td>{{ number_format($coin->valor_convertido, 2, ',', '.') }}</td>
    <td>{{ $coin->moeda_convertida }}</td>
    <td>{{$coin->moeda_original}} {{ $coin->valor_original/$coin->valor_convertido }}</td>
    <td>{{ date_format($coin->created_at, 'd/m/Y') }}</td>
    <td>{{ $coin->user()->get()->first()->name }}</td>
    </tr>
@endforeach
</tbody>
</table>
<div class="d-flex justify-content-center">{{ $coins->links() }} </div>
@endsection