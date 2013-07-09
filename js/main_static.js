$(document).ready(function(){
    if(window.location.pathname == '/'){
        //update counters
        initCounters();
        setInterval(updateCounters, 2000);
    }
    $('.by_zopim widget_ui icon_zopim').remove();

    $('input[name="btnCreateMyAccount"]').click(function(){
        var $email = $('#emailInput');
        var $emailError = $('#emailError');
        var email = $email.val();
        var name = $('#txtName').val();
        var errorMessage = '';
        if(!verifyEmail(email)){
            errorMessage = "Invalid email format.";
            $emailError.text(errorMessage).css('visibility', 'visible');
            $email.addClass('error2');
            return false;
        }
        else if(!$('#Read').is(':checked')) {
            errorMessage = "Please agree to terms";
            $emailError.text(errorMessage).css('visibility', 'visible');
            $email.addClass('error2');
            return false;
        }
        else{
            $emailError.css('visibility', 'hidden');
            $email.removeClass('error2');
        }
        checkEmail(email, name, function(data){
            window.location = data.redirect;
        });
    });
});
function navToProcess(){
    console.log(window.location.pathname);
    if (window.location.pathname == '/') {
        $('#process').click();
        $('#tab2').click(function () {
            var jump = $(this).attr('href');
            var new_position = $('#' + jump).offset();
            window.scrollTo(new_position.left, new_position.top);
            return false;
        });
    }
    else {
        window.location = '/#tab2'
    }
}
function navToDifference() {
    if (window.location.pathname == '/') {
        $('#difference').click();
        $('#tab1').click(function () {
            var jump = $(this).attr('href');
            var new_position = $('#' + jump).offset();
            window.scrollTo(new_position.left, new_position.top);
            return false;
        });
    }
    else {
        window.location = '/#tab1'
    }
}
function navToPrice() {
    if (window.location.pathname == '/') {
        $('#price').click();
        $('#tab3').click(function () {
            var jump = $(this).attr('href');
            var new_position = $('#' + jump).offset();
            window.scrollTo(new_position.left, new_position.top);
            return false;
        });
    }
    else {
        window.location = '/#tab3'
    }
}
function navToOversight() {
    if (window.location.pathname == '/') {
        $('#oversight').click();
        $('#tab4').click(function () {
            var jump = $(this).attr('href');
            var new_position = $('#' + jump).offset();
            window.scrollTo(new_position.left, new_position.top);
            return false;
        });
    }
    else {
        window.location = '/#tab4'
    }
}
function navToExamples() {
    if (window.location.pathname == '/') {
        $('#examples').click();
        $('#tab5').click(function () {
            var jump = $(this).attr('href');
            var new_position = $('#' + jump).offset();
            window.scrollTo(new_position.left, new_position.top);
            return false;
        });
    }
    else {
        window.location = '/#tab5'
    }
}
function navToTeam() {
    if(window.location.pathname == '/') {
        $('#team').click();
        $('#tab6').click(function () {
            var jump = $(this).attr('href');
            var new_position = $('#' + jump).offset();
            window.scrollTo(new_position.left, new_position.top);
            return false;
        });
    }
    else {
        window.location = '/#tab6'
    }
}
function verifyEmail(email){
    if(email == '' || email == null){
        return false;
    }
    var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
    if(email.search(emailRegEx) == -1) {
        return false;
    }
    return true;
}

function checkEmail(email, name, callback){
    var $email = $('#emailInput');
    var $emailError = $('#emailError');
    var errorMessage = '';
    $.ajax({
        url: 'ajax/check_email',
        type: 'POST',
        cache: false,
        dataType: 'json',
        data: {email: email, name: name},
        success: function(response){
            if(response.status == 200){
                $email.removeClass('error2');
                $emailError.css('visibility', 'hidden');
                if(callback && typeof callback == "function"){
                    callback(response.data);
                }
            }
            else{
                errorMessage = response.reason;
                $emailError.text(errorMessage).css('visibility', 'visible');
                $email.addClass('error2');
            }
        }
    });
}

function closeModal(){
    $.modal.close();
}

function initCounters(){
    $.ajax({
        url: 'ajax/get_counters/',
        type: 'get',
        dataType: 'json',
        async: false,
        success: function(response){
            if(response.status == 200){
                $('.pr-co-like').text(response.data.likes);
                $('.pr-co-letter').text(response.data.messages);
                $('.pr-co-twitter').text(response.data.twits);
            }
        }
    });
}

function updateCounters(){
    var counter = Math.floor(Math.random() * 3) + 1;
    var $selector;
    switch(counter){
        case 1:
            $selector = $('.pr-co-like');
            break;
        case 2:
            $selector = $('.pr-co-letter');
            break;
        case 3:
            $selector = $('.pr-co-twitter');
            break;
    }
    var value = $selector.text().replace(",", "");
    value = parseFloat(value.replace(",", ""));
    value += Math.floor(Math.random() * 2) + 1;
    $selector.text(numberFormat(value));
}

function numberFormat(number){
    return number.toFixed(0).replace(/./g, function(c, i, a) {
        return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
    });
}