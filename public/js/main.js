var postId = 0;
var elemToUpdate;

function editPost(event){
   var content = event.target.parentNode.parentNode.childNodes[1].textContent;
   elemToUpdate = event.target.parentNode.parentNode.childNodes[1];
   postId = event.target.parentNode.parentNode.dataset['postid'];
   $('#edit-area').html(content);
}

function savePost(){
    var cnt = $('#edit-area').val();

    $.ajax({
        method:'POST',
        url: Url,
        data:{body:cnt, postid:postId, _token:token}
    }).done(function(msg){

        $(elemToUpdate).html(msg['new_body']);
        $('#editModal').modal('hide');
    });

}