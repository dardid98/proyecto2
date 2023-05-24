window.addEventListener("load",()=>{

    //var submEnt=document.getElementById("delEnt");
    var submUsu=document.getElementById("delUsu");
    var submAct=document.getElementById("Activar");
    var submDes=document.getElementById("Desactivar");
    //var submModEnt=document.getElementById("modEnt");
    
    submUsu.addEventListener("click", (event)=>{
        event.preventDefault();
        const js = document.querySelectorAll('input[name="id"]:checked');
        let inputs=[];
        js.forEach(element => {
            inputs.push(element.value);
        });
        var consDatos=new FormData;
        inputs.forEach(element => {
            consDatos.append(element,element);
        });
        consDatos.append("delUsu", "delUsu");
        postData(consDatos);
        
    })
    
    submAct.addEventListener("click", (event)=>{
        event.preventDefault();
        const js = document.querySelectorAll('input[name="id"]:checked');
        let inputs=[];
        js.forEach(element => {
            inputs.push(element.value);
        });
        var consDatos=new FormData;
        inputs.forEach(element => {
            consDatos.append(element,element);
        });
        consDatos.append("Activar", "Activar");
        postData(consDatos);
        
    })
    submDes.addEventListener("click", (event)=>{
        event.preventDefault();
        const js = document.querySelectorAll('input[name="id"]:checked');
        let inputs=[];
        js.forEach(element => {
            inputs.push(element.value);
        });
        var consDatos=new FormData;
        inputs.forEach(element => {
            consDatos.append(element,element);
        });
        consDatos.append("Desactivar", "Desactivar");
        postData(consDatos);
        
    })

});

async function postData(formattedFormData){
    const resp=await fetch("gestionUsuarios.php", {
        method: "POST",
        body: formattedFormData
    });
    const data=await resp.text();
    //alert(data);
    window.location.href="MenuAdmin.php";
}