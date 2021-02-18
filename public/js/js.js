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
    