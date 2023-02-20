window.addEventListener("load",()=>{
    var formulario=document.getElementById("form");
    //const env=document.getElementById("enviar");
    var peso;
    var altura;
    //var email;
    var tarifas;
    
    formulario.addEventListener("submit", function(event){
        event.preventDefault();
        peso=document.getElementById("peso").value;
        altura=document.getElementById("altura").value;
        passwd=document.getElementById("passwd").value;
        nom_usr=document.getElementById("nom_usr").value;
        tarifas=document.getElementById("tarifas").value;
        peso=document.getElementById("peso").value;
        altura=document.getElementById("altura").value;
        
        /*if(peso==""||altura=="" || email==""|| passwd==""||nom_usr==""||genero==""|| edad=="" || tarifas==""){ //Comprobamos que las variables tienen contenido
            alert("No dejes ningún campo en blanco")
        }else if(edad<0 || edad>100){
            alert("Por favor, introduce la edad correcta");
        }
        else if(edad>-1&&edad<16){
            alert("Lo sentimos, pero no puedes usar nuestros servicios hasta los 16 años");
        }else{
            if(altura<100){
                alert("Recuerda introducir la altura en cm");
            }else if(peso<30||peso<0){
                alert("Por favor introduce tu peso real");
            }else{*/
                let imctipo=calcularImc(peso, altura);
                const formattedFormData=new FormData(formulario);
                formattedFormData.append("imc",imctipo);
                formattedFormData.append("registro", "registro");
                formattedFormData.append("TarifaSeleccionada",tarifas);
                console.log(formattedFormData);
                postData(formattedFormData, tarifas);
                //alert(tarifas);
           // }
        //}
    })
    
    
})
async function postData(formattedFormData, tarifas){
    const resp=await fetch("login.php", {
        method: "POST",
        body: formattedFormData,
        
    });
    const data=await resp.json();
    alert(data);
    switch (data){
        case "b": alert("Has sido registrado en la base de datos, comprueba tu correo electronico y pulsa en el enlace del mensaje para validar tu usuario");
        switch(tarifas){
            case "1": window.location.href="index.php"; break;
            case "2": window.location.href="pago.php?tarifa=2"; break;
            case "3": window.location.href="pago.php?tarifa=3"; break;
            case "4": window.location.href="pago.php?tarifa=4"; break;
            default: alert("lol");
        }
        default: "El correo introducido ya existe en nuestra base de datos, pruebe con otro o recupere su contrasena desde login";
    }
}


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