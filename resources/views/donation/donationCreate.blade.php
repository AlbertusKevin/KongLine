@extends('layout.app')
@section('title')
    Buat Donasi
@endsection

@section('content')
    @include('layout.message')
    <div class="container">
        <form action="/donation/create" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row mt-5 mb-5">
                <div class="col-md-10 offset-md-2 mb-5">
                    <h5 class="font-weight-bold">Pengajuan Event Donasi</h5>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group mb-5">
                        <label for="title">Judul Event</label>
                        <input type="text" class="form-control" id="title" name="title" aria-describedby="title"
                            placeholder="Judul Event" value="{{ old('title') }}">
                    </div>
                    <div class="form-group">
                        <label for="purpose">Tujuan dan Alasan Galang Dana</label>
                        <textarea class="form-control" id="purpose" name="purpose" rows="10"
                            placeholder="Tuliskan tujuan dan alasan dari event ini"
                            aria-describedby="purpose">{{ old('purpose') }}</textarea>
                        <small class="text-muted" id="valid-length">Minimal 300 karakter</small>
                    </div>
                    <div class="form-group mb-5">
                        <label for="category">Kategori</label>
                        <select class="form-control" id="category" name="category" aria-describedby="category">
                            @foreach ($listCategory as $category)
                                <option {{ $category->id == old('category') ? 'selected' : '' }}
                                    value="{{ $category->id }}">{{ $category->description }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-5">
                        <label for="donationTarget">Target Jumlah Donasi</label>
                        <input type="text" class="form-control" id="donationTarget" name="donationTarget"
                            aria-describedby="donationTarget" value="{{ old('donationTarget') }}">
                    </div>
                    <div class="form-group mb-5">
                        <label for="deadline">Lama Event Berlangsung (minggu)</label>
                        <input type="number" class="form-control" id="deadline" name="deadline" aria-describedby="deadline"
                            placeholder="e.g: 2 minggu" value="{{ old('deadline') }}">
                    </div>
                    <div class="form-group mb-5">
                        <label for="photo">Foto</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input choose-file" id="photo" name="photo">
                            <label class="custom-file-label" for="photo">Foto event donasi</label>
                        </div>
                    </div>
                    <div class="form-group mb-5 text-center">
                        <img src="{{ DEFAULT_FILE_PREVIEW }}" alt="" class="img-thumbnail img-preview">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group mb-5">
                        <label for="assistedSubject">Penerima Manfaat</label>
                        <input type="text" class="form-control" id="assistedSubject" name="assistedSubject"
                            aria-describedby="assistedSubject" value="{{ old('assistedSubject') }}">
                    </div>
                    <div class="form-group mb-5">
                        <label for="category">Bank</label>
                        <select class="form-control" id="bank" name="bank" aria-describedby="bank">
                            @foreach ($listBank as $bank)
                                <option {{ $bank->id == old('bank') ? 'selected' : '' }} value="{{ $bank->id }}">
                                    {{ $bank->bank }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-5">
                        <label for="accountNumber">No Rekening</label>
                        <input type="text" class="form-control" id="accountNumber" name="accountNumber"
                            aria-describedby="accountNumber"
                            value="{{ old('accountNumber') !== null ? old('accountNumber') : $user->accountNumber }}"
                            placeholder="No Rekening untuk transfer jika donasi terkumpul">
                    </div>
                    <div class="form-group mb-5">
                        <label>Rincian Penggunaan Dana</label>
                        <button type="button" class="ml-2 badge badge-pill badge-primary btn-add-allocation">add</button>
                        <table class="table table-sm text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Alokasi</th>
                                    <th scope="col">Nominal</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="allocation-list">
                                @if (old('allocationFor') !== null || old('nominal') !== null)
                                    @for ($i = 0; $i < count(old('allocationFor')); $i++)
                                        <tr>
                                            <td>
                                                <input type="text" name="allocationFor[]"
                                                    placeholder="e.g: biaya administrasi" autocomplete="off"
                                                    class="w-100 input-allocation"
                                                    value="{{ old('allocationFor')[$i] }}">
                                            </td>
                                            <td scope="row">
                                                <input type="text" name="nominal[]" placeholder="e.g: 150000"
                                                    autocomplete="off" class="w-100 input-allocation nominal"
                                                    value="{{ old('nominal')[$i] }}">
                                            </td>
                                            <td>
                                                <button type="button"
                                                    class="badge badge-danger badge-pill btn-remove-allocation">remove</button>
                                            </td>
                                        </tr>
                                    @endfor
                                @endif
                                <tr>
                                    <td>
                                        <input type="text" name="allocationFor[]" placeholder="e.g: biaya administrasi"
                                            autocomplete="off" class="w-100 input-allocation">
                                    </td>
                                    <td scope="row">
                                        <input type="text" name="nominal[]" placeholder="e.g: 150000" autocomplete="off"
                                            class="w-100 input-allocation nominal">
                                    </td>
                                    <td>
                                        <button type="button"
                                            class="badge badge-danger badge-pill btn-remove-allocation">remove</button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="check-terms-agreement"
                            name="check-terms-agreement" {{ old('check-terms-agreement') == 'on' ? 'checked' : '' }}>
                        <label for="check-terms-agreement">Setuju dengan Syarat & Ketentuan
                            YukBisaYuk</label>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-secondary verify-profile" data-toggle="modal"
                            data-target="#verification-petition"
                            {{ old('check-terms-agreement') == 'on' ? '' : 'disabled' }}>Verifikasi Profil</button>
                        <button type="submit" class="btn btn-secondary new-petition"
                            {{ old('check-terms-agreement') == 'on' ? '' : 'disabled' }}>Ajukan Event</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="modal fade" id="verification-petition" tabindex="-1" role="dialog" aria-labelledby="verification-petition"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h5 class="modal-title mb-3 font-weight-bold text-center" id="verification-petition">Verifikasi Data
                        Diri Anda</h5>
                    <form action="/event/create/verification" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="phone" placeholder="No Telp">
                        </div>
                        <div class="form-group text-right">
                            <button type="button" class="btn btn-primary verification-create">Verifikasi</button>
                            <button type="button" class="btn btn-secondary close-dismiss"
                                data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
