//breadcrumbs jss
let getphpCookie = getCookie("location");
let breadcrumbbox = document.querySelector("#breadcrumb");
let string = "<p>"+getphpCookie+"</p>";

breadcrumbbox.innerHTML = string;
