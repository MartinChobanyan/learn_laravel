var modal, button, $user_id, user, name, phone, skype, email, input_name, input_phone, input_skype, input_email;

$('#editorModal').on('show.bs.modal', function (e) {
    //init
    button = $(e.relatedTarget);
    $user_id = button.data('id');

    user = $('#' + $user_id);

    name = user.find('#name').text();
    phone = user.find('#phone').text();
  //  skype = user.find('#skype').text();
    email = user.find('#email').text();

    modal = $(this);
    input_name = modal.find('.modal-body form input#user-name');
    input_phone = modal.find('.modal-body form input#user-phone');
//    input_skype = modal.find('.modal-body form input#user-skype');
    input_email = modal.find('.modal-body form input#user-email');

    // putting data into Model inputs
    input_name.val(name); 
    input_phone.val(phone);
//      input_skype.val(skype); 
    input_email.val(email);

    //--
    
    // Save
    modal.find('.modal-footer button#Save').click(function(){ 
        name = input_name.val();
        phone = input_phone.val();
        // skype = input_skype.val();
        email = input_email.val();
        
        $.ajax({
            type: 'PUT',
            url: ('/profile/edit/' + $user_id),
            data: {
                'name': name,
                'phone': phone,
                // 'skype': skype,
                'email': email
            },
            success: function(result) {
                modal.find('.modal-body .alert-danger').hide();

                input_name.addClass('is-valid');
                input_phone.addClass('is-valid');
               // input_skype.addClass('is-valid');
                input_email.addClass('is-valid');

                modal.find('.modal-body .alert-success').html(result.success + '!').show();

                // Updating user data in profile
                user.find('#name').text(name);
                user.find('#phone').text(phone);
               // user.find('#skype').text(skype);
                user.find('#email').text(email);
            },
            error: function(result) {
                modal.find('.modal-body .alert-success').hide();
                console.log(result.responseJSON.errors);
                modal.find('.modal-body .alert-danger').html(ErrorsHandler(result.responseJSON.errors, ['name', 'phone', 'email'])).show(); // // skype                
            }
        });
    });
    //--
    
    // Inputs
    input_name.keypress(function(){
        InputsLogicOnKeypress('name');
    });

    input_phone.keypress(function(){
        InputsLogicOnKeypress('phone');
    });

    // input_skype.keypress(function(){
    //     InputsLogicOnKeypress('skype');
    // });

    input_email.keypress(function(){
        InputsLogicOnKeypress('email');
    });
    //--

    // Functions
    function InputsLogicOnKeypress(type){
        modal.find('.modal-body form input').removeClass('is-valid'); // Putting valid inputs indicators(If there are exist) to their initial state
        eval('input_' + type).removeClass('is-valid').removeClass('is-invalid'); // Putting input indicator to its initial state
        modal.find('.modal-body .alert-danger span[for="' + type + '"]').remove(); // removing errors of input
        if(modal.find('.modal-body .alert-danger').text() === '') modal.find('.modal-body .alert-danger').hide(); // Hidding Danger alert, if it's empty
        if(modal.find('.modal-body .alert-success').is(':visible')) modal.find('.modal-body .alert-success').hide(); // Hidding Success alert, if it's visible
    }

    function ErrorsHandler(errors, types){
        var errors_msg = '';
        types.forEach(function(type){
            var errors_type = eval('errors.' + type); // errors.(type) -> Errors of type ...
            if(errors_type){
                eval('input_' + type).addClass('is-invalid');
                errors_type.forEach(function(error) { errors_msg += '<span for="' + type + '">' + '* ' + error + '<br></span>'; });
            } else {
                eval('input_' + type).addClass('is-valid');
            }
        });
        return errors_msg;
    }
    //--
});

$('#editorModal').on('hide.bs.modal', function () {
    modal.find('.modal-body form input').removeClass('is-valid').removeClass('is-invalid');
    modal.find('.modal-body .alert').hide();
});