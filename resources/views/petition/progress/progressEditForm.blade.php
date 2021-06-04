<div class="modal modal-edit-news fade" id="formEditNews" tabindex="-1" aria-labelledby="formEditNewsLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formEditNewsLabel">Edit Petisi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="editNews" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="title" class="col-sm-3 offset-md-1 col-form-label">Judul</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control edit-title" id="title" name="title"
                                value="{{ old('title') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="content" class="col-sm-3 offset-md-1 col-form-label">Isi Berita</label>
                        <div class="col-sm-7">
                            <textarea class="form-control edit-content" id="content" name="content" rows="10"
                                placeholder="ketikkan berita terbaru">{{ old('content') }}</textarea>
                            <small class="text-muted" id="valid-length">Minimal 300 karakter</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="image" class="col-sm-3 offset-md-1 col-form-label">Gambar</label>
                        <div class="col-sm-7">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input choose-file" id="image" name="image">
                                <label class="custom-file-label" for="image">Foto perkembangan petisi</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="col-sm-7 offset-md-4">
                            <img src="{{ DEFAULT_FILE_PREVIEW }}" alt="" class="img-thumbnail img-preview">
                        </div>
                    </div>
                    <div class="form-row">
                        <label for="link" class="col-sm-3 offset-md-1 col-form-label">Tautan</label>
                        <div class="form-group col-md-2">
                            <select id="protocol" name="protocol" class="form-control edit-protocol">
                                <option value="https://" {{ old('protocol') == 'https://' ? 'selected' : '' }}>
                                    https://
                                </option>
                                <option value="http://" {{ old('protocol') == 'http://' ? 'selected' : '' }}>
                                    http://
                                </option>
                            </select>
                        </div>
                        <div class="form-group-row col-md-5">
                            <input type="text" class="form-control edit-link" id="link" name="link"
                                value="{{ old('link') }}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>
