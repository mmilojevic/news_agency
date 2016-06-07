
//@TODO remove
var My_post = {
    initialize: function() {
        this.initializeButtons();
    },
    initializeButtons: function() {
        var self = this;
        self.UI.form.find('').click(function(e) {
            e.preventDefault();
            if (self.checkValidation()){
                self.sendData();
            }
        });
    },
//    sendData: function(){
//        var self = My_post;
//        var Data = {
//            password: self.UI.form.find('input[name="password"]').val(),
//            email: self.UI.form.find('input[name="email"]').val()
//        };
//
//        $.ajax({
//            url: WWW_PATH + 'access/processLogin',
//            dataType: 'json',
//            type: 'post',
//            data: Data,
//            beforeSend: function () {
//                blockUI(self.UI.form.closest('.row'));
//            },
//            success: function(response) {
//                if (response.error) {
//                    T.showMessage(self.UI.login_message, response.error_message, "error");
//                }
//                else {
//                    self.UI.login_message.addClass('hide');
//                    window.location.href = WWW_PATH + 'internal/myPosts';
//                }
//            },
//            error: function(xhr) {
//                T.showMessage(self.UI.login_message,xhr.responseText, "error");
//            },
//            complete: function(){
//                unblockUI(self.UI.form.closest('.row'));
//            }
//        });
//    }
}