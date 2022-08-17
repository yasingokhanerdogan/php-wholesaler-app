$(document).ready(function (){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#loginForm").validate({
        rules: {
            username: {
                required: true
            },
            password: {
                required: true,
                minlength: 6
            }
        },
        messages: {
            username: {
                required: "Bu Alan Zorunludur!"
            },
            password: {
                required: "Bu Alan Zorunludur!",
                minlength: "Girdiğiniz Şifre Minimum 6 Karakterli Olmalı!"
            }
        },
        submitHandler: function (form) {

            $.ajax({
                type: form.method,
                url: form.action,
                data: $("#loginForm").serialize(),
                success: function (response) {
                    if (response === "success") {
                        location.reload();
                    } else if (response === "passive") {
                        $("#login_error").css("display", "block");
                        $("#login_error").text("Hesap Askıya Alınmış... Lütfen İletişime Geçin!");
                        $("#username").val("");
                        $("#password").val("");
                    } else if (response === "user_not_found") {
                        $("#login_error").css("display", "block");
                        $("#login_error").text("Kullanıcı Adı veya Şifre Yanlış!");
                        $("#password").val("");
                    }else{
                        document.write(response);
                    }
                }
            });

        }
    });
    $("#contactSendMailForm").validate({
        rules: {
            name: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            subject: {
                required: true
            },
            message: {
                required: true
            }
        },
        messages: {
            name: {
                required: "Bu Alan Zorunludur!"
            },
            email: {
                required: "Bu Alan Zorunludur!",
                email: "Email Geçersiz!"
            },
            subject: {
                required: "Bu Alan Zorunludur!"
            },
            message: {
                required: "Bu Alan Zorunludur!"
            }
        },
        submitHandler: function (form) {

            $.ajax({
                type: form.method,
                url: form.action,
                data: $("#contactSendMailForm").serialize(),
                success: function (response) {

                    if (response === "success") {
                        $("#messages").css("display", "block");
                        $("#messages").css("background-color", "green");
                        $("#messages").text("Mesajınız Gönderildi!");
                        $("#name").val("");
                        $("#email").val("");
                        $("#subject").val("");
                        $("#message").val("");
                    } else if (response === "invalid_recaptcha") {
                        $("#messages").css("display", "block");
                        $("#messages").css("background-color", "red");
                        $("#messages").text("reCaptcha Hatası!");
                    } else if(response === "failed"){
                        $("#messages").css("display", "block");
                        $("#messages").css("background-color", "red");
                        $("#messages").text("Mesajınız Gönderilemedi!");
                    }else{
                        document.write(response);
                    }

                    grecaptcha.reset();
                }
            });

        }
    });
    $("#emailScreenForm").validate({
        rules: {
            email: {
                required: true
            },
        },
        messages: {
            email: {
                required: "Bu Alan Zorunludur!"
            }
        },
        submitHandler: function (form) {

            $.ajax({
                type: form.method,
                url: form.action,
                data: $("#emailScreenForm").serialize(),
                success: function (response) {
                    window.location.href = response;
                }
            });

        }
    });
    $("#resetPassword").validate({
        rules: {
            password: {
                required: true,
                minlength: 6
            }
        },
        messages: {
            password: {
                required: "Bu Alan Zorunludur!",
                minlength: "Şifreniz Minimum 6 Karakter Olmalı!"
            }
        },
        submitHandler: function (form) {

            $.ajax({
                type: form.method,
                url: form.action,
                data: $("#resetPassword").serialize(),
                success: function (response) {
                    window.location.href = response;
                }
            });

        }
    });

});
