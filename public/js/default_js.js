$(document).ready(function() {
    console.log('jquery is on fire')

    setTimeout(function(){
        $('#success-message, #error-message').fadeOut('slow');
    }, 3000);

    $("#flexCheckChecked").change(function() {
        var passwordInput = $('input[name="password"]');
        var icInput = $('input[name="user_ic"], input[name="user_ic"]');
        
        if ($(this).is(":checked")) {
            passwordInput.val(icInput.val());
        } else {
            passwordInput.val("");
        }
    });

    $('#submitButton').on('click', function() {
        var selectedStudentIds = [];
        $('.add-std-checkbox:checked').each(function() {
            selectedStudentIds.push($(this).val());
        });
    });

    $('button[data-target="#confirmDelete"]').on('click', function() {
        $('#confirmDelete').modal('show');

    });

    $('#confirmNotDelete, #confirmNotDelete2').on('click', function() {
        $('#confirmDelete').modal('hide');
    });    
});