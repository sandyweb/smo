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
    
    console.log(account_id);
    
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

function account_save() {
    var title = $("input[name=title]").val();
    var type = $("select[name=type]").val();
    var description = $("textarea[name=description]").val();

    $.ajax({
        url: location.protocol + "//" + location.host + "/accounts/add",
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

$(document).ready(function() {
    
    $('#accounts').dataTable();
    $('.order-list-table').dataTable();

    $(document).on("click", "#save_account", function() {
        account_save();
    });
    
    $(document).on("click", "#update_account", function() {
        account_update();
    }); 
    
    $('#add_account').click(function () {
        $.ajax({
            url: location.protocol + "//" + location.host + "/accounts/add",
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
});

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