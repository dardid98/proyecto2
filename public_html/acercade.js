window.addEventListener("load", ()=>{

    var formul=document.getElementById("form");
    var ayuda=document.getElementById("ayuda");
    var opciones=document.getElementById("opciones");

    var bot1=document.createElement("input");
    var bot2=document.createElement("input");
    var bot3=document.createElement("input");

    var p1=document.createElement("p");
    var p2=document.createElement("p");
    var p3=document.createElement("p");

    var hr=document.createElement("hr");
    hr.setAttribute("class","light");

    formul.addEventListener("submit", (event)=>{
        event.preventDefault();
        //alert("ciao");

        bot1.setAttribute("type","button");
        bot1.setAttribute("id","pago");
        bot1.setAttribute("value","Consultar");

        bot2.setAttribute("type","button");
        bot2.setAttribute("id","activado");
        bot2.setAttribute("value","Consultar");

        bot3.setAttribute("type","button");
        bot3.setAttribute("id","consulta");
        bot3.setAttribute("value","Consultar");

        bot1.setAttribute("class","btn btn-primary");
        bot2.setAttribute("class","btn btn-primary");
        bot3.setAttribute("class","btn btn-primary");

        p1.innerText="No he podido realizar el pago en el registro";
        p2.innerText="No he podido activar mi usuario";
        p3.innerText="¿Cómo puedo ponerme en contacto con el administrador?";

        p1.setAttribute("class","text-light");
        p2.setAttribute("class","text-light");
        p3.setAttribute("class","text-light");

        opciones.append(p1, bot1, hr, p2, bot2, hr, p3, bot3);
    })
    bot1.addEventListener("click", (event)=>{
        event.preventDefault();
        p1.innerText="No te preocupes, si has activado tu usuario, puedes realizar el pago desde tu menu personal tras logearte.";
    })
    bot2.addEventListener("click", (event)=>{
        event.preventDefault();
        p2.innerText="En este caso tienes 2 opciones, intentar ponerte en contacto con el administrador por correo electrónico, o utilizar un correo electrónico distinto para registrarte y asegurarte de activar tu usuario.";
    })
    bot3.addEventListener("click", (event)=>{
        event.preventDefault();
        p3.innerText="El correo electrónico del administrador es ...";
    })
})