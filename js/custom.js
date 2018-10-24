// Core modules
var loadimg = "<img src='img/loading.gif' alt='loading' longdesc='img/loading.gif'>";
$(document).ready(function() {
    //$(".adminOnly").remove();
    var permission = returnAjax('GET', 'class/admin.class.php');
    if (permission == 0 || permission == 1) {
        $(".adminOnly").show();
        display('home.php');
    } else{
        $(".adminOnly").remove();
        $("#home").html("<a href='#'  onClick=" + "display('createcustomer.php');" + "><i class='icon-home'></i> Home</a>");
        display('reports.php');
    }
    startTime();
});

$(function() {
    $(document).bind("contextmenu", function(e) {
        e.preventDefault();
    });
});

if ('serviceWorker' in navigator) {

  navigator.serviceWorker
    .register('./service-worker.js', { scope: './' })
    .then(function(registration) {
      console.log("Service Worker Registered");
    })
    .catch(function(err) {
      console.log("Service Worker Failed to Register", err);
    })

}



// Function to perform HTTP request
var get = function(url) {
  return new Promise(function(resolve, reject) {

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var result = xhr.responseText
                result = JSON.parse(result);
                resolve(result);
            } else {
                reject(xhr);
            }
        }
    };
    
    xhr.open("GET", url, true);
    xhr.send();

  }); 
};


/*$(window).load(function() {
    sticky_relocate();
});
$(window).scroll(function() {
    sticky_relocate();
});
function closeApp(){
    window.open('', '_self', '');
}

function sticky_relocate() {
    var window_top = $(window).scrollTop();
    var div_top = $('header').height();
    if (window_top > 100) {
        $('header').addClass('top-header');
    } else {
        $('header').removeClass('top-header');
    }
}
*/
function charChk(evt, regtype) {
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    if (key == 37 || key == 39 || key == 8 || key == 46) { // Left, Right, Backspace, Delete keys
        return;
    }
    key = String.fromCharCode(key);
    var regex = '';
    if (regtype == 'num') {
        regex = /[0-9]+$/;
    } else if (regtype == 'alpha') {
        regex = /^[a-zA-Z]+$/;
    } else if (regtype == 'alphanum') {
        regex = /^[a-zA-Z0-9]+$/;
    } else if (regtype == 'email') {
        regex = /^[a-zA-Z0-9\.\@]+$/;
    } else if (regtype == 'name') {
        regex = /^[a-zA-Z\s]+$/;
    } else if (regtype == 'nr') {
        regex = /^[a-zA-Z0-9\.\-\+\s]+$/;
    } else if (regtype == 'dec') {
        regex = /^[0-9\.]+$/;
    }
    if (!regex.test(key)) {
        theEvent.preventDefault();
        if (theEvent.preventDefault) {
            theEvent.preventDefault();
        }
    }
}

function showAlert(type, text) {
   /*  $.get("alert.php",  function(data) {
       $("#alert_box").append(data);
    });*/
    
    if (type == 0) {
        $('#errorTxt').html(text + '\n');
       $('#error').show().fadeOut(5000);
    } else if (type == 1) {
        $('#successTxt').html(text + '\n');
        $('#success').show().fadeOut(5000);
    } else if (type == 2) {
        $('#warningTxt').html(text + '\n');
        $('#warning').show().fadeOut(5000);
    } else if (type == 3) {
        $('#infoTxt').html(text + '\n');
        $('#info').show().fadeOut(5000);
    }

    
}

function hideMonth(){
    var loan_type = $("#loan_type").val();
    if (loan_type==2) {
        $("#loanDurGr").hide();
    }
    else{
        $("#loanDurGr").show();
    }
}
function returnAjax(typeOpt, varRequestUrl, dataStr) { //common ajax request function                       
    return response = $.ajax({
        url: varRequestUrl,
        type: typeOpt,
        data: dataStr,
        async: false,
        success: function(result) {}
    }).responseText;

    //return response;                          
}

function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    var a = "AM";
    // add a zero in front of numbers<10
    m = checkTime(m);
    s = checkTime(s);
    if (h > 12) {
        h = h - 12;
        a = "PM";
    }
    $("#time").html(h + ":" + m + ":" + s + " " + a);
    t = setTimeout(function() {
        startTime()
    }, 500);
}


function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}

function printer() {
    var page = $("#txn_print").html();
    var printPage = window.open('print.html', '_blank', 'DFMS report');
    $("#print").html(page);
    printPage.document.write(page);
    printPage.print();
    printPage.close();
}
function save(id) {
        var page = $("#txn_print").html();
       $.get("pdf.class.php", {
        id: id,
        page:page
    }, function(data) {
        console.log(data);
    });
}

