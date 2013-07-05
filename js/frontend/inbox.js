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
function getReadMessages(){}
function getUnreadMessages(){}
function getArchivedMessages(){}