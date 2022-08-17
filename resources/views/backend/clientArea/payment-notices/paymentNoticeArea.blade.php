<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive mb-4">
            <table class="table table-centered datatable dt-responsive nowrap table-card-list"
                   style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                <thead>
                <tr class="bg-transparent">
                    <th>#</th>
                    <th>Sipariş No</th>
                    <th>Ad Soyad</th>
                    <th>Şirket</th>
                    <th>Banka</th>
                    <th>Miktar</th>
                    <th>Ödeme Tarihi</th>
                    <th>Durumu</th>
                    <th>İşlemler</th>
                </tr>
                </thead>
                <tbody>
                @foreach($payment_notices as $payment_notice)
                    <tr>
                        <td>{{ $payment_notice->id }}</td>
                        <td><a href="javascript: void(0);"
                               class="text-dark fw-bold">#{{ $payment_notice->order_no }}</a></td>
                        <td>{{ $payment_notice->name }}</td>
                        <td>{{ $payment_notice->company_name }}</td>
                        <td>{{ $payment_notice->bank_account }}</td>
                        <td>{{ numberFormat($payment_notice->total_amount) }}₺</td>
                        <td>{{ $payment_notice->created_at }}</td>
                        <td>
                            @if($payment_notice->status == "pending")
                                <span class="badge bg-soft-warning">İşlem Bekleniyor!</span>
                            @elseif($payment_notice->status == "controlled")
                                <span class="badge bg-soft-success">Kontrol Edildi!</span>
                            @elseif($payment_notice->status == "canceled")
                                <span class="badge bg-soft-danger">İptal Edildi!</span>
                            @elseif($payment_notice->status == "refund")
                                <span class="badge bg-soft-danger">Ödeme İade Edildi!</span>
                            @elseif($payment_notice->status == "partial_refund")
                                <span class="badge bg-soft-danger">Kısmi İade!</span>
                            @endif
                        </td>
                        <td>
                            <button type="button"
                                    onclick="location.href='{{ url("backend.client.order.invoice", ["orderNo" => $payment_notice->order_no]) }}'"
                                    class="px-3 text-primary bg-soft-info rounded-1 border-0"><i
                                        class="uil uil-eye font-size-18"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- end table -->
    </div>
</div>

<script src="/public/backend-assets/libs/spectrum-colorpicker2/spectrum.min.js"></script>
<script src="/public/backend-assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script src="/public/backend-assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
<script src="/public/backend-assets/js/pages/ecommerce-cart.init.js"></script>
<script src="/public/backend-assets/js/pages/ecommerce-datatables.init.js"></script>