function display(url) {
    $("#data").html(loadimg);
    var result = returnAjax('GET', url);
    $("#data").html(result);
}

function searchEngine() {
    var searchkey = $("#search").val();
    display("class/search.class.php?searchkey=" + searchkey);
}

/*function cinChk() {
    var Customer_id = $("#Customer_id").val();
    if (Customer_id == '') {
        showAlert( '0', 'please enter Customer ID!');
        $("#Customer_id").focus();
        return false;
    }
    var url = 'class/getCustomers.php';
    var data = 'id=' + Customer_id;
    var result = returnAjax('GET', url, data);
    if (result == 0) {
        showAlert( '0', 'Customer not exist!');
        $("#Customer_id").focus();
        return false;
    }
}*/
function getState(city){
    if (city=='1') {
        var city = $("#hid_city").val();
    }else if(city==undefined){
        var city = $("#city").val();
    }
     $.get("class/getstate.class.php", {
        city: city
    }, function(data) {
        var data = data.split('-');
        $("#district").val(data[0]).prop('disabled', true);
        $("#state").val(data[1]).prop('disabled', true);
    });
}

function ViewResults(url) {
    var fromDate = $("#from_date").val();
    var toDate = $("#to_date").val();
    display(url + '&fromDate=' + fromDate + '&toDate=' + toDate);
}

function viewReports(url) {
    var fromDate = $("#from_date").val();
    var toDate = $("#to_date").val();
    var loan_type = $("#loan_type").val();
    display(url + '&fromDate=' + fromDate + '&toDate=' + toDate + '&loan_type=' + loan_type);
    $('#loan_type option:eq('+loan_type+')').prop('selected', true)
}


function logIn() {
    var employeename = $("#employeename").val();
    var password = $("#password").val();
    if (employeename != '' && password != '') {
        $.ajax({
            type: "POST",
            url: "class/login.class.php",
            data: {
                employeename: employeename,
                password: password
            },
            success: function(result) {
                if (result == 1) {
                    document.location.href = 'index.php';
                } else {
                    showAlert( '0', 'employee details not found tryagain!');
                    console.log(result);
                }
            },
        });
    } else {
        showAlert( '0', 'why login feilds are empty?');
    }
}
/*create employee*/
function createemployee() {
    var employeename = $("#employeename").val();
    var password = $("#password").val();
    var repassword = $("#repassword").val();
    var role = $("#role").val();
    if (employeename != '' && password != '') {
        if (password == repassword) {
            $.ajax({
                type: "POST",
                url: "class/createemployee.class.php",
                data: {
                    employeename: employeename,
                    password: password,
                    role: role
                },
                success: function(result) {
                    if (result == 0) {
                        display('class/viewemployees.class.php');
                        showAlert( '0', 'employee already exist');
                    } else {
                        display('class/viewemployees.class.php');
                        showAlert( '1', 'employee account created successfully!');
                    }
                },
            });
        } else {
            showAlert( '0', 'Password mismatch please tryagain!');
        }
    } else {
        showAlert( '0', 'Please fill all empty feilds!');
    }
}

function editemployee(employeeId) {
    $("#data").html(loadimg);
    $.get("editemployee.php", {
        employeeId: employeeId
    }, function(data) {
        $("#data").html(data);
    });
}
function updateemployee(employeeId) {
    var password = $("#password").val();
    var repassword = $("#repassword").val();
    var role = $("#role").val();
        if (password == repassword) {
            $.get("class/updateemployee.class.php", {
                employee_id: employeeId,
                password: password, 
                role:role
            }, function(data) {
                console.log(data);
                display('class/viewemployees.class.php');
                if (data=0) {
                    showAlert( '1', 'employee password and employee role updated !');
                }else{
                    showAlert( '0', 'only employee role updated!');
                }
            });
        } else {
            showAlert( '0', 'password mismatch!');
        }
}
    

function deleteemployee(employeeId) {
    var accept = confirm('Do you want to delete this entry permanently?');
    if (accept == true) {
        $.ajax({
            type: "POST",
            url: "class/deleteemployee.class.php",
            data: {
                employeeId: employeeId
            },
            success: function(result) {
                display('class/viewemployees.class.php');
                showAlert( '1', result);
            },
        });
    }
}


