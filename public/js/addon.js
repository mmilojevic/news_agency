// wrapper function to  block element(indicate loading)
function blockUI(el) {
    $(el).block({
        message: '<div class="loading-animator"></div>',
        css: {
            border: 'none',
            padding: '2px',
            backgroundColor: 'none'
        },
        overlayCSS: {
            backgroundColor: '#fff',
            opacity: 0.3,
            cursor: 'wait'
        }
    });
}

// wrapper function to  un-block element(finish loading)
function unblockUI(el) {
    $(el).unblock();
}

/**
 * Round number to certain decimal points:
 *
 *  @param num
 *  @param dec
 *  @return boolean
 */
function roundNumber(num, dec) {
    var result = Math.round(num * Math.pow(10, dec)) / Math.pow(10, dec);
    return result;
}
