
//cookie enabled js
let cookieStatus = getCookie("cookiesEnabled");
console.log(cookieStatus);

let adviseDiv = document.querySelector('.alertcookies');

if(cookieStatus != "true"){
    adviseDiv.innerHTML = '<form action="?url=cookie" method="post"><div class="aligninput"><p>Dear sir, you must accept our cookie policy</p></div><div class="submit-button"><input type="submit" value="Accept" name="option" class="submit"><input type="submit" value="Decline" name="option" class="submit"> </div></form>';                                 
}
            
                                    
                                    
                                
