//llamada  a función que se encuentra en la librería /lib/jsfunctionality.js
let statusCookie = getCookie("status");
console.log(statusCookie);
//encontramos el p con la id necesaria
 let statusText = document.querySelector("#statustext");
 

 if(statusCookie == "active"){
    statusText.innerHTML = " <span style='color: green;'>"+statusCookie+"</span>";
 }else if (statusCookie == "innactive"){
    statusText.innerHTML = " <span style='color: red;'>"+statusCookie+"</span>";
 }