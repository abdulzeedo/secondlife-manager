$.fn.addValidationMessage = function (message, type) {
    var $field = $(this);
    $field.cleanFromValidationMessages();
    // First remove from any messages
    if (type == 'success') {
        $field.parents('.form-group').addClass('has-success');
        $field.parents('.form-group').append($('<span>', {
            class: "help-block",
            text: message
        }));
    }
    else {
        $field.parents('.form-group').addClass('has-error');
        $field.parents('.form-group').append($('<span>', {
            class: "help-block",
            text: message
        }));
    }
};

$.fn.cleanFromValidationMessages = function () {
    var $field = $(this);

    $field.parents('.form-group')
        .removeClass('has-error')
        .removeClass('has-success');

    $field.parents('.form-group').find('span.help-block').remove();
};

/**
 * Used to check whether a selected element exists
 * @returns {boolean} True if selected element exists. False if it does not exist.
 */
$.fn.exists = function () {
    return $(this).length > 0;
};

$.fn.showAlert = function (message, type) {

    // Validate type
    if (type !== "success" && type !== "error") {
        console.log("Type specified for is not recognized.");
        return;
    }
    if (type === "error")
        type = "danger";


    $('#alert-box').html(
        `<div class="alert alert-${type} alert-dismissible" id="${type}" `
        + 'role="alert" style="display:none;" >'
        + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
        + message + '</div>');
    $(`#${type}`).show();

    $(".alert-dismissible").fadeTo(6000, 500).slideUp(500, function(){
        $(".alert-dismissible").alert('close');
    });
};
/**
 *
 * @param size (Optional) Size of array of colours to return
 * @param paletteSet (Optional)
 * @returns array|string
 */

var chartPalette = (size = 1, paletteSet = 'cb-RdYlGn', requiredOpacity = 40) => {

    var convertHex = function (hex, opacity){
        r = parseInt(hex.substring(0,2), 16);
        g = parseInt(hex.substring(2,4), 16);
        b = parseInt(hex.substring(4,6), 16);

        result = 'rgba('+r+','+g+','+b+','+opacity/100+')';
        return result;
    };

    var patternColors = palette(paletteSet, size).map(function(hex) {
        return convertHex(hex, requiredOpacity);
    });
    if (patternColors.length === 1)
        return patternColors[0];
    return patternColors;
};
var chartStackColours = (datasets) => {
    var colours = chartPalette(datasets.length, undefined, 100);
    datasets.forEach((item, index) => {
        item.backgroundColor = colours[index];
        item.borderColor = colours[index];

    });
    return datasets;
};
var fillDataHoles = (biggerData, smallerDataArray, concatenate = true) => {

    smallerDataArray.forEach((item) => {
        biggerData["data"].forEach((element) => {
            if (!item["data"].find(x => x.t === element.t))
                item["data"].push({t:element.t, y: 0});
        });
        item["data"].sort((x,y) => moment(x.t).diff((moment(y.t))))
    });
    if (concatenate)
        return smallerDataArray.concat(biggerData);
    return smallerDataArray;
};
var assignTypeToChartDatasets = (array) => {

    var arrayToReturn = [];
    array.forEach((item) => {
        item.array.forEach((element) => {
            element.type = item.type;
        });
        arrayToReturn.push(item.array);
    });
    return arrayToReturn;
};