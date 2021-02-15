@extends('layouts.main')

@section('title', 'Conversões Moeda')

@section('content')


<div id="container" class="col-md-6 offset-md-3">
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Conversão</li>
    </ol>
    </nav>
    <form action="/dashboard" method="POST" class="form-horizontal">
    @csrf
    <div class="form-group form-row">
        <div class="col">
            <label for="title">Valor Original</label>
            <div class="input-group">
                <input type="text" class="form-control" id="valor_original" 
                        name="valor_original" placeholder="Valor" value="{{$coin->valor_original}}" >
            </div>
        </div>
        <div class="col">
            <label for="title">Moeda original</label>
            <div class="input-group">
                <select name='moeda_original' id='moeda_original' class="form-control">
                    <option value="BRL" {{$coin->moeda_original=='BRL' ? "selected": ""}}>BRL</option>
                    <option value="USD" {{$coin->moeda_original=='USD' ? "selected": ""}}>USD</option>
                    <option value="CAD" {{$coin->moeda_original=='CAD' ? "selected": ""}}>CAD</option>
                </select>
            </div>
        </div>
        <div class="col" style="text-align: center;">
            <label for="title" > >>> </label>
            <div class="input-group">
            </div>
        </div>  
        <div class="col">
            <label for="title">Moeda Convertida</label>
            <div class="input-group">
            <select class="form-control" name='moeda_convertida' id='moeda_convertida' >
                <option value="BRL" {{$coin->moeda_convertida=='BRL' ? "selected": ""}}>BRL</option>
                <option value="USD" {{$coin->moeda_convertida=='USD' ? "selected": ""}}>USD</option>
                <option value="CAD" {{$coin->moeda_convertida=='CAD' ? "selected": ""}}>CAD</option>
            </select>
            </div>
        </div>
        <div class="col">
            <label for="title">Valor Convertido</label>
            <div class="input-group">
                @if(!empty($coin->valor_convertido))
                <input type="text" class="form-control" value="{{$coin->valor_convertido}}" disabled>
                @endif
            </div>
        </div>
    </div>
        <input type="submit" class="btn btn-primary" value="Consultar" id='consultar'>
    </form>
</div>
<div id="container" class="col-md-6 offset-md-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Log de Conversões</li>
        </ol>
    </nav>
    @if (!empty($coins))
        <table class="table table-borderless table-hover table-sm table-striped">
        <thead class='thead-light'>
            <tr>
            <th scope="col">Valor Original</th>
            <th scope="col">Moeda original</th>
            <th scope="col">Valor Convertido</th>
            <th scope="col">Moeda Convertida</th>
            <th scope="col">Horario da Conversão</th>
            <th scope="col">usuário</th>
            </tr>
        </thead>
        <tbody>
        @foreach($coins as $coin)
            <tr class='table-row'>
            <td>{{ $coin->valor_original }}</td>
            <td>{{ $coin->moeda_original }}</td>
            <td>{{ $coin->valor_convertido }}</td>
            <td>{{ $coin->moeda_convertida }}</td>
            <td>{{ date_format($coin->created_at, 'd/m/Y') }}</td>
            <td>{{ $coin->user_id }}</td>
            </tr>
        @endforeach
        </tbody>
        </table>
@endif
</div>
<script type="text/javascript">
        $(document).ready(function(){
        $('#valor_original').mask('##0.00', {reverse: true});
        });
    </script>
@endsection