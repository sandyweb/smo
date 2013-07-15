$(document).ready(function(){
    var actionUrl = $('input[name="action_url"]').val();
    var $client = $('select[name="client"]');
    if($client.is(':visible')){
        getMessageHistory($client.val());
    }
    else{
        getAllMessages(actionUrl);
    }

    //client change
    $client.change(function(){
        getMessageHistory($(this).val());
    });

    //get all messages
    $('.all-messages').click(function(e){
        e.preventDefault();
        $(this).parent().parent().children('span').removeClass('active');
        $(this).parent().addClass('active');
        if($client.is(':visible')){
            getMessageHistory($client.val());
        }
        else{
            getAllMessages(actionUrl);
        }
    });

    //get unread messages
    $('.unread-messages').click(function(e){
        e.preventDefault();
        $(this).parent().parent().children('span').removeClass('active');
        $(this).parent().addClass('active');
        getUnreadMessages(actionUrl);
    });

    //get read messages
    $('.read-messages').click(function(e){
        e.preventDefault();
        $(this).parent().parent().children('span').removeClass('active');
        $(this).parent().addClass('active');
        getReadMessages(actionUrl);
    });

    //get archived messages
    $('.archived-messages').click(function(e){
        e.preventDefault();
        $(this).parent().parent().children('span').removeClass('active');
        $(this).parent().addClass('active');
        getArchivedMessages(actionUrl);
    });

    $('#answer-message-btn').click(function(){
        $('#answer-container').toggle();
    });
});

function getAllMessages(actionUrl){
    $.ajax({
        url: 'ajax/all_messages/',
        type: 'post',
        dataType: 'html',
        data: {action_url: actionUrl},
        success: function(response){
            $('.messages-container').html(response);
        }
    });
}
function getReadMessages(actionUrl){
    $.ajax({
        url: 'ajax/read_messages/',
        type: 'post',
        dataType: 'html',
        data: {action_url: actionUrl},
        success: function(response){
            $('.messages-container').html(response);
        }
    });
}
function getUnreadMessages(actionUrl){
    $.ajax({
        url: 'ajax/unread_messages/',
        type: 'post',
        dataType: 'html',
        data:{action_url: actionUrl},
        success: function(response){
            $('.messages-container').html(response);
        }
    });
}
function getArchivedMessages(actionUrl){
    $.ajax({
        url: 'ajax/archived_messages/',
        type: 'post',
        dataType: 'html',
        data:{action_url: actionUrl},
        success: function(response){
            $('.messages-container').html(response);
        }
    });
}
function getMessageHistory(clientId){
    $.ajax({
        url: 'ajax/message_history/',
        type: 'post',
        dataType: 'html',
        data:{client_id: clientId},
        success: function(response){
            $('.messages-container').html(response);
        }
    });
}