function createCustomer() {
    var firstname = $("#firstname").val();
    var lastname = $("#lastname").val();
    if ($('#genderM').is(':checked') == true) {
        var gender = 1;
    } else {
        var gender = 0;
    }
    var age = $("#age").val();
    var occupation = $("#occupation").val();
    var mobile = $("#mobile").val();
    var altMobile = $("#altMobile").val();
    var aadhar = $("#aadhar").val();
    var address = $("#address").val();
    var city = $("#city").val();
    var district = $("#district").val();
    var state = $("#state").val();
    if (mobile != "") {
        if (mobile.length != 10) {
            showAlert( '2', 'mobile number must be 10 characters!');
            return false;
        }
    }
    if (firstname != "" && age != "") {
        $.ajax({
            type: "POST",
            url: "class/createcustomer.class.php",
            data: {
                firstname: firstname,
                lastname: lastname,
                age: age,
                gender: gender,
                occupation: occupation,
                mobile: mobile,
                altMobile: altMobile,
                aadhar: aadhar,
                city:city,
                district:district,
                state:state,
                address: address
            },
            success: function(result) {
                if (result == 0) {
                    display('createcustomer.php');
                    showAlert( '0', 'customer already exist');
                } else {
                    display('class/viewcustomers.class.php');
                    showAlert( '1', 'employee account created successfully!');
                }
            },
        });
    } else {
        showAlert( '2', 'Please fill all empty feilds!');
    }
}

function editCustomer(cin) {
    $("#data").html(loadimg);
        $.ajax({
            type: "GET",
            url: "editcustomer.php",
            data: {
                cin: cin
            },
            success: function(data) {
                $("#data").html(data);
            },
        });
}

function updateCustomer(cin) {
    var firstname = $("#firstname").val();
    var lastname = $("#lastname").val();
    if ($('#genderM').is(':checked') == true) {
        var gender = 1;
    } else {
        var gender = 0;
    }
    var age = $("#age").val();
    var occupation = $("#occupation").val();
    var mobile = $("#mobile").val();
    var altMobile = $("#altMobile").val();
    var aadhar = $("#aadhar").val();
    var city = $("#city").val();
    var district = $("#district").val();
    var state = $("#state").val();
    var address = $("#address").val();
    if (mobile != "") {
        if (mobile.length != 10) {
            showAlert( '0', 'mobile number must be 10 characters!');
            return false;
        }
    }
    if (firstname != "" && age != "") {
        $.ajax({
            type: "POST",
            url: "class/updatecustomer.class.php",
            data: {
                firstname: firstname,
                lastname: lastname,
                age: age,
                gender: gender,
                occupation: occupation,
                mobile: mobile,
                altMobile: altMobile,
                aadhar: aadhar,
                city:city,
                district:district,
                state:state,
                address: address,
                cin: cin
            },
            success: function(result) {
                    console.log(result);
                    display('class/viewcustomers.class.php');
                    showAlert( '1', 'employee account update successfully!');
            },
        });
    } else {
        showAlert( '0', 'Please fill all empty feilds!');
    }
}

function deleteCustomer(cin) {
    var accept = confirm('if you delete this customer all the loan accounts associated with this cutomer also deleted, it can not be undone Do you want to delete this entry permanently?');
    if (accept == true) {
        $.ajax({
            type: "POST",
            url: "class/deletecustomer.class.php",
            data: {
                cin: cin
            },
            success: function(result) {
                display('class/viewcustomers.class.php');
                showAlert( '1', result);
            },
        });
    }
}


function showAccount(cin) {
    $("#data").html(loadimg);
    $.get("createaccount.php", function (data) {
        $("#data").html(data);
        $("#cin").val(cin);
    });
}


function createAccount() {
    var loan_type = $("#loan_type").val();
    var cin = $("#cin").val();
    var loan_amount = $("#loan_amount").val();
    var loan_duration = $("#loan_duration").val();
    var emi_start_date = $("#emi_start_date").val();
    var roi = $("#roi").val();
    var guarantor = $("#guarantor").val();
    var commission = $("#commission").val();
    if (cin == "0") {
        showAlert( '2', 'Please select customer name');
        return false;
    }
    if (loan_amount == "") {
        showAlert( '2', 'please enter loan amount');
        return false;
    }
    if (loan_duration == "" && loan_type!=2) {
        showAlert( '2', 'please enter loan duration');
        return false;
    }
    if (roi == "") {
        showAlert( '2', 'please enter rate of interest');
        return false;
    }
    $.ajax({
            type: "POST",
            url: "class/createaccount.class.php",
            data: {
                cin:cin,
                loan_type: loan_type,
                loan_amount: loan_amount,
                loan_duration: loan_duration,
                emi_start_date:emi_start_date,
                roi: roi,
                guarantor: guarantor,
                commission: commission
            },
            success: function(result) {
                console.log(result);
                display('class/viewaccounts.class.php');
                showAlert( '1', 'Loan Account created!');
            },
        });
}


function editAccount(cin, loan_id) {
    $("#data").html(loadimg);
    $.get("editaccount.php", {
        cin:cin,
        loan_id: loan_id
    }, function(data) {
        $("#data").html(data);
        var temp_loan_type = $("#temp_loan_type").val();
        $("#loan_type").val(temp_loan_type);
    });
}

