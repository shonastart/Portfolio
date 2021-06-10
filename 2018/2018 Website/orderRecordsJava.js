//Shona Start w17019752
//Task 4 - Select record(s) page

//when page loads
window.addEventListener('load', function(){
    'use strict';

    //Part E
    var customerInput = 0; //Part C - declares value used for checking if the user has entered forename, surname and company name
    var trade = "false"; //declares whether trade is selected on the drop down
    var cus = "false";
    var customerType = document.querySelector("select[name=customerType]"); //declares drop down
    customerType.addEventListener('click', function () {checkDropdown()});
    var customerTypeSelect = "false"; //declares whether an option has been selected on the drop down
    const companyBox = document.getElementById("tradeCustDetails");
    const nameBoxs = document.getElementById("retCustDetails");

    //function for determining whether user has chosen customer or trade in the drop down
    function checkDropdown() {
        if (customerType.value == 'ret') {
            customerTypeSelect = "true";
            companyBox.style.visibility = "hidden";
            nameBoxs.style.visibility = "visible";
            trade = "false";
            cus = "true";

        }
        else if (customerType.value == 'trd') {
            customerTypeSelect = "true";
            companyBox.style.visibility = "visible";
            nameBoxs.style.visibility = "hidden";
            trade = "true";
            cus = "false";
        }
        else {
            companyBox.style.visibility = "hidden";
            nameBoxs.style.visibility = "visible";
        }
    }

    //Part A + B
    const checkBox = document.querySelector('input[type=checkbox][name=termsChkbx]'); //declares checkbox to agree to terms and conditions
    checkBox.addEventListener('click', function () {checkForUserInput()});
    const submitButton = document.querySelector('input[type=submit][name=submit]'); //declares submit button
    const terText = document.getElementById("termsText"); //declares text for the terms and conditions checkbox
    var ItemSelected = "false"; //Part D - declares whether checkbox's inside of selectRecords section have been selected or not

    //function for enabling 'order now' button if user has provided all required information
    function checkForUserInput() {
        if (ItemSelected == "true") {
            if (customerTypeSelect == "true") {
                tAndcEnabled();
                customerType.disabled = true;
                checkNames();
                if (cus == "true" && customerInput == 2){
                    tAndcEnabled();
                }
                else if (trade == "true" && customerInput == 1){
                    tAndcEnabled();
                }
            }
            else if (customerTypeSelect == "false") {
                tAndcDisabled();
                alert("Please choose a Customer Type before agreeing");
            }
        }
        else if (ItemSelected == "false"){
            tAndcDisabled();
            alert("Please select record(s) before agreeing");
        }
    }

    //Part C
    //function for checking the user has entered forename, surname and company name
    function checkNames() {
        var forename = document.querySelector('input[type=text][name=forename]'); //declares forename text box
        var surname = document.querySelector('input[type=text][name=surname]'); //declares surname text box
        var companyName = document.querySelector('input[type=text][name=companyName]'); //declares company name text box
        if (cus == "true"){
            if (forename.value != "") {
                customerInput++;
                forename.readOnly = true;
            }
            else {
                tAndcDisabled();
                alert("Please enter a forename before agreeing");
            }
            if (surname.value != "") {
                customerInput++;
                surname.readOnly = true;
            }
            else {
                tAndcDisabled();
                alert("Please enter a surname before agreeing");
            }
        }
        else if (trade == "true"){
            if (companyName.value != "") {
                customerInput++;
            }
            else {
                tAndcDisabled();
                alert("Please enter a company name before agreeing");
            }
        }
    }

    //Part D - CALCULATE RUNNING TOTAL
    var total = document.querySelector('input[type=text][name=total]'); //declares box displaying total price
    const selectRecords = document.getElementById('selectRecords'); //declares selectRecords section
    const itemList = selectRecords.querySelectorAll('div.item'); //declares individual divs named 'item' inside of selectRecords section
    const recordBox = document.querySelectorAll('input[type=checkbox][data-price]'); // declares checkbox's inside of selectRecords section
    const collection = document.getElementById('collection'); //declares collection section
    const shop = collection.querySelector('input[type=radio][value=trade]'); //declares button for "Collect from shop"
    const home = collection.querySelector('input[type=radio][value=home]'); //declares button for delivery

    recordBox.checked =  addEventListener('click', function() {
        if (shop.checked) {
            totalShop();
        }
        else if (home.checked) {
            totalHome();
        }
    });

    //function for if user selects "Collect from shop"
    function totalShop(){

        var price = 0; //declares price as 0
        total.value=''; //sets value of box to empty
        for (let i=0; i < itemList.length; i++){ //generates loop of all divs named 'item' inside of selectRecords section
            if (recordBox[i].checked == true){ //if checkbox(s) selected
                price = price+parseFloat(recordBox[i].dataset.price);
            }
        }
        total.value = price.toFixed(2); //change value of total
        if (price <= 0){
            ItemSelected = "false"; //declares that no checkbox's inside of selectRecords section have been selected
        }
        else if (price > 0){
            ItemSelected = "true"; //declares that checkbox's inside of selectRecords section have been selected
        }
    }

    //function for if user selects delivery
    function totalHome(){
        const deliveryCost = 5.99; //declares additional value for delivery
        var price = 0;
        total.value=''; //sets value of box to empty
        for (let  i=0; i < itemList.length; i++){
            if (recordBox[i].checked == true){
                price = price+parseFloat(recordBox[i].dataset.price);
            }
        }
        var fullPrice = price + deliveryCost;
        total.value = fullPrice.toFixed(2);
        if (price <= deliveryCost){
            ItemSelected = "false";
        }
        else if (price > deliveryCost){
            ItemSelected = "true";
        }
    }

    //function for disabling submitButton
    function tAndcDisabled(){
        submitButton.disabled = true;
        terText.style.color = "#FF0000";
        terText.style.fontWeight = "bold";
        checkBox.checked = false;
    }

    //function for enabling submitButton
    function tAndcEnabled(){
        submitButton.disabled = false;
        terText.style.color = "black";
        terText.style.fontWeight = "normal";
    }

});

