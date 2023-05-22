window.addEventListener("load", ()=>{
    comprobarDatos();
    

})

async function comprobarDatos(){
    const resp=await fetch("comprobarSesionhtml.php", {
        method:"POST"

    });
    const data= await resp.text();
    if(data != "bien"){
        alert("No deberías estar aquí");
        alert(data);
        window.location.href="index.php";
    }
}
