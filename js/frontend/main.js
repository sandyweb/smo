$(document).ready(function(){

    $('#accounts').dataTable({
        iDisplayLength: 20,
        bFilter: false,
        bInfo: false,
        bLengthChange: false,
        bPaginate: false
    });
    $('.order-list-table').dataTable();

    $('#add_account').click(function () {
        var account_type = $(this).attr('data-account-type');
        $.ajax({
            url: location.protocol + "//" + location.host + "/accounts/get",
            type: "GET",
            data: {account_type_id: account_type},
            dataType: "HTML",
            success: function(data) {
                $("#actions").empty();
                $("#actions").append(data);
                $("#actions").show();
                getAccountTypeView($('input[name="account_type"]:checked').val());
            }
        });
    });

    var $content_wrapper = $('.content_wrapper');
    $content_wrapper.on('change', 'input[name="account_type"]', function(){
        $('.account-price').text('$' + convertCentsDollars(0));
        $('input[name="price"]').val(0);
        //get account type view
        getAccountTypeView($(this).val());
    });
});

function shakeLogin() {
    setTimeout(function () {
        $('.login_wrapper').effect("shake", { distance: 10, times: 1 }, 250);
    }, 100);
}

/**
 * Function convert cents to dollars and
 * return string in 0.00 format
 * @param value
 * @return string
 */
function convertCentsDollars(value){
    var converted = value/100;
    var dollar = new String(converted);
    var tmp = dollar.split('.');
    if(!tmp[1])
        dollar += '.00';
    else if(tmp[1].length < 2)
        dollar += '0';
    else if(tmp[1].length > 2)
        dollar = tmp[0]+'.'+tmp[1].substr(0, 2);
    return dollar;
}

/**
 * Function convert dollars to cents
 *
 * @param value
 * @return {int}
 */
function covertDollars2Cents(value){
    value = value.replace('.', '');
    value = value.replace('$', '');
    return value * 1;
}

function getAccountTypeView(accountTypeId){
    $.ajax({
        url: 'ajax/account_type_view/',
        type: 'post',
        dataType: 'html',
        data: {account_type_id: accountTypeId},
        success: function(response){
            $('.account-type-view').html(response);
        }
    });
}