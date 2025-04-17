$(document).ready(function() {
    $('#merk').select2({
        placeholder: 'Pilih Merk',
        language: "merk"
    });

    $('#form').validate({
        rules: {
            type_motor: {
                required: true,
                maxlength: 50, //Sesuai dengan data base
            },
            merk: {
                required: true,
                maxlength: 50, //Sesuai dengan data base
            },
            hlm: {
                required: true,
            },
            ac: {
                required: true,
            },
            ks: {
                required: true,
            },
            ts: {
                required: true,
            },
            bp: {
                required: true,
            },
            bs: {
                required: true,
            },
            plt: {
                required: true,
            },
        },
        messages: {
            type_motor: {
                required: "Type Motor tidak boleh kosong",
                maxlength: "Type Motor 50 Karakter"
            },
            merk: {
                required: "Merk tidak boleh kosong",
                maxlength: "Type Motor 50 Karakter"
            },
            hlm: {
                required: "HLM wajib dipilih",
            },
            ac: {
                required: "AC wajib dipilih",
            },
            ks: {
                required: "KS wajib dipilih",
            },
            ts: {
                required: "TS wajib dipilih",
            },
            bp: {
                required: "TS wajib dipilih",
            },
            bs: {
                required: "TS wajib dipilih",
            },
            plt: {
                required: "TS wajib dipilih",
            },
        }
    });
});