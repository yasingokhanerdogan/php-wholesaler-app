<?php

use App\Middlewares\AdminsMiddleware;
use App\Middlewares\CheckoutMiddleware;
use App\Middlewares\ClientMiddleware;
use App\Middlewares\CsrfVerifier;
use App\Middlewares\LoginMiddleware;
use App\Middlewares\OnlyAdminMiddleware;
use Pecee\Http\Request;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;
use Pecee\SimpleRouter\SimpleRouter as Route;

Route::csrfVerifier(new CsrfVerifier());
Route::setDefaultNamespace("App\Controllers");

Route::get("/para-birimi/{currency}", "Backend\Currency@change")->name("currency.change");

Route::group(["namespace" => "Frontend"], function () {

    Route::get("/", "Home@index")->name("frontend.home");
    Route::get("/hakkimizda", "About@index")->name("frontend.about");

    Route::get("/iletisim", "Contact@index")->name("frontend.contact");
    Route::post("/iletisim-mail-gonder", "Contact@sendMail")->name("frontend.contact.sendMail");

    Route::get("/giris", "Login@index")->name("frontend.login")->addMiddleware(LoginMiddleware::class);
    Route::post("/giris-yap", "Login@signin")->name("frontend.signin");
    Route::get("/cikis-yap", "Login@signout")->name("frontend.signout");

    Route::get("/sifre-degistir", "Login@changePassword_emailScreen")->name("frontend.changePassword.emailScreen");
    Route::post("/sifre-link-gonder", "Login@changePassword_resetPasswordSendMail")->name("frontend.changePassword.resetPasswordSendMail");
    Route::get("/sifre-sifirla/{code}", "Login@changePassword_resetScreen")->name("frontend.changePassword.resetScreen");
    Route::post("/sifre-guncelle", "Login@changePassword_resetPassword")->name("frontend.changePassword.resetPassword");

    Route::get("/qr-giris-link-gonder/{id}", "Login@QRLoginSendMail")->name("QRLoginSendMail");
    Route::get("/bildirim/{message}/{token}/{user_id?}", "Notices@index")->name("notices");
    Route::get("/qr-giris/{code}", "Login@QRLogin")->name("QRLogin");
    Route::get("/qr-urun-link-gonder/{user_id}/{product_id}", "Login@QRViewProductSendMail")->name("QRViewProductSendMail");
    Route::get("/qr-giris/{code}/yonlendirme/{product_id}", "Login@QRViewProduct")->name("QRViewProduct");

});

Route::group(["namespace" => "Backend\ClientArea", "middleware" => ClientMiddleware::class], function () {

    Route::get("/panel", "Home@index")->name("backend.client.home");
    Route::get("/urunler/{page?}", "Products@products")->name("backend.client.products");
    Route::get("/urun/{slug}", "Products@detail")->name("backend.client.product.detail");
    Route::get("/kategori/{slug}/{page?}", "Categories@index")->name("backend.client.category");

    Route::post("/urun-ara", "Search@index")->name("backend.client.search");
    Route::get("/urun-ara/{slug}/{page?}", "Search@results")->name("backend.client.search.results");

    Route::get("/sepet", "Cart@cart")->name("backend.client.cart");
    Route::get("/sepet-alani", "Cart@cartArea")->name("backend.client.cart.cartArea");
    Route::post("/sepete-ekle", "Cart@addToCart")->name("backend.client.cart.addToCart");
    Route::post("/sepet-urun-sil", "Cart@deleteFromCart")->name("backend.client.cart.deleteFromCart");
    Route::post("/sepet-guncelle", "Cart@updateCart")->name("backend.client.cart.updateCart");
    Route::get("/checkout", "Cart@checkout")->name("backend.client.cart.checkout")->addMiddleware(CheckoutMiddleware::class);
    Route::post("/siparis-ver", "Cart@order")->name("backend.client.cart.order");
    Route::get("/siparis/islem-basarili/{token}/{orderNo}", "Cart@orderStatus")->name("backend.client.cart.orderStatus");

    Route::get("/siparislerim", "Orders@index")->name("backend.client.orders");
    Route::get("/siparislerim-alani", "Orders@orderArea")->name("backend.client.order.orderArea");
    Route::post("/siparis-iptal", "Orders@cancelOrder")->name("backend.client.order.cancelOrder");
    Route::get("/siparis/{orderNo}", "Orders@invoice")->name("backend.client.order.invoice");

    Route::get("/profil", "Profile@index")->name("backend.client.profile");
    Route::post("/profil-guncelle", "Profile@updateProfile")->name("backend.client.profile.updateProfile");

    Route::get("/odeme-bildirimlerim", "PaymentNotices@index")->name("backend.client.paymentNotices");
    Route::get("/odeme-bildirimlerim-alani", "PaymentNotices@paymentNoticeArea")->name("backend.client.paymentNotice.paymentNoticeArea");
    Route::get("/odeme-bildirimi", "PaymentNotices@add")->name("backend.client.paymentNotice.add");
    Route::post("/odeme-bildirimi-yap", "PaymentNotices@create")->name("backend.client.paymentNotice.create");

    Route::get("/sikca-sorulan-sorular", "Faqs@index")->name("backend.client.faqs");
    Route::get("/banka-hesaplari", "BankAccounts@index")->name("backend.client.bankAccounts");

    Route::get("/gizlilik-politikasi", "Policies@privacyPolicy")->name("backend.client.privacyPolicy");
    Route::get("/cerez-politikasi", "Policies@cookiePolicy")->name("backend.client.cookiePolicy");

});

