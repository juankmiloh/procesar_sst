
/**
 * Elimina una foto
 */
function deleteRow(id){
    
    var url = $("#urlDelete").val();
    $.ajax({
        url: url,
        data: {id : id},
        success: function (response) {
            $('#list-datos').DataTable().ajax.reload();
        },
        error: function (error, tx) {
                console.log(tx);
        }
    });
}

function editRow(){
    alert("Operación no soportada");
}