$(document).ready(function() {
    //search
    $(document).on("keyup", "#search", function(){
        var query = $(this).val();
        search(query, "/live_search/action", "#tbody");
    });

    //show modal
    $(document).on("click", ".showModal", function() {
        show("user/add/", $(this), ".includeModal", "#editUser")
    });

    //post Modal
    $(document).on("click", "#userAdd", function(e){
        e.preventDefault();
        store('user/post', "#tbody", "#editUser")
    });

    //validate
    if (errors.length || !jQuery.isEmptyObject(errors)) {
        $(`button[data-id='0']`).trigger('click');
    }

    //delete
    $(document).on('click', '.delete', function($event) {
        del($(this).attr("data-delete-id"), "user/delete/", "#tbody")
    })
});
