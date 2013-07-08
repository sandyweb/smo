$(document).ready(function(){
    getAllMessages();

    //get all messages
    $('.all-messages').click(function(e){
        e.preventDefault();
        $(this).parent().parent().children('span').removeClass('active');
        $(this).parent().addClass('active');
        getAllMessages();
    });

    //get unread messages
    $('.unread-messages').click(function(e){
        e.preventDefault();
        $(this).parent().parent().children('span').removeClass('active');
        $(this).parent().addClass('active');
        getUnreadMessages();
    });

    //get read messages
    $('.read-messages').click(function(e){
        e.preventDefault();
        $(this).parent().parent().children('span').removeClass('active');
        $(this).parent().addClass('active');
        getReadMessages();
    });

    //get archived messages
    $('.archived-messages').click(function(e){
        e.preventDefault();
        $(this).parent().parent().children('span').removeClass('active');
        $(this).parent().addClass('active');
        getArchivedMessages();
    });

    $('#answer-message-btn').click(function(){
        $('#answer-container').toggle();
    });
});

function getAllMessages(){
    $.ajax({
        url: 'ajax/all_messages/',
        dataType: 'html',
        success: function(response){
            $('.messages-container').html(response);
        }
    });
}
function getReadMessages(){
    $.ajax({
        url: 'ajax/read_messages/',
        dataType: 'html',
        success: function(response){
            $('.messages-container').html(response);
        }
    });
}
function getUnreadMessages(){
    $.ajax({
        url: 'ajax/unread_messages/',
        dataType: 'html',
        success: function(response){
            $('.messages-container').html(response);
        }
    });
}
function getArchivedMessages(){
    $.ajax({
        url: 'ajax/archived_messages/',
        dataType: 'html',
        success: function(response){
            $('.messages-container').html(response);
        }
    });
}