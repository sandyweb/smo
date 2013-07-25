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
        if($('.history').is(':visible')){
            getMessageHistory($client.val());
        }
        else if($('.all').is(':visible')){
            getAllMessages(actionUrl);
        }
        else if($('.unread').is(':visible')){
            getUnreadMessages(actionUrl);
        }
        else if($('.read').is(':visible')){
            getReadMessages(actionUrl);
        }
        else if($('.archived').is(':visible')){
            getArchivedMessages(actionUrl);
        }
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

    //messages pagination
    $('.messages-container').on('click', '.pagination a', function(e){
        e.preventDefault();
        var page = $(this).attr('href').split('?');
        if(typeof page[1] != 'undefined'){
            page = page[1].split('=');
            page = page[1];
        }
        else{
            page = 0;
        }
        if($('.history').is(':visible')){
            getMessageHistory($client.val(), page);
        }
        else if($('.all').is(':visible')){
            getAllMessages(actionUrl, page);
        }
        else if($('.unread').is(':visible')){
            getUnreadMessages(actionUrl, page);
        }
        else if($('.read').is(':visible')){
            getReadMessages(actionUrl, page);
        }
        else if($('.archived').is(':visible')){
            getArchivedMessages(actionUrl, page);
        }
    });

    var $receiver = $('select[name="message[receiver_id]"]');
    if($receiver.is(':visible')){
        getClientAccountList($receiver.val());
    }

    $('.additional').on('change', 'select[name="message[receiver_id]"]', function(){
        getClientAccountList($(this).val());
    });
});

function getAllMessages(actionUrl, page){
    page = (page) ? page : 0;
    $.ajax({
        url: 'ajax/all_messages/',
        type: 'post',
        dataType: 'html',
        data: {action_url: actionUrl, page: page},
        success: function(response){
            $('.messages-container').html(response);
        }
    });
}
function getReadMessages(actionUrl, page){
    page = (page) ? page : 0;
    $.ajax({
        url: 'ajax/read_messages/',
        type: 'post',
        dataType: 'html',
        data: {action_url: actionUrl, page: page},
        success: function(response){
            $('.messages-container').html(response);
        }
    });
}
function getUnreadMessages(actionUrl, page){
    page = (page) ? page : 0;
    $.ajax({
        url: 'ajax/unread_messages/',
        type: 'post',
        dataType: 'html',
        data:{action_url: actionUrl, page: page},
        success: function(response){
            $('.messages-container').html(response);
        }
    });
}
function getArchivedMessages(actionUrl, page){
    page = (page) ? page : 0;
    $.ajax({
        url: 'ajax/archived_messages/',
        type: 'post',
        dataType: 'html',
        data:{action_url: actionUrl, page: page},
        success: function(response){
            $('.messages-container').html(response);
        }
    });
}
function getMessageHistory(clientId, page){
    page = (page) ? page : 0;
    $.ajax({
        url: 'ajax/message_history/',
        type: 'post',
        dataType: 'html',
        data:{client_id: clientId, page: page},
        success: function(response){
            $('.messages-container').html(response);
        }
    });
}
function getClientAccountList(clientId){
    $.ajax({
        url: 'ajax/client_account_list/',
        type: 'post',
        dataType: 'html',
        data: {client_id: clientId},
        success: function(response){
            $('.client-account-container').html(response);
        }
    });
}