window.addEventListener("load", ()=>{
    var formulario=document.getElementById("formulario");
    const registro=new FormData();
    registro.append("mostrar", "mostrar");
    cargarMensajes(registro);
    
    
    formulario.addEventListener("submit", (event)=>{
        event.preventDefault();
        //alert(pantalla);
        var mensaje=document.getElementById("mensaje").value;
        
        const datos=new FormData(formulario);
        datos.append("mensaje", mensaje);
        enviarDatos(datos);
        
    })
})

async function enviarDatos(datos){
    const resp=await fetch("chat.php", {
        method:"POST",
        body: datos
    });
    window.location.href="chat.php";
}

async function cargarMensajes(registro){
    const resp=await fetch("chat.php", {
        method:"POST",
        body: registro
    });
    const data=await resp.text();
    //alert(data);
    const mens=JSON.parse(data);
    mens.forEach(element => {
        console.log(element);

        var pantalla=document.getElementsByClassName("mensajeR");
        var div=document.createElement("div");
        var mensajeDom=document.createElement("p");

        mensajeDom.textContent=element.MENSAJE;
        div.setAttribute("class","mensaje");
        div.append(mensajeDom);
        pantalla[0].append(div);
        
    });
    //alert(data);
    //alert(data);
    /*if(data=="hola"){
        alert("Hola");
    }else{
        alert(data);
    }*/
}