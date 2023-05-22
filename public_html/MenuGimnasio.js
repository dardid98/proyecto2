window.addEventListener("load", ()=>{
    //alert("ciao");

    
    var cadena=new Array();
    const registro=new FormData();
    registro.append("mostrar", "mostrar");

    cadena=recibirDatos(registro);
    //console.log(cadena.PromiseResult);
    
    //mostrarCalendario(actual.getFullYear(), actual.getMonth()+1, cadena);

    
    
})

async function recibirDatos(datos){
    var actual=new Date();

    const resp=await fetch("MenuGimnasio.php", {
        method: "POST",
        body: datos
    }).then(resp=>resp.json())
    .then(data => mens=data);
    //console.log(mens);
    mostrarCalendario(actual.getFullYear(), actual.getMonth()+1, mens);
    //data=await resp.text().then(mens=JSON.parse(data)).catch(console.log(mens));
    
    /*mens.foreach(element=>{
        console.log(element.COMPLETADA);
    })*/
    return mens;//.PromiseResult.FECHA_COMPLETA;
    //console.log(mens);
}

async function mostrarCalendario(year,month,cadena)
    {
        var actual=new Date();

        var fechasCompl=new Array();
        //dias=
        //console.log(cadena);
        cadena.forEach(element=> {
            
            Date.parse(element);
            var date=new Date(element.FECHA_COMPLETADA);

            fechasCompl.push(date);
            
        })
        //console.log(fechasCompl);
    
        var now=new Date(year,month-1,1);
        var last=new Date(year,month,0);
        var primerDiaSemana=(now.getDay()==0)?7:now.getDay();
        var ultimoDiaMes=last.getDate();
        var dia=0;
        var resultado="<tr>";
        var diaActual=0;
        //console.log(ultimoDiaMes);
        var datosTabla=new Array();
        var last_cell=primerDiaSemana+ultimoDiaMes;
        //var ejer=false;
     
        // hacemos un bucle hasta 42, que es el máximo de valores que puede
        // haber... 6 columnas de 7 dias
        for(var i=1;i<=42;i++)
        {
            if(i==primerDiaSemana)
            {
                // determinamos en que dia empieza
                dia=1;
            }
            if(i<primerDiaSemana || i>=last_cell)
            {
                // celda vacia
                resultado+="<td>&nbsp;</td>";
            }else{
                // mostramos el dia
                var egresion=(compruebaDia(dia, month, year, fechasCompl));
                console.log((await egresion));
                if(dia==actual.getDate() && month==actual.getMonth()+1 && year==actual.getFullYear() && !await egresion) {
                    console.log(egresion);
                    resultado+="<td class='hoy'>"+dia+"</td>";
                }
                else if(dia==actual.getDate() && month==actual.getMonth()+1 && year==actual.getFullYear() && await egresion){
                    resultado+="<td class='hoysi'>"+dia+"</td>"
                }
                else if(dia!=actual.getDate() && await egresion){
                    resultado+="<td class='si'>"+dia+"</td>";
                }
                else{
                    resultado+="<td>"+dia+"</td>";
                }
            }
                dia++;
            
            if(i%7==0)
            {
                if(dia>ultimoDiaMes)
                    break;
                resultado+="</tr><tr>\n";
            }
        }
        resultado+="</tr>";
        //alert(resultado);
        var meses=Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
     
        // Calculamos el siguiente mes y año
        nextMonth=month+1;
        nextYear=year;
        if(month+1>12)
        {
            nextMonth=1;
            nextYear=year+1;
        }
     
        // Calculamos el anterior mes y año
        prevMonth=month-1;
        prevYear=year;
        if(month-1<1){
            prevMonth=12;
            prevYear=year-1;
        }
        var formul=document.getElementById("form2");
        /*var h2=document.createElement("h2");
        var h3=document.createElement("button");
        var h4=document.createElement("button");
        h2.textContent=meses[month-1]+" / "+year;
        h2.setAttribute("class","calend");
        
        formul.prepend(h2);
        h3.innerText="<"+prevYear+","+prevMonth;
        h3.setAttribute("id", "prevMes");

        h4.innerText=nextYear+","+nextMonth+">";
        h4.setAttribute("id", "sigMes");

        formul.appendChild(h3);
        formul.appendChild(h4);
*/
        document.getElementById("calendar").getElementsByTagName("tbody")[0].innerHTML=resultado;
    }

    async function compruebaDia(dia, mes, anyo, fechas){
        
        var cont=0;
        for(var x=0; x<fechas.length; x++){
            
            if(dia==fechas[x].getDate() && mes==fechas[x].getMonth()+1 && anyo==fechas[x].getFullYear()){
                cont++;
            }  
        }
        if(cont>0){
            return true;
        }else{
            return false;
        }
    }


/*await window.addEventListener("load", ()=>{

    var boton1=document.getElementById("prevMes");
    var boton2=document.getElementById("sigMes");
    
    boton1.addEventListener("clic", (event)=>{
        event.preventDefault();
        alert("hola");
    });
});*/