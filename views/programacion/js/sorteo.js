    /**
    * Organiza de forma automatica los grupos y posiciones. 
     * @returns {undefined}     */
    function organizarAutomaticamente(){
        var tableRows = document.getElementById('table1');
        var totalRows = tableRows.rows.length
        var mm = 2;
        for(var j = 1; j < totalRows; j++){
            for(; mm < tables.length; ){
                if(tables[mm] > 0){
                    //var sender = "#table1_"+j;
                    var sender = "#"+tableRows.rows[1].attributes['id'].value;
                    var receiver = '#table'+mm;
                    tables[mm] = tables[mm] - 1;
                    $(sender).appendTo(receiver);
                    break;
                } else {
                    mm++
                }
            }
        }
    }
    
    /**
     * Verifica que el sorteo este realizado y guarda los resultados
     */
    function guardarSorteo(){
        
        var tableRows = document.getElementById('table1');
        if(tableRows.rows.length > 1){
            alert("Debe terminar el sorteo antes de guardar");
        } else {
            $.LoadingOverlay('show');
            var dataArray = "";
            for(var jm = 2; jm < tables.length; jm++){
                var tableRows = document.getElementById('table'+jm);
                dataArray += "&&&";
                for(lk = 1; lk < tableRows.rows.length; lk++){
                    dataArray += tableRows.rows[lk].cells[0].innerText + ";";
                }
                dataArray = dataArray.slice(0,-1);
            }
            
            //console.log(dataArray);
            $.ajax({
                url: $("#urlGuardar").val(),
                data: {data : dataArray},
                success: function (response) {
                    $.LoadingOverlay('hide');
                    alert("Sorteo registrado exitosamente");
                    
                },
                error: function (error, tx) {
                    $.LoadingOverlay('hide');
                    console.log(tx);
                }
            });
        }
    }