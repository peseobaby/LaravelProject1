$(document).ready(function() {
    //search
    function fetch_user_data(query = ""){
        $.ajax({
            url:"/live_search/action",
            method : "GET",
            data:{query:query},
            dataType: 'html',
            success:function(data){
                $("#tbody").empty();
                $("#tbody").html(data);
            }
        })
    }
    $(document).on("keyup", "#search", function(){
        var query = $(this).val();
        fetch_user_data(query);
    });

//show modal
    $(document).on("click", ".showModal", function(){
        var id = $(this).attr("data-id");
        var token = $("meta[name='csrf-token']").attr("content");
        $.ajax({
            url: "user/add/"+id,
            type: 'GET',
            data: {
                "id": id,
                "_token": token,
                "errors": errors
            },
            success:function(data){
                $(".includeModal").html(data);
                $("#editUser").modal("show");
                errors = [];
            },
        });
       
    });
//validate
    if (errors.length || !jQuery.isEmptyObject(errors)) {
        $(`button[data-id='0']`).trigger('click');
    }

    //delete
    $(document).on('click', '.delete', function($event) {
        var id = $(this).attr("data-delete-id");
        var token = $("meta[name='csrf-token']").attr("content");
        if (confirm('Bạn có chắc chắn muốn xóa')) {
            $.ajax({
                url: "user/delete/"+id,
                type: 'DELETE',
                data: {
                    "id": id,
                    "_token": token,
                    'errors' : errors
                },
                success:function(data){
                $("#tbody").empty();
                $("#tbody").html(data);
            }   
            });
        }
    })
});
