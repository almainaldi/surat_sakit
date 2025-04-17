$(document).ready(function() {
    $('#wilayah_bongkar').select2({
        placeholder: 'Pilih Wilayah Bongkar',
        language: ""
    });

    $('#form').validate({
        rules: {
            wilayah_bongkar: {
                required: true,
            },
        },
        messages: {
            wilayah_bongkar: {
                required: "Wilayah Bongkar tidak boleh kosong",
            },
        }
    });
});