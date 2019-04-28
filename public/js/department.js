$(document).ready(function() {
    //search
    function fetch_department_data(query = ""){
        $.ajax({
            url:"/department_search/action",
            method : "GET",
            data:{query:query},
            dataType: 'html',
            success:function(data){
                $("#tbody1").empty();
                $("#tbody1").html(data);
            }
        })
    }
    $(document).on("keyup", "#search_department", function(){
        var query = $(this).val();
        fetch_department_data(query);
    });
    //modal
    $(document).on("click", ".showModalDepartment", function(){
        var id = $(this).attr("data-id");
        var token = $("meta[name='csrf-token']").attr("content");
        $.ajax({
            url: "department/add/"+id,
            type: 'GET',
            data: {
                "id": id,
                "_token": token,
                "errors": errors
            },
            success:function(data){
                $(".includeModalDepartment").html(data);
                $("#departmentModal").modal("show");
                errors = [];
            },

        });
    });
//validate
    if (errors.length || !jQuery.isEmptyObject(errors)) {
        $(`button[data-id='0']`).trigger('click');
    }
    
    //delete
    $(".delete_department").click(function(){
        var id = $(this).data("id");
        var token = $("meta[name='csrf-token']").attr("content");
        if (confirm('Bạn có chắc chắn muốn xóa')) {
            $.ajax({
                url: "department/destroy/"+id,
                type: 'DELETE',
                data: {
                    "id": id,
                    "_token": token,
                },
                success:function(data){
                $("#tbody1").empty();
                $("#tbody1").html(data);
            }
            });
        }
    });
});