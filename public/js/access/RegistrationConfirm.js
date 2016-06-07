var RegistrationConfirm = {
    UI: {
        form: $('#register-form'),
        register_message: $("#register-message"),
    },
    initialize: function (id) {
        this.id = id;
        this.clearForm();
        this.initializeButtons();
        this.initializeValidation();
        this.lastNameCounter = 1;
    },
    clearForm: function () {
        this.UI.form.find('input[name="password1"]').val('');
        this.UI.form.find('input[name="password2"]').val('');
    },
    initializeValidation: function () {
        this.UI.form.validate({
            rules: {
                email: {email: true},
                matnum: {number: true},
            },
            messages: {
                matnum: "Molimo vas unseite validan Matični broj."
            }
        });
    },
    initializeButtons: function () {
        var self = this;
        self.UI.form.find('#register-form-send').click(function (e) {
            e.preventDefault();
            self.sendData();
        });
        
    },
    sendData: function () {
        var self = RegistrationConfirm;
        if (!self.UI.form.valid()) {
            return false;
        }

        if (self.UI.form.find('input[name="password1"]').val() 
                !== self.UI.form.find('input[name="password2"]').val() ){
            T.showMessage(self.UI.register_message,"Passwords are not same!", "error");
            return;
        }
        
        var Data = {
            password: self.UI.form.find('input[name="password1"]').val(),
            id: self.id
        };

        $.ajax({
            url: WWW_PATH + 'access/processRegistrationConfirm',
            dataType: 'json',
            type: 'post',
            data: Data,
            success: function (response) {
                if (response.error) {
                    T.showMessage(self.UI.register_message,response.error_message, "error");
                }
                else {
                    self.UI.register_message.addClass('hide');
                    self.UI.form.find('input[type="password"]:visible').val('');
                    toastr.success(response.message);
                }
            },
            error: function () {
                toastr.error("Error!");
            }
        });
    }
};