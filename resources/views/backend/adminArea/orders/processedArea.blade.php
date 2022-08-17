<div class="row" id="processed_orders">
    <div class="col-lg-12">
        <div class="table-responsive mb-4">
            <table class="table table-centered datatable dt-responsive nowrap table-card-list"
                   style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                <thead>
                <tr class="bg-transparent">
                    <th>Sipariş No</th>
                    <th>Miktar</th>
                    <th>Kul. ID</th>
                    <th>İndirimli Fiyat</th>
                    <th>Ödenecek Tutar</th>
                    <th>Açıklama</th>
                    <th>Durumu</th>
                    <th style="width: 120px;">İşlemler</th>
                </tr>
                </thead>
                <tbody>
                @foreach($processed_orders as $order)
                    <tr>
                        <td>
                            <a href="javascript: void(0);" class="text-dark fw-bold">#{{ $order->order_no }}</a>
                        </td>
                        <td>{{ $order->total_product_amount }} m2</td>
                        <td>{{ $order->user_id }}</td>
                        <td>{{ numberFormat($order->total_discounted_price) }}₺</td>
                        <td>{{ numberFormat($order->total_price) }}₺</td>
                        <td>
                            @if($order->status_description == "1")
                                <p> Sipariş Gönderildi!</p>
                            @elseif($order->status_description == "2")
                                <p> Geçersiz Bildirim!</p>
                            @elseif($order->status_description == "3")
                                <p> Son Ödeme Tarihi Geçtiği için İptal Edildi!</p>
                            @elseif($order->status_description == "4")
                                <p> Ödenmesi Gereken Miktar Ödenmediği için İptal Edildi!</p>
                            @endif
                        </td>
                        <td>
                            @if($order->status == "controlled")
                                <button type="button" class="border-0 badge bg-pill bg-soft-success font-size-12">Ödeme Kontrol Edildi!</button>
                            @elseif($order->status == "approved")
                                <button type="button" class="border-0 badge bg-pill bg-soft-success font-size-12">Sipariş Onaylandı!</button>
                            @elseif($order->status == "canceled")
                                <button type="button" class="border-0 badge bg-pill bg-soft-danger font-size-12">Sipariş İptal Edildi!</button>
                            @endif
                        </td>
                        <td>
                            <button type="button" onclick="location.href='{{ url("backend.admin.order.invoice", ["orderNo" => $order->order_no]) }}'" class="px-3 text-primary bg-soft-info rounded-1 border-0"><i class="uil uil-eye font-size-18"></i></button>

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