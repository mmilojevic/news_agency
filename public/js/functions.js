//case insensitive contains
$.expr[":"].contains = $.expr.createPseudo(function(arg) {
    return function( elem ) {
        return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
    };
});

Array.prototype.unique = function () {
    var a = [];
    var l = this.length;
    for (var i = 0; i < l; i++) {
        for (var j = i + 1; j < l; j++) {
            // If this[i] is found later in the array
            if (this[i] === this[j])
                j = ++i;
        }
        a.push(this[i]);
    }
    return a;
};

var T = {
        date_front: function(datestring){
            if (typeof datestring != "undefined"){
                return datestring.substring(8) + '. ' + datestring.substring(5, 7) + '. ' + datestring.substring(0, 4);
            }
            else{
                return '';
            }
        },
        showMessage: function(elem, message, type){
            elem.html(message);
            if (type === "success"){
                elem.addClass('alert-success').removeClass('alert-danger hide');   
            }
            else{
                elem.addClass('alert-danger').removeClass('alert-success hide');
            }
            
            $('body').animate({
                scrollTop: (elem.offset().top - 80)
            }, 500);
        }
};