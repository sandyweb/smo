$(document).ready(function() {
    
    $('#accounts').dataTable({
        iDisplayLength: 20,
        bFilter: false,
        bInfo: false,
        bLengthChange: false,
        bPaginate: false
    });
    $('.order-list-table').dataTable();

    $(document).on("click", "#save_account", function() {
        account_save(function(){
            location.reload(true);
        });
    });
    
    $(document).on("click", "#update_account", function() {
        account_update();
    }); 
    
    $('#add_account').click(function () {
        $.ajax({
            url: location.protocol + "//" + location.host + "/accounts/get",
            type: "GET",
            dataType: "HTML",
            success: function(data) {
                $("#actions").empty();
                $("#actions").append(data);
                $("#actions").show();
            }
        });
    });

    $('#update_account_btn').click(function(){
        var account = {};
        account.id = $('input[name="account_id"]').val();
        account.title = $('input[name="title"]').val();
        account.type = $('select[name="type"]').val();
        account.description = $('textarea[name="description"]').val();
        account_edit(account);
    });
    
    $('.edit_account').click(function () {
        var account_id = $(this).parent().parent().find("input[name=account_id]").val();
        console.log(account_id);
        $.ajax({
            url: location.protocol + "//" + location.host + "/accounts/edit/" + account_id,
            type: "GET",
            dataType: "HTML",
            success: function(data) {
                $("#actions").empty();
                $("#actions").append(data);
                $("#actions").show();
            }
        });
    });

    var $content_wrapper = $('.content_wrapper');
    //add to order list
    $content_wrapper.on('click', '#add_to_order_btn', function(){
        if(validate_account()){
            account_save(function(data){
                add_to_order_list(data.id, function(){
                    location.reload(true);
                });
            });
        }
    });

    //purchase account
    $content_wrapper.on('click', '#purchase_btn', function(){
        if(validate_account()){
            account_save(function(data){
                purchase_account(data.id, function(){
                    location.reload(true);
                });
            });
        }
    });
});

function validate_account(){
    if($('input[name="title"]').val() == ''){
        $('.redmessage').text('Account title should not be empty');
        return false;
    }
    return true;
}

function account_edit(account){
    $.ajax({
        url: 'ajax/account_edit',
        type: 'post',
        dataType: 'json',
        data: {id: account.id, title: account.title,
            description: account.description, account_type: account.type
        },
        success: function(response){
            if(response.status == 200){
                alert(response.message);
            }
            else{
                alert(response.reason);
            }
        }
    });
}

function purchase_account(account_id, callback){
    $.ajax({
        url: 'ajax/purchase_account/',
        type: 'post',
        dataType: 'json',
        data: {account_id: account_id},
        success: function(response){
            if(response.status == 200){
                if(callback && typeof callback == 'function'){
                    callback();
                }
            }else{
                alert(response.reason);
            }
        }
    });
}

function add_to_order_list(account_id, callback){
    $.ajax({
        url: 'ajax/add_to_order_list/',
        type: 'post',
        dataType: 'json',
        data: {account_id: account_id},
        success: function(response){
            if(response.status == 200){
                if(callback && typeof callback == 'function'){
                    callback();
                }
            }else{
                alert(response.reason);
            }
        }
    });
}

function shakeLogin() {
    setTimeout(function () {
        $('.login_wrapper').effect("shake", { distance: 10, times: 1 }, 250);
    }, 100);
}

function account_update() {
    var account_id = $("input[name=account_id]").val();
    var title = $("input[name=title]").val();
    var type = $("select[name=type]").val();
    var description = $("textarea[name=description]").val();

    $.ajax({
        url: location.protocol + "//" + location.host + "/accounts/edit/" + account_id,
        type: "POST",
        data: {type:type, title:title, description:description},
        dataType: "HTML",
        success: function(data) {
            if (data === "") {
//                $("#actions").hide();
                location.reload();
            } else {
                $("#actions").empty();
                $("#actions").append(data);
            }
        }
    });
}

function account_save(callback){
    var title = $("input[name=title]").val();
    var type = $("select[name=type]").val();
    var description = $("textarea[name=description]").val();

    $.ajax({
        url: 'accounts/add',
        type: "POST",
        data: {type:type, title:title, description:description},
        dataType: 'json',
        success: function(response){
            if(response.status == 200){
                if(callback && typeof callback === 'function'){
                    callback(response.data);
                }
            }else{
                $("#actions").empty().append(response.reason);
            }
        }
    });
}