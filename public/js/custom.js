const base_url = window.location.origin;
const host = window.location.host;
const pathArray = window.location.pathname.split( '/' );

const showToast = (type, title, message) => {
    if (type === 'success') {
        Swal.fire({
            title: title,
            text: message,
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    } else if (type === 'error') {
        Swal.fire({
            title: title,
            text: message,
            icon: 'error',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    } else if (type === 'warning') {
        Swal.fire({
            title: title,
            text: message,
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    }
}

function handleAjaxValidationError(data, modal = null) {
    const response = data?.responseJSON;
    if (data?.status === 422) {
        appendErrorMessage(response.errors);
    }
    if (modal) {
        $(modal).modal('hide');
    }
}

const appendErrorMessage = (errors = [], formGroup = false) => {
    $.each(errors, (field, message) => {
        const errBox = '<small class="error-msg-content"><p>' + message + '</p></small>';
        if (formGroup) {
            $(`[name="${field}[]"]`).parents('.form-group').find('.error-msg').append(errBox);
        } else {
            $(`[name="${field}"]`).parents('.form-group').find('.error-msg').append(errBox);
        }
    });
}

const removeErrorBox = () => {
    $('.error-msg-content').remove();
};

const resetSelect = (selectElem) => {
    const node = $(document).find(selectElem);

    if (node && node.length) {
        const clone = node.find('option').first().clone();

        $(node).find('option').remove();
        $(node).append(clone);
    }
};

const destroyDatatable = (tableId, selector = 'id') => {
    if (selector === 'id') {
        const currentTable = $(document).find(tableId);

        if ($.fn.dataTable.isDataTable(currentTable)) {
            currentTable.DataTable().clear().destroy();
        }

    } else if (selector === 'dtObject') {

        if (tableId !== null) {
            tableId.clear().destroy();
        }
    }
}

const toggleDisabled = (button) => {
    if (button) {
        if($(button).prop('disabled') === true) {
            $(button).prop('disabled', false);
        } else {
            $(button).prop('disabled', true);
        }
    }
};

const initDatepicker = (elem, customSettings = {}) => {
    if (elem) {
        $(document).find(elem).daterangepicker({
            singleDatePicker: customSettings?.daterangepicker === true ? false : true,
            minDate: customSettings?.minDate || new Date(),
            maxDate: customSettings?.maxDate,
            locale: {
                format: customSettings?.format || 'DD-MM-YYYY',
            },
            autoApply: customSettings?.autoApply !== undefined ? customSettings?.autoApply : true,
            showDropdowns: customSettings?.autoApply !== undefined ? customSettings?.showDropdowns : true,
            ...customSettings,
        });
    }
};

const checkRegex = (e, regexChar) => {
    let testRegex = new RegExp(regexChar);
    let str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (testRegex.test(str)) {
        return true;
    }
    return false;
}

$(function (){
    $(document).on('keypress', 'input.alpha-numeric-space', function (e) {
        const check = checkRegex(e, "^[0-9a-zA-Z \b]+$");
        if (check) return true;

        e.preventDefault();
        return false;
    });

    $(document).on('keypress', 'input.alpha-space', function (e) {
        const check = checkRegex(e, "^[a-zA-Z \b]+$");
        if (check) return true;

        e.preventDefault();
        return false;
    });

    $(document).on('keypress', 'input.numeric', function (e) {
        const check = checkRegex(e, '^[0-9]+$');
        if (check) return true;

        e.preventDefault();
        return false;
    });

    $(document).on("keydown","input.form-control" ,function(e){
        var caretPos = $(this)[0].selectionStart
        if(e.keyCode == 32 && caretPos == 0){
           return false;
        }
   });

});
