$().ready(function() {
    $('#form').validate({
        rules: {
            hlm_2: {
                required: true,
                maxlength: 3,
                number: true,
            },
            ac_2: {
                required: true,
                maxlength: 3,
                number: true,
            },
            ks_2: {
                required: true,
                maxlength: 3,
                number: true,

            },
            ts_2: {
                required: true,
                maxlength: 3,
                number: true,
            },
            bp_2: {
                required: true,
                maxlength: 3,
                number: true,

            },
            bs_2: {
                required: true,
                maxlength: 3,
                number: true,
            },
            plt_2: {
                required: true,
                maxlength: 3,
                number: true,
            },
            stay_2: {
                required: true,
                maxlength: 3,
                number: true,
            },

            hlm_3: {
                required: true,
                maxlength: 3,
                number: true,
            },
            ac_3: {
                required: true,
                maxlength: 3,
                number: true,
            },
            ks_3: {
                required: true,
                maxlength: 3,
                number: true,

            },
            ts_3: {
                required: true,
                maxlength: 3,
                number: true,
            },
            bp_3: {
                required: true,
                maxlength: 3,
                number: true,

            },
            bs_3: {
                required: true,
                maxlength: 3,
                number: true,
            },
            plt_3: {
                required: true,
                maxlength: 3,
                number: true,
            },
            stay_3: {
                required: true,
                maxlength: 3,
                number: true,
            },
        },
        messages: {
            tujuan_req: {
                required: "Nama Tujuan tidak boleh kosong",
                maxlength: "Nama Tujuan maksimal 10 karakter",
            },
            plant_req: {
                required: "Plant tidak boleh kosong",
                maxlength: "Plant maksimal 50 karakter"
            },
            type_req: {
                required: "Type tidak boleh kosong",
                maxlength: "Type maksimal 4 karakter",

            },
            jenis_req_1: {
                required: "No Kendaraan tidak boleh kosong",
                maxlength: "No Kendaraan maksimal 4 karakter",

            },
            supir_req_1: {
                required: "Nama Supir tidak boleh kosong",
                maxlength: "Jenis Kendaraan maksimal 4 karakter",

            },
            jumlah_req_1: {
                required: "Jumlah Unit motor tidak boleh kosong",
                maxlength: "Jumlah Unit motor maksimal 10 karakter",
                number: "Jumlah Unit motor harus berupa angka"
            },
            jumlah_req_2: {
                required: "Jumlah Unit motor tidak boleh kosong",
                maxlength: "Jumlah Unit motor maksimal 10 karakter",
                number: "Jumlah Unit motor harus berupa angka"
            },
            jumlah_req_3: {
                required: "Jumlah Unit motor tidak boleh kosong",
                maxlength: "Jumlah Unit motor maksimal 10 karakter",
                number: "Jumlah Unit motor harus berupa angka"
            },
            jumlah_req_4: {
                required: "Jumlah Unit motor tidak boleh kosong",
                maxlength: "Jumlah Unit motor maksimal 10 karakter",
                number: "Jumlah Unit motor harus berupa angka"
            },
        }
    });
});