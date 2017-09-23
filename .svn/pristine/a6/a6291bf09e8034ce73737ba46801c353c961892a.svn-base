
    /**
     * Hace visible los encuentros al público. 
     * @returns {undefined}
     */
    function publicarEncuentros(idFase){
        $.ajax({
            url: $("#urlPublicar").val(),
            data: {ctf_if : idFase},
            success: function (response) {
                $.LoadingOverlay('hide');
                alert("La programación fue publicada");
            },
            error: function (error, tx) {
                $.LoadingOverlay('hide');
                console.log(tx);
            }
        });
        
    }
    
    /**
     * Verifica que el sorteo este realizado y guarda los resultados
     */
    function guardarEncuentro(idFaseTieneEncuentros, fechahora, escenario){
        
        //console.log(idFaseTieneEncuentros+", "+fechahora);
        
        $.ajax({
            url: $("#urlGuardar").val(),
            data: {id : idFaseTieneEncuentros, fechahora : fechahora, escenario : escenario},
            success: function (response) {
                if(response != "1" && response != ""){
                    alert(response);
                    return "";
                }
                return 
            },
            error: function (error, tx) {
                    console.log(tx);
            }
        });
        
    }
    
    
    /**
     * Define el formato de la fecha para el datetime picker
     * @param {type} date
     * @returns {String}
     */
    function getFormattedDate(date) {
        var day = date.getDate();
        var month = date.getMonth() + 1;
        var year = date.getFullYear().toString().slice(2);
        return day + '-' + month + '-' + year;
    }