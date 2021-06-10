//Shona Start w17019752
//Task 4 - A + B

const request = "getOffers.php";

//when page loads
window.addEventListener('load',function() {
    'use strict';
    getRequest(request, target);
    let theTimer = setInterval(timer, 5000); //defines timer that calls timer function

    //function to refresh the content
    function timer(){
        getRequest(request, target);
    }
});

//function for if the request doesn't succeed
function getRequest( url, callback ) {
    'use strict';
    const httpRequest = new XMLHttpRequest();
    httpRequest.onreadystatechange = function() {
        let completed = 4, successful = 200;
        if (httpRequest.readyState == completed) {
            if (httpRequest.status == successful) {
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
function target( text ) {
    'use strict';
    offers.innerHTML = text;
}
