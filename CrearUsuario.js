window.addEventListener("load", ()=>{
    //Me guardo el formulario y los 2 divs que contendrán los elementos que voy a meter por dom, el submit para ponerle el prevent default y el campo select, para meterle un evento cada vez
    //que cambiamos de una opción a otra de las disponibles.
    var formul=document.getElementById("formul");
    var submit=document.getElementById("crear");
    //var br=document.createElement("br");

    //

    
    //Creo un array con los nombres de los campos de la base de datos.
    var elementosEnt=new Array("email","contr");


    for(var s=0; s<elementosEnt.length; s++){

        let input=document.createElement("input");
        let label=document.createElement("label");
        let br=document.createElement("br");

        input.setAttribute("type","text");
        input.setAttribute("id",elementosEnt[s]);
        input.setAttribute("name",elementosEnt[s]);

        label.setAttribute("for",elementosEnt[s]);
        label.innerText=elementosEnt[s]+": ";
        
        formul.append(label, input,br);
    }

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
