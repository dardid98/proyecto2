
window.addEventListener("load", ()=>{
    var formulario=document.getElementById("formulario");
    const registro=new FormData();
    var div=document.getElementsByClassName("form-group");
    registro.append("mostrar", "mostrar");
    var pantalla=document.getElementsByClassName("mensajes");
    
    //cargarMensajes(registro)
    formulario.addEventListener("submit", (event)=>{
        event.preventDefault();
        //alert(pantalla);
        var mensaje=document.getElementById("mensaje").value;
        if(mensaje==""){
            var alert=document.createElement("div");
            alert.setAttribute("class", "alert alert-primary");
            alert.textContent="No deje el campo en";
            div[0].append(alert);
        }else{

            
            const datos=new FormData(formulario);
            datos.append("mensaje", mensaje);
            enviarDatos(datos);
        }
        const chatWindow = document.getElementsByClassName('mensajes');
        chatWindow.scroll(0, chatWindow.scrollHeight);
})

setInterval(async() => {
    const mens=await cargarMensajes(registro);
    let limp = Array.prototype.slice.call(document.getElementsByClassName("contMensaje"), 0);
    for(element of limp){
        //console.log(element);
        element.remove();
    }  
    mens.forEach(element => {
        //console.log(element);
        var clase;
        var div2=document.createElement("div");
        var div1=document.createElement("div");
        div1.setAttribute("class","contMensaje");
        var mensajeDom=document.createElement("p");
        var fecha=document.createElement("p");
        if(element.tipo=="mensajeR"){
            clase="btn btn-secondary btn-sm mb-1";
        }else{
            clase="btn btn-success btn-sm mb-1";
        }
        //console.log(element.FECHA);
        mensajeDom.textContent=element.MENSAJE;
        //fecha.textContent=element.FECHA;
        //fecha.setAttribute("class","hello");

        div1.addEventListener("mouseenter", function(){
            mensajeDom.textContent+=" |   Fecha de envío: "+element.FECHA;
        })
        div1.addEventListener("mouseleave", function(){
            mensajeDom.textContent=element.MENSAJE;
        })
        div1.addEventListener("click", function(){
            mensajeDom.textContent=element.MENSAJE;
        })

        div2.setAttribute("class",clase);
        div2.setAttribute("disabled","disabled");
        div1.append(div2) 
        div2.append(mensajeDom);
        pantalla[0].append(div1);
        
    });
},1000);
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
        body: registro,
        
    });
    const data=await resp.text();
    var mens = JSON.stringify(data);
    mens=JSON.parse(data);
    //console.log(mens);
    return mens;
    /*console.log(mens);
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
        mensajeDom.textContent=element.MENSAJE;
        //fecha.textContent=element.FECHA;
        //fecha.setAttribute("class","hello");

        div1.addEventListener("mouseenter", function(){
            mensajeDom.textContent+=" |   Fecha de envío: "+element.FECHA;
        })
        div1.addEventListener("mouseleave", function(){
            mensajeDom.textContent=element.MENSAJE;
        })
        div1.addEventListener("click", function(){
            mensajeDom.textContent=element.MENSAJE;
        })

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