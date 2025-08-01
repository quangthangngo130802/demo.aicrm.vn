@extends('admin.layout.index')

@section('content')


    <div class="page-inner">
        <div class="page-header">
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Báo cáo</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Hôm nay</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <!-- Today's Orders Section -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" style="text-align: center; color:white">Danh sách đơn nhập hàng hôm nay</h4>
                    </div>

                    <div class="card-body">
                        <div class="">
                            <!-- Table for Orders -->
                            <div id="basic-datatables_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="basic-datatables"
                                            class="display table table-striped table-hover dataTable" role="grid"
                                            aria-describedby="basic-datatables_info">
                                            <thead>
                                                <tr role="row">
                                                    <th>Mã đơn hàng</th>
                                                    <th>Nhân viên</th>
                                                    <th>Ngày tạo</th>
                                                    <th>Nhà cung cấp</th>
                                                    <th>Trạng thái</th>
                                                    <th>Tổng tiền</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($imports as $import)
                                                    <tr>
                                                        <td>
                                                            <a style="color: black; font-weight:bold"
                                                                href="{{ route('admin.importproduct.importCoupon.detail', ['id' => $import->id]) }}">{{ $import->coupon_code }}</a>
                                                        </td>
                                                        <td>
                                                            <a style="color:black"
                                                                href="{{ route('admin.staff.edit', ['id' => $import->user->id]) }}">
                                                                {{ $import->user->name ?? '' }}
                                                            </a>
                                                        </td>
                                                        <td>{{ $import->created_at->format('d/m/Y') }}</td>
                                                        <td>
                                                            <a style="color:black"
                                                                href="{{ route('admin.client.detail', ['id' => $import->company->id]) }}">
                                                                {{ $import->company->name ?? '' }}
                                                            </a>
                                                        </td>
                                                        <td>
                                                            @if ($import->status == 1)
                                                                <span class="badge badge-success">Đã thanh toán</span>
                                                            @else
                                                                <span class="badge badge-danger">Công nợ</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ number_format($import->total) }} VND</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td class="text-center" colspan="6">Không có đơn hàng nào</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>

                                        <!-- Pagination for Orders -->
                                        {{ $imports->appends(['orders_page' => $imports->currentPage()])->links('vendor.pagination.custom') }}
                                    </div>
                                </div>
                            </div>
                            <!-- End Table -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Today's Products Section -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" style="text-align: center; color:white">Danh sách sản phẩm nhập hôm nay
                        </h4>
                    </div>

                    <div class="card-body">
                        <div class="">
                            <!-- Table for Product Sales -->
                            <div id="products-sales-table_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="products-sales-table"
                                            class="display table table-striped table-hover dataTable" role="grid">
                                            <thead>
                                                <tr role="row">
                                                    <th>Tên sản phẩm</th>
                                                    <th>Số lượng</th>
                                                    <th>Giá nhập cũ</th>
                                                    <th>Giá nhập mới</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($imports as $import)
                                                    @foreach ($import->details as $detail)
                                                        <tr>
                                                            <td>{{ $detail->product->name }}</td>
                                                            <!-- Example product name access -->
                                                            <td>{{ $detail->quantity }}</td>
                                                            <!-- Example user name access -->
                                                            <td>{{ number_format($detail->old_price) }} VND</td>
                                                            <td>{{ number_format($detail->price) }} VND</td>

                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                            </tbody>

                                        </table>

                                        <!-- Pagination for Products -->
                                        {{ $productImports->appends(['products_page' => $productImports->currentPage()])->links('vendor.pagination.custom') }}
                                    </div>
                                </div>
                            </div>
                            <!-- End Table -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Export Button -->
        <div class="text-center mt-4">
            <button type="button" id="exportimports" class="btn btn-primary">Xuất báo cáo hàng ngày</button>
        </div>
    </div>

    <!-- Include SheetJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-notify/0.2.0/js/bootstrap-notify.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#exportimports').on('click', function() {
                // Fetch data from the server for the daily report
                const exportUrl = '{{ route('admin.report.imports.getDailyImportData') }}';

                $.ajax({
                    url: exportUrl,
                    method: 'GET',
                    xhrFields: {
                        responseType: 'blob' // To receive data as a blob
                    },
                    success: function(data) {
                        // Create a URL for the blob
                        const url = window.URL.createObjectURL(new Blob([data]));
                        const link = document.createElement('a');
                        link.href = url;
                        link.setAttribute('download', 'daily_report.xlsx');
                        document.body.appendChild(link);
                        link.click();
                        link.remove();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching data:', error);
                        alert('Có lỗi xảy ra khi xuất báo cáo.');
                    }
                });
            });
        });
    </script>
@endsection
