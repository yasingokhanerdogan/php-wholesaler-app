<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive mb-4">
            <table class="table table-centered datatable dt-responsive nowrap table-card-list"
                   style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                <thead>
                <tr class="bg-transparent">
                    <th>#</th>
                    <th>Ad Soyad</th>
                    <th>Email</th>
                    <th>Konu</th>
                    <th>Mesaj</th>
                    <th>İşlemler</th>
                </tr>
                </thead>
                <tbody>
                @foreach($inbox as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->subject }}</td>
                        <td>{{ $item->message }}</td>
                        <td>
                            <button type="button" id="deleteContactMessage" inbox-id="{{ $item->id }}" class="px-3 text-white bg-danger rounded-1 border-0"><i class="uil uil-trash-alt font-size-18"></i></button>
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