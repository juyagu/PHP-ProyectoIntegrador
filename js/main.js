
$(document).ready(function(){
    /*$(".btn-danger").click(function(){
        var idSeleccionado = $(this).attr("id");
        console.log(idSeleccionado);
    }); */
    //$(".btn-danger").click(getIdSeleccionado);


});
function mostrarMensaje(){
    console.log("Estoy aca!");
    var mensaje = document.querySelector("#mensaje").value;
    if(mensaje !== ""){
        alert(mensaje);
    }
}
function getIdSeleccionado(){
    var idSeleccionado = $(this).attr("id");
    //$(location).attr("eliminar_producto.php?id=" + idSeleccionado);
    document.location.href="eliminar_producto.php?id=" + idSeleccionado;
}

function nuevoProducto(){
    document.location.href="nuevo_producto.php";
}

function volverAlPanel(){
    document.location.href="panel-productos.php";
}

function habilitarUsuario(id){
    document.querySelector("#id_usuarioHabilitar").value = id;
    var form = document.querySelector("#frm_habilitar");
    form.submit();
}

function deshabilitarUsuario(id){
    document.querySelector("#id_usuarioDeshabilitar").value = id;
    var form = document.querySelector("#frm_deshabilitar");
    form.submit();
}

function eliminarProducto(id){
    document.location.href="eliminar_producto.php?id=" + id;
}

function modificarProducto(id){
    document.location.href="modificar_producto.php?id=" + id;
}
