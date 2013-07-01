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