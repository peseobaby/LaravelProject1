$(document).ready(function() {
    //search
    $(document).on("keyup", "#search_department", function(){
        var query = $(this).val();
        search(query, "/department_search/action", "#tbody1");
    });

    //show modal
    $(document).on("click", ".showModalDepartment", function(){
        show("department/add/", $(this), ".includeModalDepartment", "#departmentModal")
    });

    //post Modal
    $(document).on("click", "#departmentAdd", function(e){
        e.preventDefault();
        store('department/post', "#tbody1", "#departmentModal")
    });

    //validate
    if (errors.length || !jQuery.isEmptyObject(errors)) {
        $(`button[data-id='0']`).trigger('click');
    }

    //delete
    $(".delete_department").click(function(){
        del($(this).data("id"), "department/destroy/", "#tbody1")
    });
});