<form id="form" action="<?= $form_act ?>" method="post" autocomplete="off">
  <div class="card-body">
    <div class="mb-1 row">
      <label class="col-lg-3 col-md-6 col-form-label required">Sekolah Id</label>
      <div class="col-lg-4">
        <input type="text" name="sekolah_id" class="form-control" value="<?= @$main->sekolah_id ?>" required>
      </div>
    </div>
    <div class="mb-1 row">
      <label class="col-lg-3 col-md-6 col-form-label required">Sekolah Nama</label>
      <div class="col-lg-8 col-md-6">
        <input type="text" name="sekolah_nm" class="form-control" value="<?= @$main->sekolah_nm ?>" required>
      </div>
    </div>
    <div class="mb-1 row">
      <label class="col-lg-3 col-md-6 col-form-label required">Provinsi</label>
      <div class="col-lg-8 col-md-6">
        <input type="text" name="provinsi" class="form-control" value="<?= @$main->provinsi ?>" required>
      </div>
    </div>
    <div class="mb-1 row">
      <label class="col-lg-3 col-md-6 col-form-label required">Kabupaten</label>
      <div class="col-lg-8 col-md-6">
        <input type="text" name="kabupaten" class="form-control" value="<?= @$main->kabupaten ?>" required>
      </div>
    </div>
    <div class="mb-1 row">
      <label class="col-lg-3 col-md-6 col-form-label">Logo</label>
      <div class="col-lg-6 col-md-6">
        <input type="file" name="logo" class="form-control" value="">
      </div>
    </div>
    <?php if (@$main->logo != '') : ?>
      <div class="mb-1 row">
        <label class="col-lg-3 col-md-6 col-form-label"></label>
        <div class="col-lg-3 col-md-6">
          <img src="<?= @$main->logo ?>" alt="logo" class="img-thumbnail" width="150">
        </div>
      </div>
    <?php endif; ?>
    <div class="mb-1 row">
      <label class="col-lg-3 col-md-6 col-form-label required">Aktif?</label>
      <div class="col-lg-8 col-md-6">
        <label class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="active_st" value="1" <?= (@$main == '') ? 'checked' : ((@$main->active_st == 1) ? 'checked' : '') ?>>
          <span class="form-check-label">Aktif</span>
        </label>
        <label class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="active_st" value="0" <?= (@$main != '') ? ((@$main->active_st == 0) ? 'checked' : '') : '' ?>>
          <span class="form-check-label">Tidak Aktif</span>
        </label>
      </div>
    </div>
    <div class="border-dotted"></div>
    <div class="row mt-2">
      <div class="col-9 offset-3">
        <button type="submit" class="btn btn-primary" onclick="_save(event)"><i class="fas fa-save me-2"></i> Simpan</button>
        <button type="button" class="btn btn-default" data-bs-dismiss="modal"><i class="fas fa-times me-2"></i> Batal</button>
      </div>
    </div>
  </div>
</form>