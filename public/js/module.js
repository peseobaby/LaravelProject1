//show Modal
function show(url, thisEle, add, modal){
    var id = thisEle.attr("data-id");
    console.log(thisEle);
    var token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        url: url + id,
        type: 'GET',
        data: {
            "id": id,
            "_token": token,
            "errors": errors
        },
        success:function(data){
            $(add).html(data);
            $(modal).modal("show");
            errors = [];
        },
    });
};

//post Modal
function store(url, tbody, modal){
    $.ajax({
        url: url,
        type: 'POST',
        data: $('form').serialize(),
        success:function(data){
            $(tbody).empty();
            $(tbody).html(data);
            $(modal).modal("hide");
        },
        error: function(jqXhr, json, errorThrown){
            var errors = jqXhr.responseJSON.errors;
            if(errors)
            {
                $('.alert-danger').html('');
                $.each(errors, function(key, value){
                        $('.alert-danger').show();
                        $('.alert-danger').append('<li>'+value+'</li>');
                });
            }
        }
    });
};

//search
function search(query = "", url, tbody){
    $.ajax({
        url:url,
        method : "GET",
        data:{query:query},
        dataType: 'html',
        success:function(data){
            $(tbody).empty();
            $(tbody).html(data);
        }
    })
}

//delete
function del(thisEle, url, tbody){
    var id = thisEle;
    var token = $("meta[name='csrf-token']").attr("content");
    if (confirm('Bạn có chắc chắn muốn xóa')) {
        $.ajax({
            url: url + id,
            type: 'DELETE',
            data: {
                "id": id,
                "_token": token,
            },
            success:function(data){
            $(tbody).empty();
            $(tbody).html(data);
        }
        });
    }
}
