    $(document).ready(function(){
        var errorHendle = function(response, message) {
                            $('#validate').remove();
                            let errors = JSON.parse(response.responseText);
                            $('table').parent().prepend(
                               `<div class="alert alert-danger" id="validate">
                                    ${errors.join('<br>')}
                                </div>`
                            )
                            $('.edit').prop('disabled', true);
                            $('#addUser').prop('disabled', true);
                        }
        //adduser
        $("#addUser").click(function(){
              let template = `<tr>
                                <form method="post" action="/home" role="form">
                                {{ csrf_field()}}
                                    <td></td>
                                    <td><input type='text' name='name' placeholder='name'></td>
                                    <td><input type='text' name='email' placeholder='email'></td>
                                    <td><input type='number' name='age' placeholder='age'></td>
                                    <td><input type='text' name='address' placeholder='address'></td>
                                    <td>
                                    <select name='level'>`;
            for (let i = 0; i < levels.length ; i++) {
                template += `<option value = ${levels[i]['id']}>${levels[i]['name']}</option>`;
            }
            template += `</select></td><td><select name='department'>`;
            for (let i = 0; i < departments.length ; i++) {
                template += `<option value = ${departments[i]['id']}>${departments[i]['name']}</option>`;
            }
            template += `</select>
                                    </td>
                                    <td><button type='submit' id ='submit'>Save</button>
                                        <button class='cancel'>Cancel</button></td>
                                </tr>`;
            $(".tbody").prepend(template)
            $('.edit').prop('disabled', true);
            $('#addUser').prop('disabled', true);
        })
        $(document).on('click', '#submit', function(e) {
            e.preventDefault();
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
             $.ajaxSetup({
                headers:
                { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });
            $.ajax({
                type: "POST",
                url: "/user/store",
                dataType: "html",
                data: {
                    name : $("input[name = 'name']").val(),
                    email : $("input[name = 'email']").val(),
                    age : $("input[name = 'age']").val(),
                    address : $("input[name = 'address']").val(),
                    level : $("select[name = 'level']").val(),
                    department : $("select[name = 'department']").val(),
                },
                success : function(data){
                    $('#validate').remove();
                    $('tbody').empty();
                    $('tbody').html(data);
                },
                error : errorHendle
            })
            $('.edit').prop('disabled', false);
            $('#addUser').prop('disabled', false);
        })
        //editUser
        $(document).on('click', '.edit', function(){
            var id = $(this).parent().prevAll("td[name ='id']").text();
            var name = $(this).parent().prevAll("td[name ='name']").text();
            var email = $(this).parent().prevAll("td[name ='email']").text();
            var age = $(this).parent().prevAll("td[name ='age']").text();
            var address = $(this).parent().prevAll("td[name ='address']").text();
            var level = $(this).parent().prevAll("td[name ='level']").text();
            var department = $(this).parent().prevAll("td[name ='department']").text();
            let template = `<tr>
                                <form method="post" action="/home" role="form">
                                {{ csrf_field()}}
                                    <td><input type='text' name='id' value=`+ id + ` readonly></td>
                                    <td><input type='text' name='name' value=`+ name + `></td>
                                    <td>`+ email + `</td>
                                    <td><input type='number' name='age' value=`+ age + `></td>
                                    <td><input type='text' name='address' value=`+ address + `></td>
                                    <td>
                                    <select name='level'>`;
            for (let i = 0; i < levels.length ; i++) {
                template += `<option value="${levels[i]['id']}" ${levels[i]['id'] == level ? 'selected' : ''}>${levels[i]['name']}</option>`;
            }
            template += `</select></td><td><select name='department'>`;
            for (let i = 0; i < departments.length ; i++) {
                template += `<option value="${departments[i]['id']}" ${departments[i]['id'] == department ? 'selected' : ''}>${departments[i]['name']}</option>`;
            }
            template += `</select>
                                    </td>
                                    <td><button type='submit' id ='save'>Save</button>
                                        <button class='cancel'>Cancel</button></td>
                                </tr>`;
            $(this).closest("tr").after(template).remove();
            $('.edit').prop('disabled', true);
            $('#addUser').prop('disabled', true);
        })

        $(document).on('click', '#save', function(e) {
            e.preventDefault();
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
             $.ajaxSetup({
                headers:
                { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });
            $.ajax({
                type: "POST",
                url: "/user/update/" + $("input[name = 'id']").val(),
                dataType: "html",
                data: {
                    id : $("input[name = 'id']").val(),
                    name : $("input[name = 'name']").val(),
                    age : $("input[name = 'age']").val(),
                    address : $("input[name = 'address']").val(),
                    level : $("select[name = 'level']").val(),
                    department : $("select[name = 'department']").val(),
                },
                success : function(data){
                    $('#validate').remove();
                    $('tbody').empty();
                    $('tbody').html(data);
                    $('.edit').prop('disabled', false);
                    $('#addUser').prop('disabled', false);
                    
                },
                error : errorHendle
            })
        })
        $(document).on('click', '.cancel', function() {
            $('table').load('/home table');
            $('.edit').prop('disabled', false);
            $('#addUser').prop('disabled', false);
        })
    });