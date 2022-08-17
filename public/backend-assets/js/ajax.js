$(document).ready(function () {

    $("#faqsArea").load("/admin/sorular-alani");
    $("#accountsArea").load("/admin/banka-hesaplari-alani");
    $("#paymentNoticeAdminArea").load("/admin/odeme-bildirimleri-alani");
    $("#pendingOrdersAdminArea").load("/admin/bekleyen-siparisler-alani");
    $("#controlledOrdersAdminArea").load("/admin/kontrol-edilen-siparisler-alani");
    $("#processedOrdersAdminArea").load("/admin/islenen-siparisler-alani");
    $("#categoryArea").load("/admin/kategori-alani");
    $("#contactInboxArea").load("/admin/iletim-gelen-kutusu-alani");
    $("#productArea").load("/admin/urun-alani");

    $("#cartArea").load("/sepet-alani");
    $("#orderArea").load("/siparislerim-alani");
    $("#paymentNoticeArea").load("/odeme-bildirimlerim-alani");

    $("#adminUserArea").load("/admin/admin-kullanici-alani");
    $("#clientUserArea").load("/admin/musteri-kullanici-alani");

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".sortable").sortable();
    $(".sortable").on("sortupdate", function (event, ui) {

        var data = $(this).sortable("serialize");

        $.ajax({
            type: "POST",
            url: "/admin/urun-resim-sirala",
            data: {data: data},
            success: function (response) {
                if (response === "success") {
                    toastr["success"]("Sıralama Başarılı!");
                }
            }
        });

    });


    $("#createClient").hide();
    $("#createAdmin").hide();
    $("#createAreaUserRole").on("change", function () {
        var value = $(this).val();

        if (value === "client") {
            $("#createAdmin").hide();
            $("#createClient").show();
        } else if (value === "admin") {
            $("#createClient").hide();
            $("#createAdmin").show();
        } else {
            $("#createClient").hide();
            $("#createAdmin").hide();
        }
    });


    function sweetAlert(icon, title, showConfirmButton, timer) {
        Swal.fire({
            position: 'center',
            icon: icon,
            title: title,
            showConfirmButton: showConfirmButton,
            confirmButtonText: "Tamam",
            timer: timer
        });
    }

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-left",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": 300,
        "hideDuration": 1000,
        "timeOut": 2000,
        "extendedTimeOut": 1000,
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    $("#addToCart").on("click", function () {

        $.ajax({
            type: "POST",
            url: "/sepete-ekle",
            data: {
                productId: $(this).attr("product-id"),
                productAmount: $("#productAmount").val()
            },
            success: function (response) {

                var data = JSON.parse(response);

                if (data === "not_enough_products") {
                    toastr["error"]("Stok Yeterli Değil");
                } else if (data === "null") {
                    toastr["error"]("Ürün Miktarı Geçersiz!");
                } else if (data["status"] === "success") {
                    toastr["success"]("Ürün Sepete Eklendi!");
                    $("#cartCount").text(data["cartCount"]);
                } else {
                    document.write(data);
                }
            }
        });

    });
    $("body").on("click", "#deleteFromCart", function () {

        $.ajax({
            type: "POST",
            url: "/sepet-urun-sil",
            data: {
                productId: $(this).attr("product-id")
            },
            success: function (response) {

                var data = JSON.parse(response);

                if (data["status"] === 'success') {
                    toastr["success"]("Ürün Sepetten Silindi!");
                    $("#cartArea").load("/sepet-alani");
                    $("#cartCount").text(data["cartCount"]);
                } else if (data["status"] === "failed") {
                    toastr["warning"]("İşlem Başarısız!");
                } else {
                    document.write(response);
                }
            }
        });

    });
    $("body").on("click", "#checkoutOrder", function () {

        $.ajax({
            type: "POST",
            url: "/siparis-ver",
            success: function (response) {

                var data = JSON.parse(response);

                if (data["status"] === 'success') {

                    window.location.href = data["link"]

                } else if (data["status"] === 'not_enough_product') {
                    sweetAlert("error", "Stokta Yeterli Ürün Yok... Lütfen Sepetinizi Güncelleyin!", true, null);
                } else if (data["status"] === 'failed') {
                    sweetAlert("error", "Sipariş Oluşturma Hatası! Sepetinizi Güncelleyin...", true, null);
                } else {
                    document.write(data);
                }
            }
        });

    });
    $("body").on("click", "#cancelOrder", function () {

        var orderNo = $(this).attr("order-no");

        Swal.fire({
            title: "#" + orderNo + " No'lu Siparişi İptal Etmek İstiyor musunuz?",
            text: "",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: "Onayla",
            cancelButtonText: "Vazgeç",
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: "POST",
                    url: "/siparis-iptal",
                    data: {
                        orderNo: orderNo
                    },
                    success: function (response) {

                        if (response === 'success') {
                            toastr["success"]("Sipariş İptal Edildi!");
                            $("#orderArea").load("/siparislerim-alani");
                        } else if (response === "failed") {
                            toastr["warning"]("Ödeme Bildirimi Yapılan Sipariş İptal Edilemez!");
                        } else {
                            document.write(response);
                        }
                    }
                });

            }

        });
    });
    $("#updateProfile").on("click", function () {

        $.ajax({
            type: "POST",
            url: "/profil-guncelle",
            data: $("#editClientForm").serialize(),
            success: function (response) {
                if (response === "success") {
                    toastr["success"]("Kullanıcı Başarıyla Güncellendi!");
                } else if (response === "failed") {
                    toastr["error"]("İşlem Başarısız!");
                }
            }
        });

    });
    $("#createPaymentNoticeForm").validate({
        rules: {
            bank_account: {
                required: true
            },
            total_amount: {
                required: true
            },
            order_no: {
                required: true
            },
            name: {
                required: true
            },
            company_name: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true
            },
            identity_number: {
                required: true,
                minlength: 11,
                maxlength: 11
            },
        },
        messages: {
            bank_account: "Bu Alan Zorunludur!",
            total_amount: "Bu Alan Zorunludur!",
            order_no: "Bu Alan Zorunludur!",
            name: "Bu Alan Zorunludur!",
            company_name: "Bu Alan Zorunludur!",
            phone: "Bu Alan Zorunludur!",
            email: {required: "Bu Alan Zorunludur!", email: "Email Adresi Geçersiz"},
            identity_number: {
                required: "Bu Alan Zorunludur!",
                minlength: "Bu Alan 11 Karakterli Olmalı!",
                maxlength: "Bu Alan 11 Karakterli Olmalı!"
            }
        },
        submitHandler: function (form) {

            Swal.fire({
                title: "Gönderilen Ödeme Bildirimi İptal Edilemez! Bilgilerinizi Kontrol Edin...",
                text: "",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#34c38f",
                cancelButtonColor: "#f46a6a",
                confirmButtonText: "Gönder",
                cancelButtonText: "Kontrol Et",
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        type: form.method,
                        url: form.action,
                        data: $("#createPaymentNoticeForm").serialize(),
                        success: function (response) {
                            if (response === "success") {
                                toastr["success"]("Ödeme Bildirimi Oluşturuldu!");
                                $("#bank_account").val("");
                                $("#total_amount").val("");
                                $("#order_no").val("");
                                setTimeout(function () {
                                    window.location.reload();
                                }, 500);
                            } else if (response === "failed") {
                                toastr["error"]("İşlem Başarısız!");
                            } else {
                                document.write(response);
                            }
                        }
                    });

                }
            });
        }
    });

    /*---------------------------------------------------------------------------------------------------------------*/

    $("#settingsForm").validate({
        rules: {
            company_name: {required: true},
            title: {required: true},
            description: {required: true},
            keywords: {required: true},
            copyright: {required: true},
            city: {required: true},
            phone: {required: true},
            email: {required: true},
            address: {required: true},
            whatsapp: {required: true},
            smtp_host: {required: true},
            smtp_port: {required: true},
            smtp_username: {required: true},
            contact_smtp_username: {required: true},
            smtp_password: {required: true},
            vision: {required: true},
            mission: {required: true},
            experience_year: {required: true},
            experience_title: {required: true},
            experience_small_title: {required: true},

            privacy_policy: {required: true},
            cookie_policy: {required: true}
        },
        messages: {
            company_name: {required: "Bu Alan Zorunludur!"},
            title: {required: "Bu Alan Zorunludur!"},
            description: {required: "Bu Alan Zorunludur!"},
            keywords: {required: "Bu Alan Zorunludur!"},
            copyright: {required: "Bu Alan Zorunludur!"},
            city: {required: true},
            phone: {required: "Bu Alan Zorunludur!"},
            email: {required: "Bu Alan Zorunludur!"},
            address: {required: "Bu Alan Zorunludur!"},
            whatsapp: {required: "Bu Alan Zorunludur!"},
            smtp_host: {required: "Bu Alan Zorunludur!"},
            smtp_port: {required: "Bu Alan Zorunludur!"},
            smtp_username: {required: "Bu Alan Zorunludur!"},
            contact_smtp_username: {required: "Bu Alan Zorunludur!"},
            smtp_password: {required: "Bu Alan Zorunludur!"},
            vision: {required: "Bu Alan Zorunludur!"},
            mission: {required: "Bu Alan Zorunludur!"},
            experience_year: {required: "Bu Alan Zorunludur!"},
            experience_title: {required: "Bu Alan Zorunludur!"},
            experience_small_title: {required: "Bu Alan Zorunludur!"},
            privacy_policy: {required: "Bu Alan Zorunludur!"},
            cookie_policy: {required: "Bu Alan Zorunludur!"}
        },
        submitHandler: function (form) {

            $.ajax({
                type: form.method,
                url: form.action,
                data: $("#settingsForm").serialize(),
                success: function (response) {
                    if (response === "success") {
                        toastr["success"]("Ayarlar Güncellendi!");
                    } else if (response === "no_change") {
                        toastr["warning"]("Değişiklik Yapmadınız!");
                    } else {
                        document.write(response);
                    }
                }
            });

        }
    });
    $("#btn-updateImage").on("click", function () {

        method = $("#settingsImageForm").attr("method");
        url = $("#settingsImageForm").attr("action");
        enctype = $("#settingsImageForm").attr("enctype");
        var form = $("#settingsImageForm")[0];

        $.ajax({
            url: url,
            type: method,
            data: new FormData(form),
            enctype: enctype,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function () {
                if ($('#logo')[0].files.length !== 0 || $('#favicon')[0].files.length !== 0) {
                    toastr["info"]("Dosyalar Yükleniyor!");
                }
            },
            success: function (response) {
                if (response === "success") {
                    window.location.reload();
                } else if (response === "failed") {
                    toastr["error"]("Güncelleme Başarısız!");
                } else if (response === "logo_is_too_big") {
                    toastr["warning"]("Logo Çok Büyük! (Max 10MB)");
                } else if (response === "logo_type_not_supported") {
                    toastr["warning"]("Logo Dosyası Desteklenmiyor!");
                } else if (response === "favicon_is_too_big") {
                    toastr["warning"]("Favicon Çok Büyük! (Max 10MB)");
                } else if (response === "favicon_type_not_supported") {
                    toastr["warning"]("Favicon Dosyası Desteklenmiyor!");
                } else if (response === "file_not_selected") {
                    toastr["warning"]("Dosya Seçilmedi!");
                } else {
                    document.write(response);
                }
            }
        });

    });
    $("#settingsRecaptchaForm").validate({
        rules: {
            sitekey: {required: true},
            secretkey: {required: true}
        },
        messages: {
            sitekey: {required: "Bu Alan Zorunludur!"},
            secretkey: {required: "Bu Alan Zorunludur!"}
        },
        submitHandler: function (form) {

            $.ajax({
                type: form.method,
                url: form.action,
                data: $("#settingsRecaptchaForm").serialize(),
                success: function (response) {
                    if (response === "success") {
                        toastr["success"]("Google Recaptcha Güncellendi!");
                    } else if (response === "no_change") {
                        toastr["warning"]("Değişiklik Yapmadınız!");
                    } else {
                        document.write(response);
                    }
                }
            });

        }
    });

    $("body").on("click", "#deleteFaq", function () {

        var faq_id = $(this).attr("faq-id");

        Swal.fire({
            title: "#" + faq_id + " ID'li Soruyu Silmek İstiyor musunuz?",
            text: "",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: "Sil",
            cancelButtonText: "Vazgeç",
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: "POST",
                    url: "/admin/soru-sil",
                    data: {
                        faq_id: faq_id
                    },
                    success: function (response) {

                        if (response === 'success') {
                            toastr["success"]("Soru Silindi!");
                            $("#faqsArea").load("/admin/sorular-alani");
                        } else if (response === "failed") {
                            toastr["error"]("İşlem Başarısız!");
                        }
                    }
                });

            }

        });
    });
    $("#createFaqsForm").validate({
        rules: {
            question: {required: true},
            answer: {required: true}
        },
        messages: {
            question: {required: "Bu Alan Zorunludur!"},
            answer: {required: "Bu Alan Zorunludur!"}
        },
        submitHandler: function (form) {

            $.ajax({
                type: form.method,
                url: form.action,
                data: $("#createFaqsForm").serialize(),
                success: function (response) {
                    if (response === "success") {
                        toastr["success"]("Soru Eklendi!");
                        $("#question").val("");
                        $("#answer").val("");
                    } else if (response === "failed") {
                        toastr["error"]("İşlem Başarısız!");
                    } else if (response === "question_already_exists") {
                        toastr["warning"]("Soru Zaten Var!");
                    }
                }
            });

        }
    });
    $("#updateFaqsForm").validate({
        rules: {
            question: {required: true},
            answer: {required: true}
        },
        messages: {
            question: {required: "Bu Alan Zorunludur!"},
            answer: {required: "Bu Alan Zorunludur!"}
        },
        submitHandler: function (form) {

            $.ajax({
                type: form.method,
                url: form.action,
                data: $("#updateFaqsForm").serialize(),
                success: function (response) {
                    if (response === "success") {
                        toastr["success"]("Soru Gündellendi!");
                    } else if (response === "failed") {
                        toastr["error"]("İşlem Başarısız!");
                    } else if (response === "question_already_exists") {
                        toastr["warning"]("Soru Zaten Var!");
                    }
                }
            });

        }
    });

    $("body").on("click", "#deleteAccount", function () {

        var account_id = $(this).attr("account-id");

        Swal.fire({
            title: "#" + account_id + " ID'li Hesabı Silmek İstiyor musunuz?",
            text: "",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: "Sil",
            cancelButtonText: "Vazgeç",
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: "POST",
                    url: "/admin/banka-hesabi-sil",
                    data: {
                        account_id: account_id
                    },
                    success: function (response) {

                        if (response === 'success') {
                            toastr["success"]("Hesap Silindi!");
                            $("#accountsArea").load("/admin/banka-hesaplari-alani");
                        } else if (response === "failed") {
                            toastr["error"]("İşlem Başarısız!");
                        }
                    }
                });

            }

        });
    });
    $("#createAccountForm").validate({
        rules: {
            bank_name: {required: true},
            account_owner: {required: true},
            iban: {required: true}
        },
        messages: {
            bank_name: {required: "Bu Alan Zorunludur!"},
            account_owner: {required: "Bu Alan Zorunludur!"},
            iban: {required: "Bu Alan Zorunludur!"}
        },
        submitHandler: function (form) {

            $.ajax({
                type: form.method,
                url: form.action,
                data: $("#createAccountForm").serialize(),
                success: function (response) {
                    if (response === "success") {
                        toastr["success"]("Hesap Eklendi!");
                        $("#bank_name").val("");
                        $("#iban").val("");
                        $("#account_owner").val("");
                    } else if (response === "failed") {
                        toastr["error"]("İşlem Başarısız!");
                    } else if (response === "account_already_exists") {
                        toastr["warning"]("Hesap Bilgileri Zaten Kullanılıyor!");
                    }
                }
            });

        }
    });
    $("#updateAccountForm").validate({
        rules: {
            bank_name: {required: true},
            account_owner: {required: true},
            iban: {required: true}
        },
        messages: {
            bank_name: {required: "Bu Alan Zorunludur!"},
            account_owner: {required: "Bu Alan Zorunludur!"},
            iban: {required: "Bu Alan Zorunludur!"}
        },
        submitHandler: function (form) {

            $.ajax({
                type: form.method,
                url: form.action,
                data: $("#updateAccountForm").serialize(),
                success: function (response) {
                    if (response === "success") {
                        toastr["success"]("Hesap Güncellendi!");
                    } else if (response === "failed") {
                        toastr["error"]("İşlem Başarısız!");
                    } else if (response === "account_already_exists") {
                        toastr["warning"]("IBAN Zaten Kullanılıyor!");
                    }
                }
            });

        }
    });

    $("body").on("click", "#confirm_payment", function () {

        var payment_order_no = $(this).attr("payment-order-no");
        var payment_id = $(this).attr("payment-id");

        Swal.fire({
            title: "#" + payment_order_no + " No'lu Ödemeyi Onaylamak İstiyor musunuz?",
            text: "",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: "Onayla",
            cancelButtonText: "Vazgeç",
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: "POST",
                    url: "/admin/odeme-onayla",
                    data: {
                        payment_order_no: payment_order_no,
                        payment_id: payment_id
                    },
                    success: function (response) {

                        if (response === 'success') {
                            toastr["success"]("Ödeme Bildirimi Onaylandı!");
                            $("#paymentNoticeAdminArea").load("/admin/odeme-bildirimleri-alani");
                        } else if (response === "failed") {
                            toastr["error"]("İşlem Başarısız!");
                        }
                    }
                });

            }

        });
    });
    $("body").on("click", "#cancel_payment", function () {

        $.ajax({
            type: $("#cancelPaymentForm").attr("method"),
            url: $("#cancelPaymentForm").attr("action"),
            data: $("#cancelPaymentForm").serialize(),
            success: function (response) {

                if (response === 'success') {
                    $("#close_modal").trigger("click");
                    $("#close_modal2").trigger("click");
                    toastr["success"]("Ödeme Bildirimi İptal Edildi!");
                    $("#paymentNoticeAdminArea").load("/admin/odeme-bildirimleri-alani");
                } else if (response === "failed") {
                    toastr["error"]("İşlem Başarısız!");
                }else{
                    document.write(response);
                }
            }
        });
    });


    $("body").on("click", "#confirmOrderAdmin", function () {

        var orderNo = $(this).attr("order-no");

        Swal.fire({
            title: "#" + orderNo + " No'lu Siparişi Onaylamak İstiyor musunuz?",
            text: "",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: "Onayla",
            cancelButtonText: "Vazgeç",
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: "POST",
                    url: "/admin/siparis-onay",
                    data: {
                        orderNo: orderNo
                    },
                    success: function (response) {

                        if (response === 'success') {
                            toastr["success"]("Sipariş Onaylandı!");
                            $("#pendingOrdersAdminArea").load("/admin/bekleyen-siparisler-alani");
                            $("#controlledOrdersAdminArea").load("/admin/kontrol-edilen-siparisler-alani");
                            $("#processedOrdersAdminArea").load("/admin/islenen-siparisler-alani");
                        } else if (response === "failed") {
                            toastr["warning"]("İşlem Başarısız!");
                        }
                    }
                });

            }

        });
    });
    $("body").on("click", "#cancelOrderAdmin", function () {


        $.ajax({
            type: $("#cancelOrderForm").attr("method"),
            url: $("#cancelOrderForm").attr("action"),
            data: $("#cancelOrderForm").serialize(),
            success: function (response) {

                if (response === 'success') {
                    $("#close_modal").trigger("click");
                    toastr["success"]("Sipariş İptal Edildi!");
                    $("#pendingOrdersAdminArea").load("/admin/bekleyen-siparisler-alani");
                    $("#controlledOrdersAdminArea").load("/admin/kontrol-edilen-siparisler-alani");
                    $("#processedOrdersAdminArea").load("/admin/islenen-siparisler-alani");
                } else if (response === "failed") {
                    toastr["warning"]("İşlem Başarısız!");
                } else {
                    document.write(response);
                }
            }
        });

    });

    $("#createCategoryForm").validate({
        rules: {
            title: {required: true}
        },
        messages: {
            title: {required: "Bu Alan Zorunludur!"}
        },
        submitHandler: function (form) {

            $.ajax({
                type: form.method,
                url: form.action,
                data: $("#createCategoryForm").serialize(),
                success: function (response) {
                    if (response === "success") {
                        $("#title").val("");
                        toastr["success"]("Kategori Eklendi!");
                        $("#categoryArea").load("/admin/kategori-alani");
                    } else if (response === "category_already_exists") {
                        toastr["warning"]("Kategori Zaten var!");
                    } else if (response === "failed") {
                        toastr["error"]("İşlem Başarısız!");
                    } else {
                        document.write(response);
                    }
                }
            });

        }
    });
    $("#updateCategoryForm").validate({
        rules: {
            title: {required: true}
        },
        messages: {
            title: {required: "Bu Alan Zorunludur!"}
        },
        submitHandler: function (form) {

            $.ajax({
                type: form.method,
                url: form.action,
                data: $("#updateCategoryForm").serialize(),
                success: function (response) {
                    if (response === "success") {
                        toastr["success"]("Kategori Güncellendi!");
                    } else if (response === "category_already_exists") {
                        toastr["warning"]("Kategori Zaten var!");
                    } else if (response === "failed") {
                        toastr["error"]("İşlem Başarısız!");
                    } else {
                        document.write(response);
                    }
                }
            });

        }
    });
    $("body").on("click", "#deleteCategory", function () {

        var category_id = $(this).attr("category-id");

        Swal.fire({
            title: "#" + category_id + " ID'li Kategori'yi Kaldırınca Bu Kategori'deki Tüm Ürünler Silinecektir! Devam Etmek İstiyor musunuz?",
            text: "",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: "Kaldır",
            cancelButtonText: "Vazgeç",
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: "POST",
                    url: "/admin/kategori-sil",
                    data: {
                        category_id: category_id
                    },
                    success: function (response) {

                        if (response === 'success') {
                            toastr["success"]("Kategori Silindi!");
                            $("#categoryArea").load("/admin/kategori-alani");
                        } else if (response === "failed") {
                            toastr["error"]("İşlem Başarısız!");
                        } else {
                            document.write(response);
                        }
                    }
                });

            }

        });
    });
    $("body").on("click", "#changeCategoryStatus", function () {

        var category_id = $(this).attr("category-id");
        var category_status = $(this).attr("status");

        if (category_status === "1") {
            var message = "#" + category_id + " ID'li Kategori'deki Ürünler Gizlenecektir! Devam Etmek İstiyor musunuz?"
        } else {
            var message = "#" + category_id + " ID'li Kategori'deki Ürünler Gösterilmeye Devam Edecektir! Devam Etmek İstiyor musunuz?"
        }

        Swal.fire({
            title: message,
            text: "",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: "Güncelle",
            cancelButtonText: "Vazgeç",
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: "POST",
                    url: "/admin/kategori-durum-degistir",
                    data: {
                        category_id: category_id,
                        category_status: category_status
                    },
                    success: function (response) {

                        if (response === 'success') {
                            toastr["success"]("Kategori Güncellendi!");
                            $("#categoryArea").load("/admin/kategori-alani");
                        } else if (response === "failed") {
                            toastr["error"]("İşlem Başarısız!");
                        } else {
                            document.write(response);
                        }
                    }
                });

            }

        });
    });


    $("body").on("click", "#deleteContactMessage", function () {

        var inbox_id = $(this).attr("inbox-id");

        Swal.fire({
            title: "#" + inbox_id + " ID'li Mesajı Silmek İstiyor musunuz?",
            text: "",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: "Sil",
            cancelButtonText: "Vazgeç",
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: "POST",
                    url: "/admin/iletisim-mesaji-sil",
                    data: {
                        inbox_id: inbox_id
                    },
                    success: function (response) {

                        if (response === 'success') {
                            toastr["success"]("Mesaj Silindi!");
                            $("#contactInboxArea").load("/admin/iletim-gelen-kutusu-alani");
                        } else if (response === "failed") {
                            toastr["error"]("İşlem Başarısız!");
                        } else {
                            document.write(response);
                        }
                    }
                });

            }

        });
    });

    $("#createAdminForm").validate({
        rules: {
            role: {required: true},
            name: {required: true},
            surname: {required: true},
            username: {required: true, minlength: 6},
            email: {required: true, email: true},
            password: {required: true, minlength: 6},
            phone: {required: true, minlength: 10, maxlength: 10},
            identity_number: {required: true, minlength: 11, maxlength: 11},
            address: {required: true},

        },
        messages: {
            role: "Bu Alan Zorunludur!",
            name: "Bu Alan Zorunludur!",
            surname: "Bu Alan Zorunludur!",
            username: {
                required: "Bu Alan Zorunludur!",
                minlength: "Oluşturduğunuz Kullanıcı Adı Minimum 6 Karakterli Olmalı!"
            },
            password: {
                required: "Bu Alan Zorunludur!",
                minlength: "Oluşturduğunuz Şifre Minimum 6 Karakterli Olmalı!"
            },
            email: {
                required: "Bu Alan Zorunludur!",
                email: "Lütfen Doğru Email Adresi Girin!"
            },
            phone: {
                required: "Bu Alan Zorunludur!",
                minlength: "Telefon Numaranız 10 Haneli Olmalı!",
                maxlength: "Telefon Numaranız 10 Haneli Olmalı!"
            },
            address: "Bu Alan Zorunludur!",
            identity_number: {
                required: "Bu Alan Zorunludur!",
                minlength: "Kimlik Numaranız 11 karakterli olmalıdır!",
                maxlength: "Kimlik Numaranız 11 karakterli olmalıdır!"
            },
        },
        submitHandler: function (form) {

            $.ajax({
                type: form.method,
                url: form.action,
                data: $("#createAdminForm").serialize(),
                success: function (response) {
                    if (response === "username_already_exists") {
                        toastr["warning"]("Kullanıcı Adı Zaten Kullanılıyor!!");
                    } else if (response === "email_already_exists") {
                        toastr["warning"]("Email Zaten Kullanılıyor!");
                    } else if (response === "id_already_exists") {
                        toastr["warning"]("TC Kimlik No Zaten Kullanılıyor!");
                    } else if (response === "phone_already_exists") {
                        toastr["warning"]("Telefon Numarası Zaten Kullanılıyor!");
                    } else if (response === "success") {
                        toastr["success"]("Kullanıcı Başarıyla Eklendi!!");
                        $("#role").val("");
                        $("#name").val("");
                        $("#surname").val("");
                        $("#username").val("");
                        $("#email").val("");
                        $("#password").val("");
                        $("#identity_number").val("");
                        $("#phone").val("");
                        $("#address").val("");
                    } else if (response === "failed") {
                        toastr["error"]("İşlem Başarısız!");
                    } else {
                        document.write(response);
                    }
                }
            });

        }
    });
    $("#createClientForm").validate({
        rules: {
            name: {required: true},
            surname: {required: true},
            username: {required: true, minlength: 6},
            email: {required: true, email: true},
            password: {required: true, minlength: 6},
            phone: {required: true, minlength: 10, maxlength: 10},
            identity_number: {required: true, minlength: 11, maxlength: 11},
            address: {required: true},
            tax_number: {required: true},
            company_name: {required: true},
            zip_code: {required: true},
            city: {required: true}
        },
        messages: {
            name: "Bu Alan Zorunludur!",
            surname: "Bu Alan Zorunludur!",
            username: {
                required: "Bu Alan Zorunludur!",
                minlength: "Oluşturduğunuz Kullanıcı Adı Minimum 6 Karakterli Olmalı!"
            },
            password: {
                required: "Bu Alan Zorunludur!",
                minlength: "Oluşturduğunuz Şifre Minimum 6 Karakterli Olmalı!"
            },
            email: {
                required: "Bu Alan Zorunludur!",
                email: "Lütfen Doğru Email Adresi Girin!"
            },
            phone: {
                required: "Bu Alan Zorunludur!",
                minlength: "Telefon Numaranız 10 Haneli Olmalı!",
                maxlength: "Telefon Numaranız 10 Haneli Olmalı!"
            },
            address: "Bu Alan Zorunludur!",
            identity_number: {
                required: "Bu Alan Zorunludur!",
                minlength: "Kimlik Numaranız 11 karakterli olmalıdır!",
                maxlength: "Kimlik Numaranız 11 karakterli olmalıdır!"
            },
            tax_number: {required: "Bu Alan Zorunludur!"},
            company_name: {required: "Bu Alan Zorunludur!"},
            zip_code: {required: "Bu Alan Zorunludur!"},
            city: {required: "Bu Alan Zorunludur!"}
        },
        submitHandler: function (form) {

            $.ajax({
                type: form.method,
                url: form.action,
                data: $("#createClientForm").serialize(),
                success: function (response) {
                    if (response === "username_already_exists") {
                        toastr["warning"]("Kullanıcı Adı Zaten Kullanılıyor!");
                    } else if (response === "email_already_exists") {
                        toastr["warning"]("Email Zaten Kullanılıyor!");
                    } else if (response === "id_already_exists") {
                        toastr["warning"]("TC Kimlik No Zaten Kullanılıyor!");
                    } else if (response === "phone_already_exists") {
                        toastr["warning"]("Telefon Kullanılıyor!");
                    } else if (response === "tax_already_exists") {
                        toastr["warning"]("Vergi Numarası Kullanılıyor!");
                    } else if (response === "success") {
                        toastr["success"]("Müşteri Başarıyla Eklendi!!");
                        $("#nameC").val("");
                        $("#surnameC").val("");
                        $("#usernameC").val("");
                        $("#emailC").val("");
                        $("#passwordC").val("");
                        $("#identity_numberC").val("");
                        $("#phoneC").val("");
                        $("#addressC").val("");
                        $("#tax_numberC").val("");
                        $("#company_nameC").val("");
                        $("#zip_codeC").val("");
                        $("#cityC").val("");
                    } else if (response === "failed") {
                        toastr["error"]("İşlem Başarısız!");
                    } else {
                        document.write(response);
                    }
                }
            });

        }
    });
    $("body").on("click", ".deleteUserButton", function () {

        var deleteUserId = $(this).attr("user-id");
        Swal.fire({
            title: "Bu işlemi Yaparsanız Kullanıcıya Ait Tüm Veriler Siteden Silinecektir! Devam Etmek İstiyor musun?",
            text: "",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: "Üyeyi Sil",
            cancelButtonText: "Vazgeç",
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: "POST",
                    url: "/admin/kullanici-sil",
                    data: {deleteUserId: deleteUserId},
                    success: function (result) {
                        if (result === "success") {
                            toastr["success"]("Kullanıcı Silindi!");
                            $("#adminUserArea").load("/admin/admin-kullanici-alani");
                            $("#clientUserArea").load("/admin/musteri-kullanici-alani");
                        } else if (result === "failed") {
                            toastr["error"]("Kullanıcı Silme Başarısız!");

                        } else if (result === "active_user_cannot_be_deleted") {
                            toastr["warning"]("Aktif Kullanıcı Silinemez!");
                        } else {
                            document.write(result);
                        }
                    }
                });

            }

        });

    });

    $("#editAdminForm").validate({
        rules: {
            role: {required: true},
            name: {required: true},
            surname: {required: true},
            username: {required: true, minlength: 6},
            email: {required: true, email: true},
            phone: {required: true, minlength: 10, maxlength: 10},
            identity_number: {required: true, minlength: 11, maxlength: 11},
            address: {required: true},
            status: {required: true}
        },
        messages: {
            role: "Bu Alan Zorunludur!",
            name: "Bu Alan Zorunludur!",
            surname: "Bu Alan Zorunludur!",
            username: {
                required: "Bu Alan Zorunludur!",
                minlength: "Oluşturduğunuz Kullanıcı Adı Minimum 6 Karakterli Olmalı!"
            },
            email: {
                required: "Bu Alan Zorunludur!",
                email: "Lütfen Doğru Email Adresi Girin!"
            },
            phone: {
                required: "Bu Alan Zorunludur!",
                minlength: "Telefon Numaranız 10 Haneli Olmalı!",
                maxlength: "Telefon Numaranız 10 Haneli Olmalı!"
            },
            address: "Bu Alan Zorunludur!",
            identity_number: {
                required: "Bu Alan Zorunludur!",
                minlength: "Kimlik Numaranız 11 karakterli olmalıdır!",
                maxlength: "Kimlik Numaranız 11 karakterli olmalıdır!"
            },
            status: "Bu Alan Zorunludur!"
        },
        submitHandler: function (form) {

            $.ajax({
                type: form.method,
                url: form.action,
                data: $("#editAdminForm").serialize(),
                success: function (response) {
                    if (response === "username_already_exists") {
                        toastr["warning"]("Kullanıcı Adı Zaten Kullanılıyor!");
                    } else if (response === "email_already_exists") {
                        toastr["warning"]("Email Zaten Kullanılıyor!");
                    } else if (response === "id_already_exists") {
                        toastr["warning"]("TC Kimlik No Zaten Kullanılıyor!");
                    } else if (response === "phone_already_exists") {
                        toastr["warning"]("Telefon Zaten Kullanılıyor!");
                    } else if (response === "success") {
                        toastr["success"]("Admin Başarıyla Güncellendi!");
                    } else if (response === "failed") {
                        toastr["error"]("Güncelleme Başarısız!");
                    } else {
                        document.write(response);
                    }
                }
            });

        }
    });

    $("#editClientForm").validate({
        rules: {
            name: {required: true},
            surname: {required: true},
            username: {required: true, minlength: 6},
            email: {required: true, email: true},
            phone: {required: true, minlength: 10, maxlength: 10},
            identity_number: {required: true, minlength: 11, maxlength: 11},
            address: {required: true},
            tax_number: {required: true},
            company_name: {required: true},
            zip_code: {required: true},
            city: {required: true},
            status: {required: true}
        },
        messages: {
            name: "Bu Alan Zorunludur!",
            surname: "Bu Alan Zorunludur!",
            username: {
                required: "Bu Alan Zorunludur!",
                minlength: "Oluşturduğunuz Kullanıcı Adı Minimum 6 Karakterli Olmalı!"
            },
            email: {
                required: "Bu Alan Zorunludur!",
                email: "Lütfen Doğru Email Adresi Girin!"
            },
            phone: {
                required: "Bu Alan Zorunludur!",
                minlength: "Telefon Numaranız 10 Haneli Olmalı!",
                maxlength: "Telefon Numaranız 10 Haneli Olmalı!"
            },
            address: "Bu Alan Zorunludur!",
            identity_number: {
                required: "Bu Alan Zorunludur!",
                minlength: "Kimlik Numaranız 11 karakterli olmalıdır!",
                maxlength: "Kimlik Numaranız 11 karakterli olmalıdır!"
            },
            tax_number: {required: "Bu Alan Zorunludur!"},
            company_name: {required: "Bu Alan Zorunludur!"},
            zip_code: {required: "Bu Alan Zorunludur!"},
            city: {required: "Bu Alan Zorunludur!"},
            status: {required: "Bu Alan Zorunludur!"}
        },
        submitHandler: function (form) {

            $.ajax({
                type: form.method,
                url: form.action,
                data: $("#editClientForm").serialize(),
                success: function (response) {
                    if (response === "username_already_exists") {
                        toastr["warning"]("Kullanıcı Adı Zaten Kullanılıyor!");
                    } else if (response === "email_already_exists") {
                        toastr["warning"]("Email Zaten Kullanılıyor!");
                    } else if (response === "id_already_exists") {
                        toastr["warning"]("TC Kimlik No Zaten Kullanılıyor!");
                    } else if (response === "phone_already_exists") {
                        toastr["warning"]("Telefon Kullanılıyor!");
                    } else if (response === "tax_already_exists") {
                        toastr["warning"]("Vergi Numarası Kullanılıyor!");
                    } else if (response === "success") {
                        toastr["success"]("Müşteri Başarıyla Güncellendi!!");
                    } else if (response === "failed") {
                        toastr["error"]("İşlem Başarısız!");
                    } else {
                        document.write(response);
                    }
                }
            });

        }
    });

    $("#refresh_lists").on("click", function () {

        $("#paymentNoticeAdminArea").load("/admin/odeme-bildirimleri-alani");

        $("#pendingOrdersAdminArea").load("/admin/bekleyen-siparisler-alani");
        $("#controlledOrdersAdminArea").load("/admin/kontrol-edilen-siparisler-alani");
        $("#processedOrdersAdminArea").load("/admin/islenen-siparisler-alani");

    });

    $("#resetPassword_sendMail_button").on("click", function () {

        var email = $(this).attr("email");

        $.ajax({
            type: "POST",
            url: "/admin/sifirlama-maili-gonder",
            data: {email: email},
            success: function (response) {
                if (response === "success") {
                    toastr["success"]("Sıfırlama Linki Gönderildi!");
                } else if (response === "failed") {
                    toastr["success"]("İşlem Başarısız!");
                }
            }
        });
    });

    $("#createProductForm").validate({
        rules: {
            category_id: {required: true},
            origin: {required: true},
            title: {required: true},
            stock: {required: true},
            real_price: {required: true},
            product_code: {required: true},
            images: {required: true},
            color: {required: true},
            info: {required: true},
            properties: {required: true},
            description: {required: true},
            shipping_and_returns: {required: true},
            discount_rate: {required: true}
        },
        messages: {
            category_id: {required: "Bu Alan Zorunludur!"},
            origin: {required: "Bu Alan Zorunludur!"},
            title: {required: "Bu Alan Zorunludur!"},
            stock: {required: "Bu Alan Zorunludur!"},
            real_price: {required: "Bu Alan Zorunludur!"},
            product_code: {required: "Bu Alan Zorunludur!"},
            images: {required: "Bu Alan Zorunludur!"},
            color: {required: "Bu Alan Zorunludur!"},
            info: {required: "Bu Alan Zorunludur!"},
            properties: {required: "Bu Alan Zorunludur!"},
            description: {required: "Bu Alan Zorunludur!"},
            shipping_and_returns: {required: "Bu Alan Zorunludur!"},
            discount_rate: {required: "Bu Alan Zorunludur!"},
        },
        submitHandler: function (form) {

            var forms = $("#createProductForm")[0];
            var data = new FormData(forms);
            $.ajax({
                url: form.action,
                type: form.method,
                data: data,
                enctype: form.enctype,
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function () {
                    toastr["info"]("Yükleniyor!");
                },
                success: function (response) {
                    if (response === "the_file_is_too_big") {
                        toastr["warning"]("Dosyalar Çok Büyük (Max 15MB)!");
                    } else if (response === "success") {
                        toastr["success"]("Ürün Başarıyla Eklendi!");
                        setTimeout(function () {
                            window.location.reload();
                        }, 500);
                    } else if (response === "failed") {
                        toastr["warning"]("İşlem Başarısız!");
                    } else if (response === "file_type_not_supported") {
                        toastr["warning"]("Dosya Desteklenmiyor!");
                    } else if (response === "max_3_image") {
                        toastr["warning"]("Maximum 3 Görüntü Ekleyebilirsiniz!");
                    } else {
                        document.write(response);
                    }
                }

            });

        }
    });

    $("body").on("click", ".deleteProductButton", function () {

        var product_id = $(this).attr("product-id");
        Swal.fire({
            title: product_id + " ID'li Ürünü Silmek İstiyor musun?",
            text: "",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: "Sil",
            cancelButtonText: "Vazgeç",
        }).then((result) => {
            if (result.isConfirmed) {

                $url = "/admin/urun-sil";
                $data = {product_id: product_id};
                $.post($url, $data, function (response) {

                    var data = JSON.parse(response);

                    if (data["status"] === "success") {
                        $("#productArea").load("/admin/urun-alani");
                        toastr["success"]("Ürün Silindi!");
                    } else if (data["status"] === "failed") {
                        toastr["error"]("İşlem Başarısız!");
                    }

                });

            }

        });

    });

    $("#updateProductForm").validate({
        rules: {
            category_id: {required: true},
            origin: {required: true},
            title: {required: true},
            stock: {required: true},
            real_price: {required: true},
            product_code: {required: true},
            color: {required: true},
            info: {required: true},
            properties: {required: true},
            description: {required: true},
            shipping_and_returns: {required: true},
            discount_rate: {required: true}
        },
        messages: {
            category_id: {required: "Bu Alan Zorunludur!"},
            origin: {required: "Bu Alan Zorunludur!"},
            title: {required: "Bu Alan Zorunludur!"},
            stock: {required: "Bu Alan Zorunludur!"},
            real_price: {required: "Bu Alan Zorunludur!"},
            product_code: {required: "Bu Alan Zorunludur!"},
            color: {required: "Bu Alan Zorunludur!"},
            info: {required: "Bu Alan Zorunludur!"},
            properties: {required: "Bu Alan Zorunludur!"},
            description: {required: "Bu Alan Zorunludur!"},
            shipping_and_returns: {required: "Bu Alan Zorunludur!"},
            discount_rate: {required: "Bu Alan Zorunludur!"},
        },
        submitHandler: function (form) {

            $.ajax({
                url: form.action,
                type: form.method,
                data: $("#updateProductForm").serialize(),
                success: function (response) {
                    if (response === "success") {
                        toastr["success"]("Ürün Başarıyla Güncellendi!");
                    } else if (response === "failed") {
                        toastr["warning"]("İşlem Başarısız!");
                    } else {
                        document.write(response);
                    }
                }

            });

        }
    });

    $("#deleteProductImageButton").on("click", function () {

        var image_id = $(this).attr("image-id");
        Swal.fire({
            title: image_id + " ID'li Resmi Silmek İstiyor musun?",
            text: "",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: "Sil",
            cancelButtonText: "Vazgeç",
        }).then((result) => {
            if (result.isConfirmed) {

                var url = "/admin/urun-resmi-sil";
                var data = {image_id: image_id};
                $.ajax({
                    type: "POST",
                    url: url,
                    data: data,
                    success: function (response) {

                        if (response === "success") {
                            toastr["success"]("Silme Başarılı!");
                            window.location.reload();
                        } else if (response === "failed") {
                            toastr["error"]("İşlem Başarısız!");
                        }
                    }
                });
            }

        });

    });

    $("#createProductImageButton").on("click", function () {

        var form = $("#createProductImageForm")[0];
        var enctype = $("#settingsImageForm").attr("enctype");

        $.ajax({
            type: $("#createProductImageForm").attr("method"),
            url: $("#createProductImageForm").attr("action"),
            data: new FormData(form),
            processData: false,
            contentType: false,
            cache: false,
            success: function (response) {

                if (response === "success") {
                    window.location.reload();
                } else if (response === "failed") {
                    toastr["error"]("İşlem Başarısız!");
                } else if (response === "file_type_not_supported") {
                    toastr["warning"]("Dosya Desteklenmiyor!");
                } else if (response === "max_3_image") {
                    toastr["warning"]("Ürüne Ait Max 3 Resim Olabilir!!");
                } else {
                    document.write(response);
                }
            }
        });


    });
});
