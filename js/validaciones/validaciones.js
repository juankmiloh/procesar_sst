
    /**
     * Valida correo electrónico valido
     */
    function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if(!re.test(email)){
            return "";
        } else {
            return email;
        }
    }

    /**
     * Valida la longitud máxima de un campo
     */
    function validarLongitudMax(cadena, longitud){
        var value = $("#"+cadena).val();
        if(value.trim().length > parseInt(longitud)){
            $("#"+cadena).css({'border-color': 'red'});
            return true;
        } else {
            $("#"+cadena).css({'border-color': ''});
            return false;
        }
    }
    
    /**
     * Valida la longitud mínima de un campo
     */
    function validarLongitudMin(cadena, longitud){
        var value = $("#"+cadena).val();
        if(value.trim().length < parseInt(longitud)){
            $("#"+cadena).css({'border-color': 'red'});
            return true;
        } else {
            $("#"+cadena).css({'border-color': ''});
            return false;
        }
    }
    
    /**
     * Valida que una fecha no puede estar vacia
     */
    function validarFechaNoVacia(fecha){
        var value = $("#"+fecha).val()
        if(value.trim() == ""){
            $("#"+fecha).css({'border-color': 'red'});
            return true;
        } else {
            $("#"+fecha).css({'border-color': ''});
            return false;
        }
    }
    
    /**
     * Valida que una lista tenga un valor seleccionados
     * @param {type} lista
     * @returns {Boolean}
     */
    function validarListaSeleccionada(lista){
        var value = $("#"+lista+" option:selected").attr('value');
        if(value == null || value.trim() == ""){
            $("#"+lista).css({'border-color': 'red'});
            return true;
        } else {
            $("#"+lista).css({'border-color': ''});
            return false;
        }
    }

    
    /**
     * Valida que una lista multiple tenga al menos un valor seleccionado
     * @param {type} lista
     * @returns {Boolean}
     */
    function validarListaMultipleSeleccionada(lista){
        var select1 = document.getElementById(lista);
        if (select1.length == 0) {
            $("#"+lista).css({'border-color': 'red'});
            return true;
        } else {
            $("#"+lista).css({'border-color': ''});
            
            /**
             * Este ciclo es necesario para que al serializar el formulario 
             * tenga los valores agregados al select
             * de lo contrario se iria vacio
             */
            for(var i = 0; i < select1.length; i++){ 
                select1.options[i].selected = "selected";
            }
            
            return false;
        }
    }
    
    /**
     * Función que restringe a solo ingresar letras en un campo
     * @returns {Boolean}
     */
    function soloLetras(event){
        var RegExpression = /^[a-zA-Z\s]*$/;
        var key = event.keyCode;
        key = String.fromCharCode(key);
        if (!RegExpression.test(key)) {
            event.preventDefault();
            return false;
        }
    }
    
    /**
     * Función que restringe a solo ingresar números en un campo
     * @returns {Boolean}
     */
    function soloNumeros(){
        
    }
    
    /**
     * Función que restringe a solo ingresar letras y números en un campo
     * @returns {Boolean}
     */
    function soloAlfanumerico(event){
        var RegExpression = /^([a-zA-Z0-9 _-]+)$/;
        var key = event.keyCode;
        key = String.fromCharCode(key);
        if (!RegExpression.test(key)) {
            event.preventDefault();
            return false;
        }
    }
    /*
     * Valida que una fecha no sea superior a otra
     */
    function validarFechaFinalMayor(fechaInicial, fechaFinal){
        if($("#"+fechaInicial).val() > $("#"+fechaFinal).val()){            
            $("#"+fechaFinal).css({'border-color': 'red'});
            return true;
        }else{
            $("#"+fechaFinal).css({'border-color': ''});
            return false;
        }
    }

    /*
     * Valida que en un select no haya valor seleccionado
     */
    function validaSelect(select){
        if($('#'+select+' option:selected').length == 0){
            $("#"+select).selectpicker('setStyle', 'btn-danger');
            return true;
        }else{
            $("#"+select).selectpicker('setStyle', 'btn-danger','remove');
            return false;
        }
    }
    
    function validaCampoNoVacio(nombre){
        if($("#"+nombre).val().length == 0){
            $("#"+nombre).css({'border-color': 'red'});
            return true;
        }
        $("#"+nombre).css({'border-color': ''});
        return false;
    }
