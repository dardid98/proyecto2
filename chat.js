window.addEventListener("load", ()=>{
    var formulario=document.getElementById("formulario");
    const registro=new FormData();
    registro.append("mostrar", "mostrar");
    setTimeout(() => {
        
        cargarMensajes(registro);
    }, 500);
    
    
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
    const mens=JSON.parse(data);
    console.log(mens);
    mens.forEach(element => {
        //console.log(element);
        var clase;
        var pantalla=document.getElementsByClassName("mensajes");
        var div2=document.createElement("div");
        var div1=document.createElement("div");
        var mensajeDom=document.createElement("p");
        var fecha=document.createElement("p");
        if(element.tipo=="mensajeR"){
            clase="btn btn-secondary btn-sm mb-1";
        }else{
            clase="btn btn-success btn-sm mb-1";
        }
        console.log(element.FECHA);
        mensajeDom.textContent=element.MENSAJE
        //fecha.textContent=element.FECHA;
        //fecha.setAttribute("class","hello");

        div2.setAttribute("class",clase);
        div2.setAttribute("disabled","disabled");
        div1.append(div2) 
        div2.append(mensajeDom);
        pantalla[0].append(div1);
        
    });
    //alert(data);
    //alert(data);
    /*if(data=="hola"){
        alert("Hola");
    }else{
        alert(data);
    }*/
}