$(function() {
    /**
     * Phone mask.
     */
    $('.phone').inputmask('(99) 99999-9999', { placeholder: '(__) _____-____' });

    $('.decimal').inputmask('9,9', { placeholder: '_,_' });

    $('.limit').on('keydown', function(){
        var value = $(this).val();
        var maxLength = $(this).attr('maxlength');

        if(value.length > maxLength) {
            $(this).val('');
            alert('Esse campo aceita apenas 3 caracteres');
            return false;
        }
    });

    /**
     * key down mask cpj/cnpj
     */
    $('.cnpj_cpf').keydown(function(event) {
        if(event.keyCode !== 9 && (event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105)) {
            cnpfCnpjMask(this, true);
        }
    });

    /**
     * Mult select.
     */
    $('.multiselect').multiselect({
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        maxHeight: 200
    });

    /**
     * Datepicker.
     * @type {Date}
     */
    var today = new Date();
    $('.datepicker').datepicker({
        todayHighlight: true,
        autoclose: true,
        startDate: new Date(today.getFullYear(), today.getMonth(), today.getDate()),
        minDate: new Date(today.getFullYear(), today.getMonth(), today.getDate())
    });

    $('.time').inputmask('hh:mm', { placeholder: '__:__ _m', alias: 'time24', hourFormat: '24' });

    /**
     * Open modal.
     */
    $('.open-modal').on('click', function (event) {
        event.preventDefault();

        var url = $(this).attr('href');

        $('#modal').modal('show').find('.modal-content').load(url);
    });
});

function cnpfCnpjMask(element, remove) {
    try {
        $(element).inputmask('remove');
    } catch (e) {}

    var tamanho = $(element).val().length;

    if(tamanho < 11){
        $(element).inputmask("999.999.999-99");
    } else {
        $(element).inputmask("99.999.999/9999-99");
    }

    // ajustando foco
    var elem = this;
    setTimeout(function(){
        // mudo a posição do seletor
        elem.selectionStart = elem.selectionEnd = 10000;
    }, 0);
    // reaplico o valor para mudar o foco
    var currentValue = $(this).val().trim();
    $(this).val(currentValue);
}


function cpfCnpj(element, remove) {
    var value = $(element).val().replace(/[^\w\s]/gi, '');

    if(remove === true || value.length == 0) {
        $(element).inputmask('remove');
        return;
    }

    if(value.length > 11) {
        $(element).inputmask('99.999.999/9999-99', { placeholder: '__.___.___/____-__'});
    } else {
        $(element).inputmask('999.999.999-99', { placeholder: '___.___.___-__'});
    }
}
