@extends('layouts.main')

@section('title', 'Conversões Moeda')

@section('content')


<div id="container" class="col-md-6 offset-md-3">
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Conversão</li>
    </ol>
    </nav>
    <form action="/convert" method="POST" class="form-horizontal">
    @csrf
    <div class="form-group form-row">
        <div class="col">
            <label for="title">Valor Original</label>
            <div class="input-group">
                <input type="text" class="form-control" id="valor_original" 
                        name="valor_original" placeholder="Valor" >
            </div>
        </div>
        <div class="col">
            <label for="title">Moeda original</label>
            <div class="input-group">
                <select name='moeda_original' id='moeda_original' class="form-control">
                    <option value="BRL" >BRL</option>
                    <option value="USD" >USD</option>
                    <option value="CAD" >CAD</option>
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
                <option value="BRL" >BRL</option>
                <option value="USD" >USD</option>
                <option value="CAD" >CAD</option>
            </select>
            </div>
        </div>
        <div class="col">
            <label for="title">Valor Convertido</label>
            <div class="input-group">
                <input type="text" class="form-control" disabled id='valor_convertido'>
            </div>
        </div>
    </div>
        <input type="button" class="btn btn-primary" value="Consultar" id='consultar'>
    </form>
</div>
<div id="container" class="col-md-6 offset-md-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Log de Conversões</li>
        </ol>
    </nav>
    @if (!empty($coins))
        <table class="table table-borderless table-hover table-sm table-striped" id='convert'>
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
            <td>{{ number_format($coin->valor_original, 2, ',', '.') }}</td>
            <td>{{ $coin->moeda_original }}</td>
            <td>{{ number_format($coin->valor_convertido, 2, ',', '.') }}</td>
            <td>{{ $coin->moeda_convertida }}</td>
            <td>{{ date_format($coin->created_at, 'd/m/Y') }}</td>
            <td>{{ $coin->user()->get()->first()->name }}</td>
            </tr>
        @endforeach
        </tbody>
        </table>
@endif
    <div class="d-flex justify-content-center">{{ $coins->links() }} </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#valor_original').mask('##0.00', {reverse: true});

        $( "#consultar" ).click(function( e ) {
            event.preventDefault();
            let data = {};
            data["valor_original"] = $("#valor_original").val();
            data["moeda_original"] = $("#moeda_original").val();
            data["moeda_convertida"] = $("#moeda_convertida").val();
            let jsonData = JSON.stringify(data, null, 4);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/convert',
                type: "POST",
                data: data,
                success: function (d){
                    converte(data);
                    insereLinha(d);
                },
                error: function (data, textStatus, errorThrown) {
                    console.log(data);
                }
            })
        });

        function converte(data) {
            $.get('https://api.exchangeratesapi.io/latest?base='+data["moeda_original"], function(reg) {
                let valor_convertido = reg['rates'][data["moeda_convertida"]] * data['valor_original'];
                $("#valor_convertido").val(valor_convertido.toFixed(2));
	        });
        }

        (function($) {	  
            insereLinha = function(data) {
                let date = new Date();
                let mes = date.getMonth() + 1
                if (mes < 10)
                    mes = '0'+mes;
                date = date.getDate()+'/'+mes+'/'+date.getFullYear();
                let newRow = $("<tr class='table-row'>");
                let cols = "";	
                cols += '<td>'+data['valor_original']+'</td>';
                cols += '<td>'+data['moeda_original']+'</td>';
                cols += '<td>'+data['valor_convertido']+'</td>';
                cols += '<td>'+data['moeda_convertida']+'</td>';
                cols += '<td>'+date+'</td>';
                cols += '<td>'+data['user_id']+'</td>';
                newRow.append(cols);
                $("#convert").prepend(newRow);	
                return false;
            };
        })(jQuery);

    });
    </script>
@endsection