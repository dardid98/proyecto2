window.addEventListener("load", ()=>{
    var formul=document.getElementById("formul");
    var submit=document.getElementById("crear");

    submit.addEventListener("click", function(event){
        event.preventDefault();
        const formattedFormData=new FormData(formul);
        formattedFormData.append("crear","crear");
        console.log(formattedFormData);
        postData(formattedFormData);
    })
});

async function postData(formattedFormData){
    const resp=await fetch("CrearRutina.php", {
        method: "POST",
        body: formattedFormData
    });
    const data=await resp.text();

    alert(data);
    if(data=="no"){
        window.location.href="index.php";
    }
    window.location.href="MenuEntrenador.html";
    

}
