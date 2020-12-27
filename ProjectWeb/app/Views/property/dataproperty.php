 <table class="table table-sm table-striped" id="dataproperty">
     <thead>
         <tr>
             <th>No</th>
             <th>ID</th>
             <th>Nama Property</th>
             <th>Kota</th>
             <th>Luas</th>
             <th>Foto</th>
             <th>Aksi</th>
         </tr>
     </thead>
     <tbody>
         <?php $nomer = 0;
            foreach ($tampildata as $row) :
                $nomer++ ?>
             <tr>
                 <td><?= $nomer ?></td>
                 <td><?= $row["id"] ?></td>
                 <td><?= $row["namaproperty"] ?></td>
                 <td><?= $row["kota"] ?></td>
                 <td><?= $row["luas"] ?></td>
                 <td><?= $row["foto"] ?></td>
                 <td>
                     <button type="button" class="btn btn-info btn-sm" onclick="edit('<?= $row['id'] ?>')">Edit</button>
                     <button type="button" class="btn btn-danger btn-sm" onclick="hapus('<?= $row['id'] ?>')">Hapus</button>
                 </td>
             <tr>
             <?php endforeach; ?>
     </tbody>

 </table>

 <script>
     $(document).ready(function() {
         $('#dataproperty').DataTable();
     })

     function edit(id) {
         $.ajax({
             type: 'post',
             url: "<?= site_url('property/formedit') ?>",
             data: {
                 id: id
             },
             dataType: 'json',
             success: function(response) {
                 if (response.sukses) {
                     $('.viewmodal').html(response.sukses).show();
                     $("#modaledit").modal('show');
                 }
             },
             error: function(xhr, ajaxOptions, thrownException) {
                 alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
             }
         })
     }

     function hapus(id) {
         Swal.fire({
             title: 'Hapus',
             text: 'Yakin Hapus data ini ?',
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Ya',
             cancelButtonText: "Tidak"
         }).then((result) => {
             if (result.isConfirmed) {
                 $.ajax({
                     type: 'post',
                     url: "<?= site_url('property/hapus') ?>",
                     data: {
                         id: id
                     },
                     dataType: 'json',
                     success: function(response) {
                         if (response.sukses) {
                             Swal.fire({
                                 icon: 'success',
                                 title: 'Berhasil',
                                 text: response.sukses
                             })
                             dataproperty();
                         }
                     },
                     error: function(xhr, ajaxOptions, thrownException) {
                         alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                     }
                 })
             }
         })
     }
 </script>