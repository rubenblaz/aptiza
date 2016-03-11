//      BOTON DE INFORMACION 

$("document").ready(function () {
    // CUANDO HACEMOS CLICK EN EL ICONO DE INFORMACION EL ICONO SE PONE DE COLOR Y APARECE EL PANEL DE LA AYUDA
    $(".icon_info").click(function () {
        $(".icon_info").css("background-color", "#F2CF3D");
        $(".ayuda").css("display", "block");
    });
    
    // CUANDO HACEMOS CLICK EN LA IMAGEN DE CERRAR, DESAPARECE EL PANEL DE LA INFORMACION Y EL BOTON VUELVE A SU COLOR INICIAL
    $(".cerrar").click(function () {
        $(".ayuda").css("display", "none");
        $(".icon_info").css("background-color", "#fff");
    });
});
            