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

    //Añado al select las 4 opciones que hay de tarifa.
    select.append(option, option2, option3, option4);
    //Creo un array con los nombres de los campos de la base de datos.
    var elementosUsu=new Array("email","contr","nomusr","imctipo","activado","id_tarifa");

    //Genero todos los inputs, en el caso de que la posición del array sea id_tarifa, al select le añado los 4 options.
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
            input.setAttribute("name",elementosUsu[s]);
            label.setAttribute("for",elementosUsu[s]);
            label.innerText=elementosUsu[s]+": ";
            formulUsr.append(label, input,br);
        }
    }
    var elementosEnt=new Array("email","contr");
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
        const formattedFormData=new FormData(formul);
        if(elegido.value=="alumno"){
            formattedFormData.append("crearUsu","crearUsu");
        }else{
            formattedFormData.append("crearEnt","crearEnt");
        }
        postData(formattedFormData);
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