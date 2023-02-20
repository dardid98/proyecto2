


window.onload=function(){
    const formFile=document.getElementById("form_archivo_js");
    const btnSendFile=document.getElementById("btnSendFile");
    btnSendFile.addEventListener("click", function(event){
        event.preventDefault();

        const formattedFormData=new FormData(formFile);
        postData(formattedFormData);

    });
}

async function postData(formattedFormData){
    const response=await fetch("backend.php", {
        method: "POST",
        body: formattedFormData
    });
    const data= await response.text();

    alert(data);
}