function updateAccount(loan_id) {
    var loan_type = $("#loan_type").val();
    var cin = $("#cin").val();
    var loan_amount = $("#loan_amount").val();
    var loan_duration = $("#loan_duration").val();
    var emi_start_date = $("#emi_start_date").val();
    var roi = $("#roi").val();
    var guarantor = $("#guarantor").val();
    var commission = $("#commission").val();
    if (cin == "0") {
        showAlert( '2', 'Please select customer name');
        return false;
    }
    if (loan_amount == "") {
        showAlert( '2', 'please enter loan amount');
        return false;
    }
    if (loan_duration == "") {
        showAlert( '2', 'please enter loan duration');
        return false;
    }
    if (roi == "") {
        showAlert( '2', 'please enter rate of interest');
        return false;
    }
    $.ajax({
            type: "POST",
            url: "class/updateaccount.class.php",
            data: {
                loan_id:loan_id,
                cin:cin,
                loan_type: loan_type,
                loan_amount: loan_amount,
                loan_duration: loan_duration,
                emi_start_date:emi_start_date,
                roi: roi,
                guarantor: guarantor,
                commission: commission
            },
            success: function(result) {
                display('class/viewaccounts.class.php');
                showAlert( '1', 'Account has been updated successfully!');
            },
        });
}

function deleteAccount(loan_id) {
    var accept = confirm('Do you want to delete this entry permanently?');
    if (accept == true) {
        $.ajax({
            type: "POST",
            url: "class/deleteaccount.class.php",
            data: {
                loan_id: loan_id
            },
            success: function(result) {
                    display('class/viewaccounts.class.php');
                    showAlert( '1', result);
            },
        });
    }
}

function transactions(loan_id) {
    $("#data").html(loadimg);
    $.get("class/transactions.class.php", {
        loan_id: loan_id
    }, function(data) {
        $("#data").html(data);
    });
}

function showEMI(loan_id) {
    var loan_type = $("#loan_type").val();
    var cin = $("#cin option:selected").text();
    var cin = cin.split('-');
    var loan_amount = $("#loan_amount").val();
    var loan_duration = $("#loan_duration").val();
    var roi = $("#roi").val();
    var guarantor = $("#guarantor").val();
    var commission = $("#commission").val();
    var paid = "0";
    var emi = 0;
    if (loan_type == '0') {
        $("#show_loanType").html('Daily Finance');
    } else if (loan_type == '1') {
        $("#show_loanType").html('Weekly Finance');
    } else {
        $("#show_loanType").html('Monthly Finance');
    }
    if (cin[1] != '') {
        $("#show_cin").html(cin[0]);
    }
    if (loan_duration != '') {
        $("#show_loanDuration").html(loan_duration);
    }
    if (loan_amount != '') {
        $("#show_loanAmount").html(loan_amount);
    }
    if (loan_amount != '' && loan_duration != '') {
        var emi= loan_amount/loan_duration;
        var emi=Math.ceil(emi);
            $("#emi").html(emi);
    }
    if (loan_amount != '' && paid != '') {
        var pending = loan_amount-paid;
        $("#pending").html(pending);
    }
    if (roi != '') {
        $("#show_roi").html(roi + '%');
        var toPay = (loan_amount) - (loan_amount * (roi / 100));
        $("#show_payAmount").html(toPay);
    }
    $.ajax({
        type: "POST",
        url: "class/transactions.class.php",
        data: {
            loan_duration: loan_duration,
            loan_type: loan_type
        },
        success: function(result) {
            $("#transactions").html(result);
        },
    });
}

/*function addTransaction(id, loan_id)
{
  
    if (loan_id==undefined) 
        {
            var loan_id='';
        }
    var transaction_amount = $("#"+id).val();
            $.ajax({
                type: "POST",
                url: "class/createtransaction.class.php",
                data: {
                    date: id,
                    loan_id: loan_id,
                    transaction_amount:transaction_amount
                },
                success: function(result) {
                        console.log(result);
                        //display('class/viewaccounts.class.php');
                        showAlert( '1', 'transaction updated successfully');
                },
            });
            
}*/

function updateTransaction(id){

    var transaction_amount = $("#"+id).val();
    if (transaction_amount!='') {
                $.ajax({
                type: "POST",
                url: "class/updatetransaction.class.php",
                data: {
                    txn_id: id,
                    transaction_amount:transaction_amount
                },
                success: function(result) {
                        showAlert( '1', 'transaction updated successfully');
                },
            });
        }
        
}

function reportTransaction(id){
    updateTransaction(id);
    display('reports.php');
        
}



        
