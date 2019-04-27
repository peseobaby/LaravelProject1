$(document).ready(function(){
        //adduser
        $("#addDepartment").click(function(){
            $("tbody").prepend(`<tr>
                                <form method="post" action="{{ route('department') }}" role="form">
                                {{ csrf_field()}}
                                    <td></td>
                                    <td><input type='text' name='name' placeholder='name'>
                                    </td>
                                    <td><button type='submit' id ='submitDepartment'>Save</button>
                                        <button class='cancel'>Cancel</button></td>
                                </tr>`)
            $('.editDepartment').prop('disabled', true);
            $('#addDepartment').prop('disabled', true);
        })
        $(document).on('click', '#submitDepartment', function(e) {
            e.preventDefault();
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
             $.ajaxSetup({
                headers:
                { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });
            $.ajax({
                type: "POST",
                url: "/department",
                dataType: "html",
                data: {
                    name : $("input[name = 'name']").val(),
                },
                success : function(data){
                    $('#validate').remove();
                    $('tbody').empty();
                    $('tbody').html(data);
                },
                error : function(response, message) {
                    console.log(response);
                    $('#validate').remove();
                    let errors = JSON.parse(response.responseText);
                    $('table').parent().prepend(
                        `<div class="alert alert-success" id="validate">`
                            + errors +
                        `</div>`
                        )
                },
            })
            $('.editDepartment').prop('disabled', false);
            $('#addDepartment').prop('disabled', false);
        })
        //editDepartment
        $(document).on('click', '.editDepartment', function(){
            var id = $(this).parent().prevAll("td[name ='id']").text();
            var name = $(this).parent().prevAll("td[name ='name']").text();
            let template = `<tr>
                                <form method="post" action="{{ route('department') }}" role="form">
                                {{ csrf_field()}}
                                    <td><input type='text' name='id' value=`+ id + ` readonly></td>
                                    <td><input type='text' name='name' value=`+ name + `></td>`
                template +=         `<td><button type='submit' id ='saveDepartment'>Save</button>
                                    <button class='cancel'>Cancel</button></td>
                            </tr>`;
            $(this).closest("tr").after(template).remove();
            $('.editDepartment').prop('disabled', true);
            $('#addDepartment').prop('disabled', true);
        })

        $(document).on('click', '#saveDepartment', function(e) {
            e.preventDefault();
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
             $.ajaxSetup({
                headers:
                { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });
            $.ajax({
                type: "POST",
                url: "/department/update/" + $("input[name = 'id']").val(),
                dataType: "html",
                data: {
                    id : $("input[name = 'id']").val(),
                    name : $("input[name = 'name']").val(),
                },
                success : function(data){
                    $('#validate').remove();
                    $('tbody').empty();
                    $('tbody').html(data);
                    $('.editDepartment').prop('disabled', false);
                    $('#addDepartment').prop('disabled', false);
                    
                },
                error : function(response, message) {
                    console.log(response);
                    $('#validate').remove();
                    let errors = JSON.parse(response.responseText);
                    $('table').parent().prepend(
                        `<div class="alert alert-success" id="validate">`
                            + errors +
                        `</div>`
                        )
                },
            })
        })
        $(document).on('click', '.cancel', function() {
            $('table').load('/department table');
            $('.editDepartment').prop('disabled', false);
            $('#addDepartment').prop('disabled', false);
        })
    });