//Shona Start w17019752
//Task 4 - C

const requestXML = 'getOffers.php?useXML';

//when page loads
window.addEventListener('load', function(){
    'use strict';
    getRequestXML(requestXML, updateXML);
    let theTimer = setInterval(timerXML, 5000); //defines timer that calls timer function

    //function to refresh the content
    function timerXML(){
        getRequestXML(requestXML, updateXML);
    }
});

//function for if the request doesn't succeed
function getRequestXML( url, callback ) {
    'use strict';
    const httpRequest = new XMLHttpRequest();
    httpRequest.onreadystatechange =  function () {
        let completed = 4, successful = 200;
        if (httpRequest.readyState == completed){
            if (httpRequest.status == successful){
                callback(httpRequest.responseText);
            }
            else {
                alert('There was an Error, Please retry');
            }
        }
    };
    httpRequest.open('get', url, true);
    httpRequest.send(null);
}

//function to displays relevant information on page
function updateXML( text ) {
    'use strict';
    var parse =  new DOMParser(); //parsing from the server
    var xmlDoc = parse.parseFromString(text, "text/xml"); //parsing is in XML format
    var recordTitle = xmlDoc.getElementsByTagName("recordTitle")[0].innerHTML;
    var catDesc = xmlDoc.getElementsByTagName("catDesc")[0].innerHTML;
    var recordPrice = xmlDoc.getElementsByTagName("recordPrice")[0].innerHTML;
    XMLoffers.innerHTML = "<p>&quot;" + recordTitle +"&quot;<br/>Category: " + catDesc +"<br/>Price: " + recordPrice +"</p>";
}