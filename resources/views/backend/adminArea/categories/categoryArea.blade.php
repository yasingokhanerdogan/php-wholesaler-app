<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive mb-4">
            <table class="table table-centered datatable dt-responsive nowrap table-card-list"
                   style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                <thead>
                <tr class="bg-transparent">
                    <th>#</th>
                    <th>Kategori Adı</th>
                    <th>Durum</th>
                    <th>İşlemler</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->title }}</td>
                        <td>
                            @if($category->status == "1")
                                <span class="badge bg-soft-success">Aktif</span>
                                @elseif($category->status == "0")
                                <span class="badge bg-soft-danger">Pasif</span>
                            @endif
                        </td>
                        <td>
                            <button type="button"
                                    onclick="location.href='{{ url("backend.admin.category.edit", ["id" => $category->id]) }}'"
                                    class="px-3 text-primary bg-soft-info rounded-1 border-0"><i
                                        class="uil uil-edit font-size-18"></i></button>

                            @if($category->status == "1")
                                <button type="button"
                                        id="changeCategoryStatus" category-id="{{ $category->id }}" status="1"
                                        class="px-3 text-white bg-danger rounded-1 border-0"><i
                                            class="uil uil-eye-slash font-size-18"></i></button>
                            @else
                                <button type="button"
                                        id="changeCategoryStatus" category-id="{{ $category->id }}" status="0"
                                        class="px-3 text-white bg-success rounded-1 border-0"><i
                                            class="uil uil-eye font-size-18"></i></button>
                            @endif

                            <button type="button"
                                    id="deleteCategory" category-id="{{ $category->id }}"
                                    class="px-3 text-white bg-danger rounded-1 border-0"><i
                                        class="uil uil-trash-alt font-size-18"></i></button>
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