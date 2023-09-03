
function readNotification(idNotice, idUser){
    //alert("Нажата ссылка! " + idNotice);

    console.log(idNotice, idUser);

    $.ajax({
        url: '/notification/remove',
        method: 'post',
        dataType: 'html',
        data: {
            idNotice: idNotice,
            idUser: idUser
        },
        success: function(data){
            //alert(data);
        }
    });

}