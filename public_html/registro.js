window.addEventListener("load",()=>{

    var imagen=document.getElementById("imgn");
    var imgs2=document.getElementById("imgs2");
    var formulario=document.getElementById("form");
    var email=document.getElementById("email");
    

    const passwdInput=document.getElementById("passwd");
    var privacidad=document.getElementById("privacidad");
    var priv2=document.getElementById("priv2");
    
    var persona=document.getElementById("persona");
    var pers=document.getElementById("pers");
    
    
    passwdInput.addEventListener("mouseenter", () => {
        passwdInput.setAttribute("type","text");
    });
    passwdInput.addEventListener("mouseleave", () => {
        passwdInput.setAttribute("type","password");
    });

    email.addEventListener("focusout", ()=>{
        //alert("Holo");
        const formattedFormData=new FormData();
        formattedFormData.append("email",email.value);
        formattedFormData.append("comprobar", "comprobar");
        comprobarEmail(formattedFormData);
        
    })

    persona.addEventListener("focusout", ()=>{
        var alerta=document.createElement("div");
        alerta.setAttribute("class", "alert alert-danger");
        alerta.textContent="Si no marcas este campo como Si, no podrás registrarte";
        //console.log(persona);
        if(persona.value=="Si"){
            //console.log(priv2.lastChild);
            //console.log(alert);
            if(pers.lastChild.nodeName=="DIV"){
                pers.removeChild(pers.lastChild);
            }
        }else{
            if(pers.lastChild.nodeName!="DIV"){
                //console.log(priv2.lastChild.nodeName);
                pers.appendChild(alerta);
            }
        }
    })
    privacidad.addEventListener("focusout", ()=>{
        var alerta=document.createElement("div");
        alerta.setAttribute("class", "alert alert-danger");
        alerta.textContent="Si no aceptas nuestra política de privacidad, no podrás registrarte";
        if(privacidad.checked){
            //console.log(priv2.lastChild);
            //console.log(alert);
            if(priv2.lastChild.nodeName=="DIV"){
                priv2.removeChild(priv2.lastChild);
            }
        }else{
            if(priv2.lastChild.nodeName!="DIV"){
                //console.log(priv2.lastChild.nodeName);
                priv2.appendChild(alerta);
            }
        }
    })
    formulario.addEventListener("submit", (event)=>{
        var eml2=document.getElementById("eml2");
        var persona=document.getElementById("persona").value;
        var checkbox = document.getElementsByName('privacidad');
        var contador = 0;
        let file1 = imagen.value;
        let [ext, ...fileName] = file1.split('.').reverse();
        ext=ext.toLowerCase();
        var filesize = imagen.files[0].size;

        for(var i=0; i< checkbox.length; i++) {
            if(checkbox[i].checked)
                contador++;
        }
        var privacidad=document.getElementById("privacidad").value;
        //console.log(contador);
        //alert(persona);
        if(eml2.lastChild.nodeName=="DIV"){
            event.preventDefault();
            alert("Por favor, introduce un email distinto, o ve a restablecer tu contraseña desde el login");
        }
        if(persona!="Si"){
            event.preventDefault();
            alert("Por favor, confirme que es una persona");
        }
        if(contador==0){
            event.preventDefault();
            alert("Por favor acepte nuestra política de privacidad");
        }
        //console.log(ext);
        if(ext!="jpg" && ext!="png" && ext!="webp" && ext!="bmp" && ext!="svg" && ext!="gif" && ext!="jpeg" && filesize/(1024*1024) >1){
            event.preventDefault();
            var alerta=document.createElement("div");
            alerta.setAttribute("class", "alert alert-danger");
            alerta.textContent="Error eso(máx 1mb) o formato de la imagen (jpg, png, webp, bmp, svg, gif, jpeg), vuelva a intentarlo";
            //imgs2.append(alert);
            if(imgs2.lastChild.nodeName!="DIV"){
                //console.log(priv2.lastChild.nodeName);
                imgs2.appendChild(alerta);
            }
    
        }
        else{
            if(imgs2.lastChild.nodeName=="DIV"){
                imgs2.removeChild(imgs2.lastChild);
            }
        }
    })
});

function calcularImc(peso, altura){
    let imc=peso / (altura * altura);
    let imctipo;
                
    if(imc<18.5) {
        imctipo=1;
    }else if(imc>=18.5 && imc<=24.9){
        imctipo=2;
    }else if(imc>=25 && imc<=29.9) {
        imctipo=3;
    }else if(imc>=30){
        imctipo=4;
    }
    return imctipo;
}

async function comprobarEmail(formattedFormData){
    const resp=await fetch("login.php", {
        method: "POST",
        body: formattedFormData
    }).then(resp=>resp.text())
    .then(data => compr=data);
    var compr=JSON.stringify(compr);
    compr=JSON.parse(compr);
    //console.log(compr);
    var eml2=document.getElementById("eml2");
    if(compr!="nada"){
        var alerta=document.createElement("div");
        alerta.setAttribute("class", "alert alert-danger");
        alerta.textContent="Este correo electrónico ya está registrado, ve a login para recuperar tu contraseña";
        if(eml2.lastChild.nodeName!="DIV"){
            eml2.appendChild(alerta);
        }
    }else{
        if(eml2.lastChild.nodeName=="DIV"){
            eml2.removeChild(eml2.lastChild);
        } 
    }
}