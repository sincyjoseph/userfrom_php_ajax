$(document).ready(function(){

    var $regform = $("#reg");

    $.validator.addMethod("noSpace",function(value, element){
        return value == '' || value.trim().length != 0
    }, "Spaces are not allowed");

    if($regform.length){
        $regform.validate({
            rules:{
                username:{
                    required: true,
                    noSpace: true, 
                    minlength: 3
                },
                password:{
                    required: true,
                    minlength: 4
                },
                confirmpass:{
                    required: true,
                    equalTo: '#password'
                },
                email:{
                    required: true,
                    email: true
                },
                gender:{
                    required: true
                },
                address:{
                    required: true
                },
                checkbox:{
                    required: true,
                }
            },
            messages:{
                username:{
                    required:'Username is mandatory!',
                    minlength:'Minimum length is 3'
                },
                password:{
                    required:'Password is mandatory!',
                    minlength:'Minimum length is 4'
                },
                confirmpass:{
                    required:'Password is mandatory!',
                    equalTo: 'Confirm your password!'
                },
                email:{
                    required:'Email is mandatory!',
                    email:'Please enter valid email!'
                },
                gender:{
                    required:'Gender is mandatory!'
                },
                address:{
                    required:'Feedback is mandatory!'
                },
                checkbox:{
                    required:'Declaration is mandatory!'
                }
            },
            errorPlacement: function(error, element){
                if(element.is(":radio")){
                    error.appendTo(element.parents(".gender"));
                }else if(element.is(":checkbox")){
                    error.appendTo(element.parents(".declaration"));
                }else{
                    error.insertAfter(element);
                }
            }
        })
    }

    // Delete 
    $('.delete').click(function(){
        var el = this;
        // Delete id
        var deleteId = $(this).data('id');
        var confirmalert = confirm("Are you sure?");
        if (confirmalert == true) {
        // AJAX Request
        $.ajax({
            url: 'ajax/delete.php',
            type: 'POST',
            data: { deleteId: deleteId },
            success: function(response){
            if (response == 1){
            // Remove row from HTML Table
                $(el).closest('tr').fadeOut(800,function(){
                $(this).remove();
                });
            } else{
                alert('Invalid ID.');
            }
            }
        });
        }
    });
    
})