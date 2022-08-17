<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive mb-4">
            <table class="table table-centered datatable dt-responsive nowrap table-card-list"
                   style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                <thead>
                <tr class="bg-transparent">
                    <th>#</th>
                    <th>Banka</th>
                    <th>Hesap Sahibi</th>
                    <th>IBAN</th>
                    <th>İşlemler</th>
                </tr>
                </thead>
                <tbody>
                @foreach($accounts as $account)
                    <tr>
                        <td>{{ $account->id }}</td>
                        <td>{{ $account->bank_name }}</td>
                        <td>{{ $account->account_owner }}</td>
                        <td>{{ $account->iban }}</td>
                        <td>
                            <button type="button" onclick="location.href='{{ url("backend.admin.bank.account.edit", ["id" => $account->id]) }}'" class="px-3 text-primary bg-soft-info rounded-1 border-0"><i class="uil uil-edit font-size-18"></i></button>
                            <button type="button" id="deleteAccount" account-id="{{ $account->id }}" class="px-3 text-white bg-danger rounded-1 border-0"><i class="uil uil-trash-alt font-size-18"></i></button>
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