window.addEventListener("load", function(){

    const formul=document.getElementById("formul");
    const subm=document.getElementById("login");
    const reg=document.getElementById("registro");
    //const rec=document.getElementById("recuperar");
    var email;
    var passwd;
    //alert(formul);
    
    
    /*rec.addEventListener("click", function(event){
        event.preventDefault();
        window.location.href="recuperar/recuperar.html";
    })*/
    
    reg.addEventListener("click",function(event){
        event.preventDefault();
        window.location.href="registro.html";
    })
    
    formul.addEventListener("submit", function(event){
        email=document.getElementById("email").value;
        passwd==document.getElementById("passwd").value;
        //alert(email);
        if(email==""||passwd==""){
            alert("No dejes los campos en blanco");
        }else{
            event.preventDefault();
            const formattedFormData=new FormData(formul);
            formattedFormData.append("login", "login");
            postData(formattedFormData);
        }

    });
});

async function postData(formattedFormData){
    const resp=await fetch("login.php", {
        method: "POST",
        body: formattedFormData
    });
    const data=await resp.text();

    if(data=="usergim"){
        window.location.href="MenuGimnasio.php";
    }else if(data=="usermon"){
        window.location.href="MenuEntrenador.html";
    }else if(data=="useradm"){
        window.location.href="MenuAdmin.php";
    }else{
        alert(data);
    }
}
