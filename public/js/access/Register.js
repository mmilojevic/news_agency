var Register = {
    UI: {
        form: $('#register-form'),
        register_message: $("#register-message"),
    },
    initialize: function () {
        this.clearForm();
        this.initializeButtons();
        this.initializeValidation();
        this.lastNameCounter = 1;
    },
    clearForm: function () {
        this.UI.form.find('input[name="email"]').val('');
    },
    initializeValidation: function () {
        this.UI.form.validate({
            rules: {
                email: {email: true},
                matnum: {number: true},
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
        var self = Register;
        if (!self.UI.form.valid()) {
            return false;
        }
        
        var Data = {
            name: self.UI.form.find('input[name="name"]').val(),
            email: self.UI.form.find('input[name="email"]').val(),
        };

        $.ajax({
            url: WWW_PATH + 'access/processRegister',
            dataType: 'json',
            type: 'post',
            data: Data,
            success: function (response) {
                if (response.error) {
                    T.showMessage(self.UI.register_message,response.error_message, "error");
                }
                else {
                    self.UI.register_message.addClass('hide');
                    self.UI.form.find('input[type="text"]:visible,input[type="password"]:visible').val('');
                    toastr.success('Mail is sent to your address. PLease confirm registration!');
                    setTimeout(function () {
                        window.location.href = WWW_PATH + "search"
                    }, 3000);
                }
            },
            error: function () {
                toastr.error("Error!");
            }
        });
    }
};