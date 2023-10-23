$(document).ready(function() {

    $(function () {
      
        var Url = $(location).attr('href');
        var table = $('#example1').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
              url: Url,
              data: function (d) {
                    d.status = $('#status').val(),
                    d.category = $('#CategorySelect').val(),
                    d.search = $('input[type="search"]').val()
                }
            },
            columns: [
                {data: 'name', name: 'name'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action'},
            ],
            "columnDefs": [
                { "orderable": false, "targets": [1,2] } // Applies the option to all columns
              ],
        });
    
        $('#search').click(function(){
            table.draw();
        });
          
      });

});