Route::group(["prefix" => "/admin", "namespace" => "Backend\AdminArea", "middleware" => AdminsMiddleware::class], function () {

    Route::get("/", function (){ redirect(url("backend.admin.home")); });
    Route::get("/panel", "Home@index")->name("backend.admin.home");


    Route::get("/urunler", "Products@index")->name("backend.admin.products");
    Route::get("/urun-alani", "Products@productArea")->name("backend.admin.product.productArea");
    Route::get("/urun-ekle", "Products@add")->name("backend.admin.product.add");
    Route::post("/urun-olustur", "Products@create")->name("backend.admin.product.create");
    Route::post("/urun-sil", "Products@delete")->name("backend.admin.product.delete");
    Route::get("/urun-duzenle/{id}", "Products@edit")->name("backend.admin.product.edit");
    Route::post("/urun-guncelle", "Products@update")->name("backend.admin.product.update");
    Route::post("/urun-resim-sirala", "Products@imageSortable")->name("backend.admin.product.imageSortable");
    Route::post("/urun-resmi-sil", "Products@deleteImage")->name("backend.admin.product.deleteImage");
    Route::post("/urun-resim-ekle", "Products@createImage")->name("backend.admin.product.createImage");

    Route::post("/sifirlama-maili-gonder", "Users@resetPassword_sendMail")->name("backend.admin.users.resetPassword_sendMail")->addMiddleware(OnlyAdminMiddleware::class);

    Route::get("/yoneticiler", "Users@admins")->name("backend.admin.users.admins")->addMiddleware(OnlyAdminMiddleware::class);
    Route::get("/admin-kullanici-alani", "Users@adminArea")->name("backend.admin.users.adminArea")->addMiddleware(OnlyAdminMiddleware::class);
    Route::get("/musteriler", "Users@clients")->name("backend.admin.users.clients")->addMiddleware(OnlyAdminMiddleware::class);
    Route::get("/musteri-kullanici-alani", "Users@clientArea")->name("backend.admin.users.clientArea")->addMiddleware(OnlyAdminMiddleware::class);
    Route::get("/kullanici-ekle", "Users@add")->name("backend.admin.users.add")->addMiddleware(OnlyAdminMiddleware::class);
    Route::post("/admin-olustur", "Users@createAdmin")->name("backend.admin.users.createAdmin")->addMiddleware(OnlyAdminMiddleware::class);
    Route::post("/musteri-olustur", "Users@createClient")->name("backend.admin.users.createClient")->addMiddleware(OnlyAdminMiddleware::class);
    Route::post("/kullanici-sil", "Users@delete")->name("backend.admin.users.delete")->addMiddleware(OnlyAdminMiddleware::class);
    Route::get("/kullanici-duzenle/{id}", "Users@edit")->name("backend.admin.users.edit")->addMiddleware(OnlyAdminMiddleware::class);
    Route::post("/admin-guncelle", "Users@updateAdmin")->name("backend.admin.users.updateAdmin")->addMiddleware(OnlyAdminMiddleware::class);
    Route::post("/musteri-guncelle", "Users@updateClient")->name("backend.admin.users.updateClient")->addMiddleware(OnlyAdminMiddleware::class);

    Route::get("/profil", "Profile@index")->name("backend.admin.profile");

    Route::get("/gelen-kutusu", "ContactInbox@index")->name("backend.admin.contactInbox");
    Route::get("/iletim-gelen-kutusu-alani", "ContactInbox@contactInboxArea")->name("backend.admin.contactInboxArea");
    Route::post("/iletisim-mesaji-sil", "ContactInbox@delete")->name("backend.admin.contactInbox.delete");

    Route::get("/kategoriler", "Categories@index")->name("backend.admin.categories");
    Route::get("/kategori-alani", "Categories@categoryArea")->name("backend.admin.category.categoryArea");
    Route::post("/kategori-ekle", "Categories@create")->name("backend.admin.category.create");
    Route::get("/kategori-duzenle/{id}", "Categories@edit")->name("backend.admin.category.edit");
    Route::post("/kategori-guncelle", "Categories@update")->name("backend.admin.category.update");
    Route::post("/kategori-sil", "Categories@delete")->name("backend.admin.category.delete");
    Route::post("/kategori-durum-degistir", "Categories@statusChange")->name("backend.admin.category.statusChange");

    Route::get("/gelen-siparisler", "Orders@index")->name("backend.admin.order.pendingOrders");
    Route::get("/bekleyen-siparisler-alani", "Orders@indexArea")->name("backend.admin.order.indexArea");
    Route::get("/kontrol-edilen-siparisler", "Orders@controlledOrders")->name("backend.admin.order.controlledOrders");
    Route::get("/kontrol-edilen-siparisler-alani", "Orders@controlledArea")->name("backend.admin.order.controlledArea");
    Route::get("/islenen-siparisler", "Orders@processedOrders")->name("backend.admin.order.processedOrders");
    Route::get("/islenen-siparisler-alani", "Orders@processedArea")->name("backend.admin.order.processedArea");
    Route::post("/siparis-onay", "Orders@confirmOrder")->name("backend.admin.order.confirmOrder");
    Route::post("/siparis-iptal", "Orders@cancelOrder")->name("backend.admin.order.cancelOrder");
    Route::post("/siparis-urun-iptal", "Orders@cancelOrderProduct")->name("backend.admin.order.cancelOrderProduct");
    Route::get("/siparis/{orderNo}", "Orders@invoice")->name("backend.admin.order.invoice");

    Route::get("/odeme-bildirimleri", "PaymentNotices@index")->name("backend.admin.paymentNotices");
    Route::get("/odeme-bildirimleri-alani", "PaymentNotices@noticesArea")->name("backend.admin.paymentNotices.noticesArea");
    Route::post("/odeme-onayla", "PaymentNotices@confirmPayment")->name("backend.admin.paymentNotices.confirmPayment");
    Route::post("/odeme-iptal", "PaymentNotices@cancelPayment")->name("backend.admin.paymentNotices.cancelPayment");

    Route::get("/banka-hesaplari", "BankAccounts@index")->name("backend.admin.bank.accounts")->addMiddleware(OnlyAdminMiddleware::class);
    Route::get("/banka-hesaplari-alani", "BankAccounts@accountsArea")->name("backend.admin.bank.accountsArea")->addMiddleware(OnlyAdminMiddleware::class);
    Route::post("/banka-hesabi-sil", "BankAccounts@delete")->name("backend.admin.bank.delete")->addMiddleware(OnlyAdminMiddleware::class);
    Route::get("/banka-hesaplari/ekle", "BankAccounts@add")->name("backend.admin.bank.account.add")->addMiddleware(OnlyAdminMiddleware::class);
    Route::post("/banka-hesabi-olustur", "BankAccounts@create")->name("backend.admin.bank.account.create")->addMiddleware(OnlyAdminMiddleware::class);
    Route::get("/banka-hesaplari/duzenle/{id}", "BankAccounts@edit")->name("backend.admin.bank.account.edit")->addMiddleware(OnlyAdminMiddleware::class);
    Route::post("/banka-hesabi-guncelle", "BankAccounts@update")->name("backend.admin.bank.account.update")->addMiddleware(OnlyAdminMiddleware::class);

    Route::get("/sikca-sorulan-sorular", "Faqs@index")->name("backend.admin.faqs");
    Route::get("/sorular-alani", "Faqs@faqsArea")->name("backend.admin.faqsArea");
    Route::post("/soru-sil", "Faqs@delete")->name("backend.admin.faq.delete");
    Route::get("/sikca-sorulan-sorular/ekle", "Faqs@add")->name("backend.admin.faq.add");
    Route::post("/soru-olustur", "Faqs@create")->name("backend.admin.faq.create");
    Route::get("/sikca-sorulan-sorular/duzenle/{id}", "Faqs@edit")->name("backend.admin.faq.edit");
    Route::post("/soru-guncelle", "Faqs@update")->name("backend.admin.faq.update");

    Route::get("/ayarlar", "Settings@index")->name("backend.admin.settings")->addMiddleware(OnlyAdminMiddleware::class);;
    Route::post("/ayar-guncelle", "Settings@updateSettings")->name("backend.admin.settings.update")->addMiddleware(OnlyAdminMiddleware::class);;
    Route::post("/ayar-goruntu-guncelle", "Settings@updateImage")->name("backend.admin.settings.updateImage")->addMiddleware(OnlyAdminMiddleware::class);;
    Route::post("/recaptcha-guncelle", "Settings@updateRecaptcha")->name("backend.admin.settings.updateRecaptcha")->addMiddleware(OnlyAdminMiddleware::class);;

});


Route::error(function (Request $request, \Exception $exception) {

    if ($exception instanceof NotFoundHttpException && $exception->getCode() === 404) {
        redirect(url("404"));
    }

});
Route::get("/404", "Errors@index")->name("404");

Route::start();