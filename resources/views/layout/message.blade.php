@if (session('type') == 'success')
    <?php Alert::success('Berhasil', session('message')); ?>
@elseif(session('type') == 'error')
    <?php Alert::error('Gagal', session('message')); ?>
@endif
