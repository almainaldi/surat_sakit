$(document).ready(function() {
    $('#tujuan_daerah').select2({
        placeholder: 'Pilih Daerah Tujuan',
        language: "id"
    });

    $('#form').validate({
        rules: {
            type_1: {
                required: true,
                maxlength: 50, //Sesuai dengan data base
            },
            type_2: {
                required: true,
                maxlength: 50, //Sesuai dengan data base
            },
            type_3: {
                required: true,
                maxlength: 50, //Sesuai dengan data base
            },
            type_4: {
                required: true,
                maxlength: 50, //Sesuai dengan data base
            },
            type_5: {
                required: true,
                maxlength: 50, //Sesuai dengan data base
            },
            type_6: {
                required: true,
                maxlength: 50, //Sesuai dengan data base
            },
            type_7: {
                required: true,
                maxlength: 50, //Sesuai dengan data base
            },
            type_8: {
                required: true,
                maxlength: 50, //Sesuai dengan data base
            },
            type_9: {
                required: true,
                maxlength: 50, //Sesuai dengan data base
            },
            type_10: {
                required: true,
                maxlength: 50, //Sesuai dengan data base
            },
            jumlah_1: {
                required: true,
                maxlength: 10, //Sesuai dengan data base
                number: true
            },
            jumlah_2: {
                required: true,
                maxlength: 10, //Sesuai dengan data base
                number: true
            },
            jumlah_3: {
                required: true,
                maxlength: 10, //Sesuai dengan data base
                number: true
            },
            jumlah_4: {
                required: true,
                maxlength: 10, //Sesuai dengan data base
                number: true
            },
            jumlah_5: {
                required: true,
                maxlength: 10, //Sesuai dengan data base
                number: true
            },
            jumlah_6: {
                required: true,
                maxlength: 10, //Sesuai dengan data base
                number: true
            },
            jumlah_7: {
                required: true,
                maxlength: 10, //Sesuai dengan data base
                number: true
            },
            jumlah_8: {
                required: true,
                maxlength: 10, //Sesuai dengan data base
                number: true
            },
            jumlah_9: {
                required: true,
                maxlength: 10, //Sesuai dengan data base
                number: true
            },
            jumlah_10: {
                required: true,
                maxlength: 10, //Sesuai dengan data base
                number: true
            },
            // ########### UNTUK KELENGKAPAN ALAT2 ###########
            hlm_1: {
                required: true,
                maxlength: 10, //Sesuai dengan data base
                //number:true
            },
            ac_1: {
                required: true,
                maxlength: 10, //Sesuai dengan data base
                // number:true
            },
            ks_1: {
                required: true,
                maxlength: 10, //Sesuai dengan data base
                // number:true
            },
            ts_1: {
                required: true,
                maxlength: 10, //Sesuai dengan data base
                // number:true
            },
            bp_1: {
                required: true,
                maxlength: 10, //Sesuai dengan data base
                // number:true
            },
            bs_1: {
                required: true,
                maxlength: 10, //Sesuai dengan data base
                // number:true
            },
            plt_1: {
                required: true,
                maxlength: 10, //Sesuai dengan data base
                // number:true
            },
            stay_1: {
                required: true,
                maxlength: 10, //Sesuai dengan data base
                // number:true
            },
            hlm_2: {
                required: true,
                maxlength: 10, //Sesuai dengan data base
                // number:true
            },
            ac_2: {
                required: true,
                maxlength: 10, //Sesuai dengan data base
                // number:true
            },
            ks_2: {
                required: true,
                maxlength: 10, //Sesuai dengan data base
                // number:true
            },
            ts_2: {
                required: true,
                maxlength: 10, //Sesuai dengan data base
                // number:true
            },
            bp_2: {
                required: true,
                maxlength: 10, //Sesuai dengan data base
                // number:true
            },
            bs_2: {
                required: true,
                maxlength: 10, //Sesuai dengan data base
                // number:true
            },
            plt_2: {
                required: true,
                maxlength: 10, //Sesuai dengan data base
                // number:true
            },
            stay_2: {
                required: true,
                maxlength: 10, //Sesuai dengan data base
                // number:true
            },
            hlm_3: {
                required: true,
                maxlength: 10, //Sesuai dengan data base
                // number:true
            },
            ac_3: {
                required: true,
                maxlength: 10, //Sesuai dengan data base
                // number:true
            },
            ks_3: {
                required: true,
                maxlength: 10, //Sesuai dengan data base
                // number:true
            },
            ts_3: {
                required: true,
                maxlength: 10, //Sesuai dengan data base
                // number:true
            },
            bp_3: {
                required: true,
                maxlength: 10, //Sesuai dengan data base
                // number:true
            },
            bs_3: {
                required: true,
                maxlength: 10, //Sesuai dengan data base
                // number:true
            },
            plt_3: {
                required: true,
                maxlength: 10, //Sesuai dengan data base
                // number:true
            },
            stay_3: {
                required: true,
                maxlength: 10, //Sesuai dengan data base
                // number:true
            },
        },
        messages: {
            type_1: {
                required: "Type Motor tidak boleh kosong",
                maxlength: "Maksimal 50 Karakter",
            },
            type_2: {
                required: "Type Motor tidak boleh kosong",
                maxlength: "Maksimal 50 Karakter",
            },
            type_3: {
                required: "Type Motor tidak boleh kosong",
                maxlength: "Maksimal 50 Karakter",
            },
            type_4: {
                required: "Type Motor tidak boleh kosong",
                maxlength: "Maksimal 50 Karakter",
            },
            type_5: {
                required: "Type Motor tidak boleh kosong",
                maxlength: "Maksimal 50 Karakter",
            },
            type_6: {
                required: "Type Motor tidak boleh kosong",
                maxlength: "Maksimal 50 Karakter",
            },
            type_7: {
                required: "Type Motor tidak boleh kosong",
                maxlength: "Maksimal 50 Karakter",
            },
            type_8: {
                required: "Type Motor tidak boleh kosong",
                maxlength: "Maksimal 50 Karakter",
            },
            type_9: {
                required: "Type Motor tidak boleh kosong",
                maxlength: "Maksimal 50 Karakter",
            },
            type_10: {
                required: "Type Motor tidak boleh kosong",
                maxlength: "Maksimal 50 Karakter",
            },
            jumlah_1: {
                required: "Jumlah tidak boleh kosong",
                maxlength: "Maksimal 50 Karakter",
                number: "Jumlah harus berupa angka"
            },
            jumlah_2: {
                required: "Jumlah tidak boleh kosong",
                maxlength: "Maksimal 50 Karakter",
                number: "Jumlah harus berupa angka"
            },
            jumlah_3: {
                required: "Jumlah tidak boleh kosong",
                maxlength: "Maksimal 50 Karakter",
                number: "Jumlah harus berupa angka"
            },
            jumlah_4: {
                required: "Jumlah tidak boleh kosong",
                maxlength: "Maksimal 50 Karakter",
                number: "Jumlah harus berupa angka"
            },
            jumlah_5: {
                required: "Jumlah tidak boleh kosong",
                maxlength: "Maksimal 50 Karakter",
                number: "Jumlah harus berupa angka"
            },
            jumlah_6: {
                required: "Jumlah tidak boleh kosong",
                maxlength: "Maksimal 50 Karakter",
                number: "Jumlah harus berupa angka"
            },
            jumlah_7: {
                required: "Jumlah tidak boleh kosong",
                maxlength: "Maksimal 50 Karakter",
                number: "Jumlah harus berupa angka"
            },
            jumlah_8: {
                required: "Jumlah tidak boleh kosong",
                maxlength: "Maksimal 50 Karakter",
                number: "Jumlah harus berupa angka"
            },
            jumlah_9: {
                required: "Jumlah tidak boleh kosong",
                maxlength: "Maksimal 50 Karakter",
                number: "Jumlah harus berupa angka"
            },
            jumlah_10: {
                required: "Jumlah tidak boleh kosong",
                maxlength: "Maksimal 50 Karakter",
                number: "Jumlah harus berupa angka"
            },
            hlm_1: {
                required: "HLM tidak boleh kosong",
                maxlength: "Maksimal 3 Karakter",
                // number: "HLM harus berupa angka"
            },
            ac_1: {
                required: "AC tidak boleh kosong",
                maxlength: "Maksimal 3 Karakter",
                // number: "AC harus berupa angka"
            },
            ks_1: {
                required: "KS tidak boleh kosong",
                maxlength: "Maksimal 3 Karakter",
                // number: "KS harus berupa angka"
            },
            ts_1: {
                required: "TS tidak boleh kosong",
                maxlength: "Maksimal 3 Karakter",
                // number: "TS harus berupa angka"
            },
            bp_1: {
                required: "BP tidak boleh kosong",
                maxlength: "Maksimal 3 Karakter",
                // number: "BP harus berupa angka"
            },
            bs_1: {
                required: "BS tidak boleh kosong",
                maxlength: "Maksimal 3 Karakter",
                // number: "BS harus berupa angka"
            },
            plt_1: {
                required: "PLT tidak boleh kosong",
                maxlength: "Maksimal 3 Karakter",
                // number: "PLT harus berupa angka"
            },
            stay_1: {
                required: "Stay L/R tidak boleh kosong",
                maxlength: "Maksimal 3 Karakter",
                // number: "TB harus berupa angka"
            },
            hlm_2: {
                required: "HLM tidak boleh kosong",
                maxlength: "Maksimal 3 Karakter",
                // number: "HLM harus berupa angka"
            },
            ac_2: {
                required: "AC tidak boleh kosong",
                maxlength: "Maksimal 3 Karakter",
                // number: "AC harus berupa angka"
            },
            ks_2: {
                required: "KS tidak boleh kosong",
                maxlength: "Maksimal 3 Karakter",
                // number: "KS harus berupa angka"
            },
            ts_2: {
                required: "TS tidak boleh kosong",
                maxlength: "Maksimal 3 Karakter",
                // number: "TS harus berupa angka"
            },
            bp_2: {
                required: "BP tidak boleh kosong",
                maxlength: "Maksimal 3 Karakter",
                // number: "BP harus berupa angka"
            },
            bs_2: {
                required: "BS tidak boleh kosong",
                maxlength: "Maksimal 3 Karakter",
                // number: "BS harus berupa angka"
            },
            plt_2: {
                required: "PLT tidak boleh kosong",
                maxlength: "Maksimal 3 Karakter",
                // number: "PLT harus berupa angka"
            },
            stay_2: {
                required: "Stay L/R tidak boleh kosong",
                maxlength: "Maksimal 3 Karakter",
                // number: "TB harus berupa angka"
            },
            hlm_3: {
                required: "HLM tidak boleh kosong",
                maxlength: "Maksimal 3 Karakter",
                // number: "HLM harus berupa angka"
            },
            ac_3: {
                required: "AC tidak boleh kosong",
                maxlength: "Maksimal 3 Karakter",
                // number: "AC harus berupa angka"
            },
            ks_3: {
                required: "KS tidak boleh kosong",
                maxlength: "Maksimal 3 Karakter",
                // number: "KS harus berupa angka"
            },
            ts_3: {
                required: "TS tidak boleh kosong",
                maxlength: "Maksimal 3 Karakter",
                // number: "TS harus berupa angka"
            },
            bp_3: {
                required: "BP tidak boleh kosong",
                maxlength: "Maksimal 3 Karakter",
                // number: "BP harus berupa angka"
            },
            bs_3: {
                required: "BS tidak boleh kosong",
                maxlength: "Maksimal 3 Karakter",
                // number: "BS harus berupa angka"
            },
            plt_3: {
                required: "PLT tidak boleh kosong",
                maxlength: "Maksimal 3 Karakter",
                // number: "PLT harus berupa angka"
            },
            stay_3: {
                required: "Stay L/R tidak boleh kosong",
                maxlength: "Maksimal 3 Karakter",
                // number: "TB harus berupa angka"
            },
        }
    });
});