let getDiv = document.querySelector("#err");
getDiv.style.display="none";
console.log(getDiv);
let result = getCookie("result");
console.log(result);
if(result == "true"){
    getDiv.style.display="flex";
    getDiv.style.backgroundColor ="green";
    getDiv.innerHTML = "<p>Acción ejecutada con exito!</p>";
}else if(result == "false"){
    getDiv.style.display="flex";
    getDiv.style.backgroundColor ="red";
    getDiv.innerHTML = "<p>Algo no ha funcionado, comprueba los datos</p>";
}