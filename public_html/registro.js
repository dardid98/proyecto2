window.addEventListener("load",()=>{

    var formulario=document.getElementById("form");

    const passwdInput=document.getElementById("passwd");
    
    
    passwdInput.addEventListener("mouseenter", () => {
        passwdInput.setAttribute("type","text");
    });
    passwdInput.addEventListener("mouseleave", () => {
        passwdInput.setAttribute("type","password");
    });
    
    formulario.addEventListener("submit", (event)=>{
        var persona=document.getElementById("persona").value;
        var checkbox = document.getElementsByName('privacidad');
        var contador = 0;
        for(var i=0; i< checkbox.length; i++) {
            if(checkbox[i].checked)
                contador++;
        }
        var privacidad=document.getElementById("privacidad").value;
        console.log(contador);
        //alert(persona);
        if(persona!="Si"){
            event.preventDefault();
            alert("Por favor, confirme que es una persona");
        }
        if(contador==0){
            event.preventDefault();
            alert("Por favor acepte nuestra política de privacidad");
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