    <!-- Modal -->
  <div class="modal fade bd-example-modal-lg" id="modal-form" style="overflow:hidden;" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      
        <form action="" method="post" enctype="multipart/form-data" data-toggle="validator" class="form-horizontal">
            @csrf
            @method('post')

            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title"></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">

                    <div class="form-group row">
                        <label for="nama" class="col-md-2 col-md-offset-1 control-label">Nama</label>
                        <div class="col-md 6">
                            <input type="text" name="nama" id="nama" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                      <label for="jabatan" class="col-md-2 col-md-offset-1 control-label">Jabatan</label>
                      <div class="col-md 6">
                          <select name="jabatan" id="jabatan" class="form-control" style="width: 100px !important;" required>
                            <option value="Front end">Front End</option>
                            <option value="Back end">Back End</option>
                            <option value="UI/UX">UI/UX</option>
                            <option value="UI/UX">Mobile dev</option>
                          </select>
                          <span class="help-block with-errors"></span>
                      </div>
                    </div>

                      <div class="form-group row">
                        <label for="tgl_lahir" class="col-md-2 col-md-offset-1 control-label">Tanggal Lahir</label>
                        <div class="col-md 6">
                            <input type="text" name="tgl_lahir" id="tgl_lahir" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="umur" class="col-md-2 col-md-offset-1 control-label">Umur</label>
                        <div class="col-md 6">
                            <input type="number" name="umur" id="umur" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="Alamat" class="col-md-2 col-md-offset-1 control-label">Alamat</label>
                        <div class="col-md 6">
                            <input type="text" name="alamat" id="alamat" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="foto" class="col-md-2 col-md-offset-1 control-label">foto</label>
                        <div class="col-md 6">
                            <input type="file" name="foto" id="foto" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                      </div>

                </div>
                <div class="modal-footer">
                  <button  type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fa fa-xmark"></i> Batal</button>
                  <button class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Simpan</button>
                </div>
              </div>
        </form>

    </div>
  </div>
  


  