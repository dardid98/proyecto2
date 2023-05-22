window.addEventListener("load", ()=>{

    var subm=document.getElementById("restablecer");
    var form=document.getElementById("formul");
    
    
    form.addEventListener("submit", (event)=>{
        event.preventDefault();
        var email=document.getElementById("c").value;
        event.preventDefault();
        var formattedFormData=new FormData;
        formattedFormData.append("email",email);
        formattedFormData.append("restablecer","restablecer");
        console.log(formattedFormData);
        postData(formattedFormData, email);
    })



});
async function postData(formattedFormData,email){
    const resp=await fetch("recuperar.php", {
        method: "POST",
        body: formattedFormData
    });
    const data=await resp.json();
    if(data=="si"){
        var datos=new FormData;
        datos.append("email", email);
        datos.append("enviar","enviar");
        enviar(datos);
    }
    else if(data=="no"){
        alert("El Email no está registrado en nuestra base de datos");
    }else{
        console.log(data);
        alert(data);
    }
}

async function enviar(formattedFormData){
    const resp=await fetch("recuperar.php", {
        method: "POST",
        body: formattedFormData
    });
    const data=await resp.text();
    alert(data);
}