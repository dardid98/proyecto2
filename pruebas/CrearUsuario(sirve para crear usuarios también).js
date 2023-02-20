window.onload=()=>{
    //Me guardo el formulario y los 2 divs que contendrán los elementos que voy a meter por dom, el submit para ponerle el prevent default y el campo select, para meterle un evento cada vez
    //que cambiamos de una opción a otra de las disponibles.
    var formul=document.getElementById("formul");
    var formulUsr=document.getElementById("formUsr");
    var formulEnt=document.getElementById("formEnt");
    var submit=document.getElementById("crear");
    var elegido=document.getElementById("tipo");

    //
    var select=document.createElement("select");
    var option=document.createElement("option");
    var option2=document.createElement("option");
    var option3=document.createElement("option");
    var option4=document.createElement("option");
    var br=document.createElement("br");
    
    //Creo un array con los nombres de los campos de la base de datos.
    var elementosEnt=new Array("emailEnt","contrEnt");
    var elementosUsu=new Array("emailUsu","contrUsu","nomusr","activado","edad","genero", "peso", "altura", "id_tarifa");

    //Genero todos los inputs, en el caso de que la posición del array sea id_tarifa, al select le añado los 4 options.
    //Añado al select las 4 opciones que hay de tarifa.
    select.append(option, option2, option3, option4);

    for(var s=0; s<elementosUsu.length; s++){
        if(elementosUsu[s]=="id_tarifa"){            
            var label=document.createElement("label");  //Label está aquí dentro porque necesito que cree una para cada elemento

            label.setAttribute("for",elementosUsu[s]);
            label.innerText=elementosUsu[s]+": ";

            select.setAttribute("id", elementosUsu[s]);
            select.setAttribute("name", elementosUsu[s]);
            select.setAttribute("required", "");

            option2.setAttribute("value", "2");
            option3.setAttribute("value", "3");
            option4.setAttribute("value", "4");

            option.innerText="Tarifa "+1;
            option3.innerText="Tarifa: "+3;
            option2.innerText="Tarifa: "+2;
            option4.innerText="Tarifa: "+4;

            formulUsr.append(label, select);

        }else{
            var label=document.createElement("label");   //Label está aquí dentro porque necesito que cree una para cada elemento, lo mismo para los inputs, si lo saco del bucle solo crea uno.
            var input=document.createElement("input"); 

            input.setAttribute("type","text");
            input.setAttribute("id",elementosUsu[s]);
            input.setAttribute("name",elementosUsu[s]);
            input.setAttribute("required","");

            label.setAttribute("for",elementosUsu[s]);
            label.innerText=elementosUsu[s]+": ";
            formulUsr.append(label, input,br);
        }
    }

    for(var s=0; s<elementosEnt.length; s++){

        var input=document.createElement("input");
        var label=document.createElement("label");
        var br=document.createElement("br");

        input.setAttribute("type","text");
        input.setAttribute("id",elementosEnt[s]);
        input.setAttribute("name",elementosEnt[s]);

        label.setAttribute("for",elementosEnt[s]);
        label.innerText=elementosEnt[s]+": ";
        
        formulEnt.append(label, input,br);
    }
    
    
    elegido.addEventListener("change", ()=>{
        if(elegido.value=="alumno"){
            formulUsr.style.display="block";
            formulEnt.style.display="none";

        }else if(elegido.value=="entrenador"){
            formulEnt.style.display="block";
            formulUsr.style.display="none";
        }else{
            formulEnt.style.display="none";
            formulUsr.style.display="none";
        }
    })
    formulEnt.style.display="none";
    formulUsr.style.display="none";


    submit.addEventListener("click", (event)=>{
        event.preventDefault();

        let emailEnt=document.getElementById("emailEnt").value;
        let emailUsu=document.getElementById("emailUsu").value;
        let contrEnt=document.getElementById("contrEnt").value;
        let contrUsu=document.getElementById("contrUsu").value;

        let nomusr=document.getElementById("nomusr").value;
        let edad=document.getElementById("edad").value;
        let genero=document.getElementById("genero").value;
        let peso=document.getElementById("peso").value;
        let altura=document.getElementById("altura").value;

        let activado=document.getElementById("activado").value;
        if(elegido.value=="alumno"){
            if(emailUsu=="" || contrUsu=="" || nomusr == "" || activado == ""|| genero == ""|| peso == ""|| altura == ""){
                alert("Te has dejado alguno de los campos en blanco");
                if (edad<0 || edad>100){
                    alert("Por favor, introduce la edad correcta");
                }
                else if(edad>-1&&edad<16){
                    alert("Lo sentimos, pero no puedes usar nuestros servicios hasta los 16 años");
                }else{
                    if(altura<100){
                        alert("Recuerda introducir la altura en cm");
                    }else if(peso<30||peso<0){
                        alert("Por favor introduce el peso real");
                    }else{
                        alert("no sé");
                        let imc=calcularImc(peso, altura);
                        const formattedFormData=new FormData(formul);
                        formattedFormData.append("imctipo",imc);
                        formattedFormData.append("crearUsu","crearUsu");
                        postData(formattedFormData);
                    }
                }
            }
        }
        else {
            if(emailEnt == "" || contrEnt == ""){
                alert("Te has dejado alguno de los campos en blanco");
            }
            else{
                const formattedFormData=new FormData(formul);
                formattedFormData.append("crearEnt","crearEnt");
                postData(formattedFormData);
            }
        }
    });
}


async function postData(datos){
    const resp=await fetch("gestionUsuarios.php",{
        method:"POST",
        body: datos
    });
    const data=await resp.text();

    alert(data);
}

function calcularImc(peso, altura){
    let imctipo;
    imc=peso / (altura * altura);
                
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