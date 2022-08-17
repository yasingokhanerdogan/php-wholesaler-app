<div class="table-responsive mb-4">
    <table class="table table-centered datatable dt-responsive nowrap table-card-list" style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
        <thead>
        <tr class="bg-transparent">
            <th>ID</th>
            <th>Kullanıcı Adı</th>
            <th>Eposta</th>
            <th>Sisteme Son Giriş T.</th>
            <th>Kullanıcı Tipi</th>
            <th>Durumu</th>
            <th>İşlemler</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($users as $user)

            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->last_login_date }}</td>
                <td>
                    @if($user->role == "admin")
                        <span class="badge bg-success">Yönetici</span>
                    @elseif($user->role == "staff")
                        <span class="badge bg-info">Personel</span>
                    @endif
                </td>
                <td>
                    @if($user->status == "1")
                        <span class="badge bg-success">Aktif</span>
                    @else
                        <span class="badge bg-danger">Pasif</span>
                    @endif
                </td>
                <td>
                    <a href="{{ url("backend.admin.users.edit", ["id" => $user->id]) }}" class="px-3 text-primary"><i class="uil uil-pen"></i></a>
                    <a href="javascript:void(0)" user-id="{{ $user->id }}" class="px-3 text-danger deleteUserButton"><i class="uil uil-trash-alt"></i></a>
                </td>
            </tr>

        @endforeach

        </tbody>
    </table>
</div>


<script src="/public/backend-assets/libs/spectrum-colorpicker2/spectrum.min.js"></script>
<script src="/public/backend-assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script src="/public/backend-assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
<script src="/public/backend-assets/js/pages/ecommerce-cart.init.js"></script>
<script src="/public/backend-assets/js/pages/ecommerce-datatables.init.js"></script>