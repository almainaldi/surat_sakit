$().ready(function(){
    $('#type_defect').select2({
        placeholder: 'Pilih Type Motor',
    });

    $('#form').validate({
        rules:{
            type_defect:{
                required:true,
                //maxlength:50, //Sesuai dengan data base
            },
            warna_defect:{
                required:true,
                maxlength:50,
            },
            no_engine:{
                required:true,
                maxlength:12,
            },
            //KIRI
            sayap_l:{
                required:true,
                maxlength:2,
                number: true
            },
            spakbor_depan:{
                required:true,
                maxlength:2,
                number: true
            },
            body_l:{
                required:true,
                maxlength:2,
                number: true
            },
            //KANAN
            sayap_r:{
                required:true,
                maxlength:2,
                number: true
            },
            spakbor_belakang:{
                required:true,
                maxlength:2,
                number: true
            },
            body_r:{
                required:true,
                maxlength:2,
                number: true
            },

            batok:{
                required:true,
                maxlength:2,
                number: true
            },
            knalpot:{
                required:true,
                maxlength:2,
                number: true
            },
            //KIRI
            stang_l:{
                required:true,
                maxlength:2,
                number: true
            },
            striping_l:{
                required:true,
                maxlength:2,
                number: true
            },
            //KANAN
            stang_r:{
                required:true,
                maxlength:2,
                number: true
            },
            striping_r:{
                required:true,
                maxlength:2,
                number: true
            },

            detail_part:{
                required:true,
                maxlength:255
            },
            penyebab:{
                required:true,
                maxlength:255
            }
        },
        messages:{
            type_defect:{
                required:"Type Motor tidak boleh kosong",
                //maxlength:"Nama Karyawan maksimal 50 karakter"
            },
            warna_defect:{
                required:"Warna tidak boleh kosong",
                maxlength:"Divisi maksimal 50 karakter"
            },
            no_engine:{
                required:"No Mesin tidak boleh kosong",
                maxlength:"No Mesin maksimal 12 karakter"
            },
            //KIRI
            sayap_l:{
                required:"Sayap L tidak boleh kosong",
                maxlength:"Sayap L maksimal 2 karakter",
                number:"Sayap L Di Input Nomer"
            },
            spakbor_depan:{
                required:"Spakbor Depan tidak boleh kosong",
                maxlength:"Spakbor Depan maksimal 2 karakter",
                number:"Spakbor Depan Di Input Nomer"
            },
            body_l:{
                required:"Body L tidak boleh kosong",
                maxlength:"Body L maksimal 2 karakter",
                number:"Body L Di Input Nomer"
            },
            //KANAN
            sayap_r:{
                required:"Sayap R tidak boleh kosong",
                maxlength:"Sayap R maksimal 2 karakter",
                number:"Sayap R Di Input Nomer"
            },
            spakbor_belakang:{
                required:"Spakbor Belakang tidak boleh kosong",
                maxlength:"Spakbor Belakang maksimal 2 karakter",
                number:"Spakbor Belakang Di Input Nomer"
            },
            body_r:{
                required:"Body R tidak boleh kosong",
                maxlength:"Body R maksimal 2 karakter",
                number:"Body R Di Input Nomer"
            },

            batok:{
                required:"Batok tidak boleh kosong",
                maxlength:"Batok maksimal 2 karakter",
                number:"Batok Di Input Nomer"
            },
            knalpot:{
                required:"Knalpot tidak boleh kosong",
                maxlength:"Knalpot maksimal 2 karakter",
                number:"Knalpot Di Input Nomer"
            },
            //KIRI
            stang_l:{
                required:"Stang L tidak boleh kosong",
                maxlength:"Stang L maksimal 2 karakter",
                number:"Stang L Di Input Nomer"
            },
            striping_l:{
                required:"Striping L tidak boleh kosong",
                maxlength:"Striping L maksimal 2 karakter",
                number:"Striping L Di Input Nomer"
            },
            //KANAN
            stang_r:{
                required:"Stang R tidak boleh kosong",
                maxlength:"Stang R maksimal 2 karakter",
                number:"Stang R Di Input Nomer"
            },
            striping_r:{
                required:"Striping R tidak boleh kosong",
                maxlength:"Striping R maksimal 2 karakter",
                number:"Striping R Di Input Nomer"
            },

            detail_part:{
                required:"Detail Part tidak boleh kosong",
                maxlength:"Detail Part maksimal 255 karakter"
            },
            penyebab:{
                required:"penyebab tidak boleh kosong",
                maxlength:"penyebab maksimal 255 karakter"
            }
        }
    });
});