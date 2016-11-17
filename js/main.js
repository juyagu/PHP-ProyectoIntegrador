
$(document).ready(function(){
    /*$(".btn-danger").click(function(){
        var idSeleccionado = $(this).attr("id");
        console.log(idSeleccionado);
    }); */
    $(".btn-danger").click(getIdSeleccionado);


});
function getIdSeleccionado(){
    var idSeleccionado = $(this).attr("id");
    //$(location).attr("eliminar_producto.php?id=" + idSeleccionado);
    document.location.href="eliminar_producto.php?id=" + idSeleccionado;
}