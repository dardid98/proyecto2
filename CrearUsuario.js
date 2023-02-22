window.addEventListener("load", ()=>{
    //Me guardo el formulario y los 2 divs que contendrán los elementos que voy a meter por dom, el submit para ponerle el prevent default y el campo select, para meterle un evento cada vez
    //que cambiamos de una opción a otra de las disponibles.
    var formul=document.getElementById("formul");
    //var br=document.createElement("br");

    //

    
    //Creo un array con los nombres de los campos de la base de datos.
    var elementosEnt=new Array("email","contr");


    for(var s=0; s<elementosEnt.length; s++){

        let input=document.createElement("input");
        let label=document.createElement("label");
        let div=document.createElement("div");
        div.setAttribute("class","mb-2");

        input.setAttribute("id",elementosEnt[s]);
        input.setAttribute("name",elementosEnt[s]);
        input.setAttribute("required","required");
        input.setAttribute("class","form-control");
        if(elementosEnt[s]=="email"){
            input.setAttribute("type","email");
            label.innerText="Email: ";
        }else{
            input.setAttribute("type","password");
            label.innerText="Contraseña: ";
            
        }
        
        label.setAttribute("for",elementosEnt[s]);
        div.append(label, input);
        
        formul.append(div);
    }
    let submit=document.createElement("input");
    submit.setAttribute("type","submit");
    submit.setAttribute("class","btn btn-danger");
    submit.setAttribute("name","crear");
    submit.setAttribute("id","crear");
    submit.setAttribute("value","Crear");
    formul.append(submit);

    formul.addEventListener("submit", (event)=>{
        event.preventDefault();

        let email=document.getElementById("email").value;
        let contr=document.getElementById("contr").value;
        if(email == "" || contr == ""){
            alert("Te has dejado alguno de los campos en blanco");
        }
        else{
            const formattedFormData=new FormData(formul);
            formattedFormData.append("crearUsu","crearUsu");
            postData(formattedFormData);
        }
    });
})

async function postData(datos){
    const resp=await fetch("gestionUsuarios.php",{
        method:"POST",
        body: datos
    });
    const data=await resp.text();

    alert(data);
}
