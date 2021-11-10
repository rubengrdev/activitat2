 //date js
 let user = getCookie("getUser");
 let sessionStatus = getCookie("status");

   if(sessionStatus == "active"){
    let p = document.querySelector("#time");
    let string = "Visited: " + getCookie("getDate");
    p.innerHTML = string;
   }