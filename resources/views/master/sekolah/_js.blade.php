<script type="text/javascript">
  var tabel = null;
  $(document).ready(function() {
    tabel = $('#datatable-main').DataTable({
      "language": {
        url: _base_url + 'dist/libs/DataTables/id.json',
      },
      "stateSave": true,
      "autoWidth": false,
      "processing": true,
      "responsive": true,
      "serverSide": true,
      "ordering": true,
      "order": [
        [0, 'asc']
      ],
      "ajax": {
        "url": "<?= $uri . '/ajax-datatables?n=' . request('n') ?>",
        "type": "POST"
      },
      "deferRender": true,
      "aLengthMenu": _datatableLengthMenu,
      "pageLength": 500,
      "columns": [{
          "data": "sekolah_id",
          "sortable": false,
          "render": function(data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
          }
        },
        {
          "data": "sekolah_id",
          "className": "text-left",
          "render": function(data, type, row, meta) {
            var uri_edit = '<?= $uri . '/form-modal/' ?>' + data;
            var uri_delete = '<?= $uri . '/delete/' ?>' + data;

            return '' +
              '<div class="btn-list btn-sm flex-nowrap">' +
              '  <div class="dropdown"> ' +
              '     <button class="btn btn-outline-primary btn-sm dropdown-toggle align-text-top" data-bs-toggle="dropdown">' +
              '          Aksi' +
              '     </button>' +
              '     <div class="dropdown-menu">' +
              '      <a class="dropdown-item p-1" href="javascript:void(0)" onclick="_modal(event, {uri: \'' + uri_edit + '\', size: \'modal-md\', position: \'normal\'})">' +
              '          <i class="fas fa-pencil-alt text-warning me-2"></i> Ubah Data' +
              '      </a>' +
              '      <a class="dropdown-item p-1" href="javascript:void(0)" onclick=_delete("' + uri_delete + '")>' +
              '          <i class="fas fa-trash text-danger me-2"></i> Hapus Data' +
              '      </a>' +
              '   </div>' +
              ' </div>' +
              '</div>';
          }
        },
        {
          "data": "sekolah_id",
          "className": "text-left",
          "render": function(data, type, row, meta) {
            var data = ifNull(data);
            var result = data;

            return result;
            result = data;
          }
        },
        {
          "data": "logo",
          "className": "text-left",
          "render": function(data, type, row, meta) {
            var data = ifNull(data);
            var result = "";
            if (data != '' && data != null) {
              result += '<img src="' + data + '" alt="logo" class="img-thumbnail" width="25">';
            }
            return result;
          }
        },
        {
          "data": "sekolah_nm",
          "className": "text-left",
          "render": function(data, type, row, meta) {
            var data = ifNull(data);
            var result = data;
            result = '<span class="">' + data + '</span>';
            return result;
          }
        },
        {
          "data": "provinsi",
          "className": "text-left",
        },
        {
          "data": "kabupaten",
          "className": "text-left",
        },
        {
          "data": "active_st",
          "className": "text-center",
          "render": function(data, type, row, meta) {
            var data = ifNull(data);
            var result = data;
            if (row['active_st'] == 1) {
              result = '<i class="fas fa-check-circle text-success "></i>';
            } else {
              result = '<i class="fas fa-times-circle text-danger"></i>';
            }
            return result;
          }
        },
      ],
    });
    // tabel.draw();
  });
</script>