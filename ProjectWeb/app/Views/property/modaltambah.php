<!-- Modal -->
<div class="modal fade" id="modaltambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Mahasiswa</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('property/simpandata', ['class' => 'formproperty']) ?>
            <?= csrf_field() ?>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">ID</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="id" name="id">
                        <div class="invalid-feedback errorId">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Nama Property</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control " id="namaproperty" name="namaproperty">
                        <div class="invalid-feedback errorNama">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Kota</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="kota" name="kota">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Luas</label>
                    <div class="col-sm-10">
                        <input type="input" class="form-control" id="luas" name="luas">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Foto</label>
                    <div class="col-sm-10">
                        <input type="input" class="form-control" id="foto" name="foto">
                    </div>
                </div>
                <!-- <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Jenkel</label>
                    <div class="col-sm-10">
                        <select name="jenkel" id="jenkel" class="form-control">
                            <option value="">-pilih-</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                </div> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btnsimpan">Save changes</button>
            </div>

            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.formproperty').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnsimpan').attr('disable', 'disable');
                    // $('.btnsimpan').html('<i class="fa fa-spin fa-spinner></i>')
                },
                complete: function() {
                    $('.btnsimpan').removeAttr('disable')
                    $('.btnsimpan').html('simpan')
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.id) {
                            $('#id').addClass('is-invalid');
                            $('.errorId').html(response.error.id);
                        } else {
                            $('#id').removeClass('is-invalid');
                            $('.errorId').html("");
                        }

                        if (response.error.nama) {
                            $('#namaproperty').addClass('is-invalid');
                            $('.errorNama').html(response.error.nama);
                        } else {
                            $('#namaproperty').removeClass('is-invalid');
                            $('.errorNama').html("");
                        }

                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,
                        })
                        $("#modaltambah").modal('hide');
                        dataproperty();
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }

            });
            return false;
        });
    });
</script>