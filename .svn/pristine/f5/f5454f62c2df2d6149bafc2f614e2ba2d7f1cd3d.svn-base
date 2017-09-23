
    /**
     * Publica los resultados para el público 
     */
    function publicarResultados(id){
        
        var table = $('#mytable'+id).tableToJSON();
        
        for(var i = 0; i < table.length ; i++){
            table[i]['AVANZA'] = $( "#check"+id+"_"+i ).prop( "checked");
        }
        
        $.ajax({
            url: $("#urlGuardar").val(),
            data: {data : table},
            success: function (response) {
                $.LoadingOverlay('hide');
            },
            error: function (error, tx) {
                $.LoadingOverlay('hide');
                console.log(tx);
            }
        });
    }
    
    /**
     * Valida la cantidad máxima de clasificados por grupo
     * @returns {undefined}
     */
    function validarClasificadosGrupo(idTable){
        var count = 0;
        $('input[type=checkbox][id*=check'+idTable+']:checked').each(function(){
            count++;
            if(count > clasificadosPorGrupo){
                $(this).prop( "checked", false );
                alert(MAX_GRUPO+" "+clasificadosPorGrupo);
            }
        });
        
    }