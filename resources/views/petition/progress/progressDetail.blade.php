<div class="modal fade" id="detailNews" tabindex="-1" aria-labelledby="detailNewsLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bolder" id="detailNewsTitle">Title</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="overflow: auto;">
                <div class="row">
                    <div class="col text-center">
                        <img id="detailNewsImg" src="" alt="News Image" class="news-detail mb-3">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p id="detailNewsContent" class="detail-news">Content</p>
                        <a class="modal-title" id="detailNewsLink" href="">Link</a>
                    </div>
                </div>
            </div>
            @if ($user->id == $petition->idCampaigner)
                <div class="modal-footer">
                    <input type="hidden" id="id-news">
                    <button type="button" class="btn btn-primary" id="modal-form-edit" data-toggle="modal"
                        data-target="#formEditNews" data-dismiss="modal">ubah</button>
                    <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#hapus"
                        data-dismiss="modal">hapus</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Batalkan</button>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="modal fade" id="hapus" tabindex="-1" aria-labelledby="hapus-label" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h6 class="mb-4" style="line-height: 1.7">Apakah anda Yakin ingin menghapus berita ini?</h6>
                <form id="delete-news" action="" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="button" class="btn btn-warning mr-5" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
