@extends('admin.layout.index')

@section('content')
    <style>
        /* Add your styles here */


        .form-label {
            font-weight: bold !important;
            color: #333 !important;

        }

        .avatar {
            width: 75px !important;
            height: 75px !important;
            border-radius: 50% !important;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1) !important;
        }

        .form-group{
            margin-bottom: 0px;
        }
    </style>
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
                    <a href="{{ route('admin.config.detail') }}">Cấu hình</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center" style="color:white">Thông tin cửa hàng</h4>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ route('admin.config.update') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <!-- First Column -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="store_name" class="form-label">Tên cửa hàng</label>
                                        <input id="store_name"
                                            class="form-control @error('store_name') is-invalid @enderror" name="store_name"
                                            type="text"
                                            value="{{ old('store_name', isset($data) ? $data->user->store_name : '') }}">
                                        @error('store_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="phone" class="form-label">Số điện thoại</label>
                                        <input id="phone" class="form-control @error('phone') is-invalid @enderror"
                                            name="phone" type="text"
                                            value="{{ old('phone', isset($data) ? $data->user->phone : '') }}">
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="form-label">Email</label>
                                        <input id="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" type="email"
                                            value="{{ old('email', isset($data) ? $data->user->email : '') }}">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="company_name" class="form-label">Tên công ty</label>
                                        <input id="company_name"
                                            class="form-control @error('company_name') is-invalid @enderror"
                                            name="company_name" type="text"
                                            value="{{ old('company_name', isset($data) ? $data->user->company_name : '') }}">
                                        @error('company_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="logo" class="form-label">Logo cửa hàng</label>
                                        <div class="custom-file">
                                            <input id="logo"
                                                class="custom-file-input @error('logo') is-invalid @enderror" type="file"
                                                name="logo" accept="image/*">
                                            <label class="custom-file-label" for="logo">Chọn logo</label>
                                        </div>
                                        @error('logo')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <img id="profileImage"
                                            src="{{ isset($data->logo) && !empty($data->logo) ? asset($data->logo) : asset('images/avatar2.jpg') }}"
                                            alt="image profile" class="avatar">
                                    </div>
                                </div>
                                <!-- Second Column -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="receiver" class="form-label">Tên chủ tài khoản</label>
                                        <input id="receiver" class="form-control @error('receiver') is-invalid @enderror"
                                            name="receiver" type="text"
                                            value="{{ old('receiver', isset($data) ? $data->receiver : '') }}">
                                        @error('receiver')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="bank_account" class="form-label">Số tài khoản</label>
                                        <input id="bank_account"
                                            class="form-control @error('bank_account') is-invalid @enderror"
                                            name="bank_account" type="text"
                                            value="{{ old('bank_account', isset($data) ? $data->bank_account : '') }}">
                                        @error('bank_account')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="bank_name" class="form-label">Ngân hàng</label>
                                        <select name="bank" id="bank" class="form-control">
                                            <option value="">-------- Chọn ngân hàng --------</option>
                                            @foreach ($bank as $item)
                                                <option @if (isset($data) && $data->bank_id == $item->id) selected @endif
                                                    value="{{ $item->id }}">
                                                    {{ $item->shortName . ' - ' . $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="address" class="form-label">Địa chỉ</label>
                                        <input id="address" class="form-control @error('address') is-invalid @enderror"
                                            name="address" type="text"
                                            value="{{ old('address', isset($data) ? $data->user->address : '') }}">
                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- Buttons Row -->
                            <div class="row">
                                <div class="col-lg-12 d-flex justify-content-between">
                                    <div>
                                        <button type="submit" class="btn btn-primary w-md">
                                            <i class="fas fa-check-circle"></i> Xác nhận
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    @if (session('success'))
        <script>
            $(document).ready(function() {
                $.notify({
                    icon: 'icon-bell',
                    title: 'Cấu hình',
                    message: '{{ session('success') }}',
                }, {
                    type: 'secondary',
                    placement: {
                        from: "bottom",
                        align: "right"
                    },
                    time: 1000,
                });
            });
        </script>
    @endif
    <script>
        document.getElementById('logo').addEventListener('change', function(event) {
            const input = event.target;
            const reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('profileImage').src = e.target.result;
            };

            if (input.files && input.files[0]) {
                reader.readAsDataURL(input.files[0]);
            }
        });
    </script>
@endsection
