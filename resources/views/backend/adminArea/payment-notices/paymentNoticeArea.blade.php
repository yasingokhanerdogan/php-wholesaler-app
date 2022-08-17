<div class="row" id="controlled_payment_notices" style="display: none;">
    <div class="col-lg-3">
        <button type="button" class="btn btn-info mb-3" id="pending_payment_notice_button"><i
                    class="uil uil-arrow-right"></i> Bekleyen Bildirimler
        </button>
    </div>
    <div class="col-lg-12">
        <div class="table-responsive mb-4">
            <table class="table table-centered datatable dt-responsive nowrap table-card-list"
                   style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                <thead>
                <tr class="bg-transparent">
                    <th>#</th>
                    <th>Sipariş No</th>
                    <th>Kul. ID</th>
                    <th>Ad Soyad</th>
                    <th>Banka</th>
                    <th>Miktar</th>
                    <th>Açıklama</th>
                    <th>Durumu</th>
                </tr>
                </thead>
                <tbody>
                @foreach($controlled_payment_notices as $payment_notice)
                    <tr>
                        <td>
                            {{ $payment_notice->id }}
                        </td>
                        <td><a href="javascript: void(0);"
                               class="text-dark fw-bold">#{{ $payment_notice->order_no }}</a></td>
                        <td>{{ $payment_notice->user_id }}</td>
                        <td>{{ $payment_notice->name }}</td>
                        <td>{{ $payment_notice->bank_account }}</td>
                        <td>{{ numberFormat($payment_notice->total_amount) }}₺</td>
                        <td>
                            @if($payment_notice->status_description == "1")
                                <span>Ödeme Onaylandı!</span>
                            @elseif($payment_notice->status_description == "2")
                                <span>Geçersiz Bildirim Sebebiyle İptal Edildi!</span>
                            @elseif($payment_notice->status_description == "3")
                                <span>Son Ödeme Tarihi Geçtiği için İptal Edildi!</span>
                            @elseif($payment_notice->status_description == "4")
                                <span>Ödenmesi Gereken Miktar Ödenmediği için İptal Edildi!</span>
                            @endif
                        </td>
                        <td>
                            @if($payment_notice->status == "controlled")
                                <span class="badge bg-soft-success">Kontrol Edildi!</span>
                            @elseif($payment_notice->status == "canceled")
                                <span class="badge bg-soft-danger">İptal Edildi!</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- end table -->
    </div>
</div>

<div class="row" id="pending_payment_notices">
    <div class="col-lg-3">
        <button type="button" class="btn btn-info mb-3" id="controlled_payment_notices_button"><i
                    class="uil uil-arrow-right"></i> Kontrol Edilen Bildirimler
        </button>
    </div>
    <div class="col-lg-12">
        <div class="table-responsive mb-4">
            <table class="table table-centered datatable dt-responsive nowrap table-card-list"
                   style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                <thead>
                <tr class="bg-transparent">
                    <th>#</th>
                    <th>Sipariş No</th>
                    <th>Kull. ID</th>
                    <th>Ad Soyad</th>
                    <th>Banka</th>
                    <th>Miktar</th>
                    <th>Ödeme Tarihi</th>
                    <th>İşlemler</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pending_payment_notices as $payment_notice)
                    <tr>
                        <td>
                            {{ $payment_notice->id }}
                        </td>
                        <td><a href="javascript: void(0);"
                               class="text-dark fw-bold">#{{ $payment_notice->order_no }}</a></td>
                        <td>{{ $payment_notice->user_id }}</td>
                        <td>{{ $payment_notice->name }}</td>
                        <td>{{ $payment_notice->bank_account }}</td>
                        <td>{{ numberFormat($payment_notice->total_amount) }}₺</td>
                        <td>{{ $payment_notice->created_at }}</td>
                        <td>
                            <button type="button" id="confirm_payment"
                                    payment-id="{{ $payment_notice->id }}"
                                    payment-order-no="{{ $payment_notice->order_no }}"
                                    class="btn btn-info rounded-1 border-0"> Onayla
                            </button>
                            <button type="button" class="btn btn-danger rounded-1 border-0" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop2">
                                İptal Et
                            </button>

                            <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static"
                                 data-bs-keyboard="false" tabindex="-1" role="dialog"
                                 aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <form method="POST" action="{{ url("backend.admin.paymentNotices.cancelPayment") }}"
                                      id="cancelPaymentForm">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Ödeme İptal</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <label for="status_description">İptal Sebebi*</label>
                                                    <select name="status_description" id="status_description"
                                                            class="form-select">
                                                        <option value="2">Geçersiz Bildirim!</option>
                                                        <option value="3">Son Ödeme Tarihi Geçtiği için İptal Edildi!
                                                        </option>
                                                        <option value="4">Ödenmesi Gereken Miktar Ödenmediği için İptal
                                                            Edildi!
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <input type="hidden" name="payment_id" value="{{ $payment_notice->id }}">
                                            <input type="hidden" name="payment_order_no"
                                                   value="{{ $payment_notice->order_no }}">
                                            <div class="modal-footer">
                                                <button type="button" id="close_modal2" class="btn btn-light"
                                                        data-bs-dismiss="modal">Kapat
                                                </button>
                                                <button type="button" id="cancel_payment" class="btn btn-danger">İptal
                                                    Et
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- end table -->
    </div>
</div>

<script>
    $("#controlled_payment_notices_button").on("click", function () {
        $("#pending_payment_notices").css("display", "none");
        $("#controlled_payment_notices").css("display", "block");
    });

    $("#pending_payment_notice_button").on("click", function () {
        $("#controlled_payment_notices").css("display", "none");
        $("#pending_payment_notices").css("display", "block");
    });
</script>
<script src="/public/backend-assets/libs/spectrum-colorpicker2/spectrum.min.js"></script>
<script src="/public/backend-assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script src="/public/backend-assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
<script src="/public/backend-assets/js/pages/ecommerce-cart.init.js"></script>
<script src="/public/backend-assets/js/pages/ecommerce-datatables.init.js"></script>