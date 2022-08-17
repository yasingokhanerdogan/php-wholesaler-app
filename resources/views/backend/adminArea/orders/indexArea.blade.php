<div class="row" id="pending_orders">
    <div class="col-lg-12">
        <div class="table-responsive mb-4">
            <table class="table table-centered datatable dt-responsive nowrap table-card-list"
                   style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                <thead>
                <tr class="bg-transparent">
                    <th>Sipariş No</th>
                    <th>Kul. ID</th>
                    <th>Miktar</th>
                    <th>İndirimli Fiyat</th>
                    <th>Ödenecek Tutar</th>
                    <th>Son Ödeme Tarihi</th>
                    <th>Sipariş Durumu</th>
                    <th>İşlemler</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pending_orders as $order)

                    <tr>
                        <td>
                            <a href="javascript: void(0);" class="text-dark fw-bold">#{{ $order->order_no }}</a>
                        </td>
                        <td>{{ $order->user_id }}</td>
                        <td>{{ $order->total_product_amount }} m2</td>
                        <td>{{ numberFormat($order->total_discounted_price) }}₺</td>
                        <td>{{ numberFormat($order->total_price) }}₺</td>
                        <td>{{ $order->created_at->modify("+1 day") }}</td>
                        <td>
                            <span class="badge bg-pill bg-soft-warning font-size-12">Ödeme Kontrolü Bekleniyor!</span>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger rounded-1 border-0" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop">
                                <i class="uil uil-trash-alt font-size-18"></i>
                            </button>

                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                 data-bs-keyboard="false" tabindex="-1" role="dialog"
                                 aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <form method="POST" action="{{ url("backend.admin.order.cancelOrder") }}"
                                      id="cancelOrderForm">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Sipariş İptal</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <label for="status_description">İptal Sebebi*</label>
                                                    <select name="status_description" id="status_description"
                                                            class="form-select">
                                                        <option value="3">Son Ödeme Tarihi Geçtiği için İptal Edildi!</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                                            <input type="hidden" name="order_no"
                                                   value="{{ $order->order_no }}">
                                            <div class="modal-footer">
                                                <button type="button" id="close_modal" class="btn btn-light"
                                                        data-bs-dismiss="modal">Kapat
                                                </button>
                                                <button type="button" id="cancelOrderAdmin" class="btn btn-danger">İptal
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

<script src="/public/backend-assets/libs/spectrum-colorpicker2/spectrum.min.js"></script>
<script src="/public/backend-assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script src="/public/backend-assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
<script src="/public/backend-assets/js/pages/ecommerce-cart.init.js"></script>
<script src="/public/backend-assets/js/pages/ecommerce-datatables.init.js"></script>