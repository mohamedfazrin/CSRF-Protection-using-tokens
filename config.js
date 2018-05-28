

var csrf_token;

//use this finction to retrive the response values coming form server side
function loadDOC(method,url,htmlTag)
{
    var xhttp = new XMLHttpRequest(); //create variable for store HTTP requests
    xhttp.onreadystatechange = function() //excute when recive an answer from server side
    {
        if(this.readyState==4 && this.status==200)
        {
            console.log("CSRF token scuessfully fetched : "+this.responseText);
            document.getElementById(htmlTag).value = this.responseText;
            //return this.responseText; //return response
            
            
        }
    };

    xhttp.open(method,url,true);
    xhttp.send();
}

