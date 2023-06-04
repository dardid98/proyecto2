window.addEventListener("load",()=>{

    var imagen=document.getElementById("imgn");
    var imgs2=document.getElementById("imgs2");
    var formulario=document.getElementById("form");

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

    persona.addEventListener("focusout", ()=>{
        var alert=document.createElement("div");
        alert.setAttribute("class", "alert alert-primary");
        alert.textContent="Si no marcas este campo como Si, no podrás registrarte";
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
                pers.appendChild(alert);
            }
        }
    })
    privacidad.addEventListener("focusout", ()=>{
        var alert=document.createElement("div");
        alert.setAttribute("class", "alert alert-primary");
        alert.textContent="Si no aceptas nuestra política de privacidad, no podrás registrarte";
        if(privacidad.checked){
            //console.log(priv2.lastChild);
            //console.log(alert);
            if(priv2.lastChild.nodeName=="DIV"){
                priv2.removeChild(priv2.lastChild);
            }
        }else{
            if(priv2.lastChild.nodeName!="DIV"){
                //console.log(priv2.lastChild.nodeName);
                priv2.appendChild(alert);
            }
            
        }
    })
    formulario.addEventListener("submit", (event)=>{
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
            var alert=document.createElement("div");
            alert.setAttribute("class", "alert alert-primary");
            alert.textContent="El peso(máx 1mb) o el formato de la imagen es distinto de los permitidos(jpg, png, webp, bmp, svg, gif, jpeg), \nvuelva a intentarlo";
            imgs2.append(alert);
            if(imgs2.lastChild.nodeName!="DIV"){
                //console.log(priv2.lastChild.nodeName);
                imgs2.appendChild(alert);
            }
    
        }
        else{
            imgs2.removeChild(priv2.lastChild);
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