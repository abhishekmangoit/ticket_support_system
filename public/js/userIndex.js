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
                    d.role = $('#role').val(),
                    d.search = $('input[type="search"]').val()
                }
            },
            columns: [
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'status', name: 'status'},
                {data: 'role', name: 'role'},
                {data: 'action', name: 'action'},
            ]
        });
    
        $('#search').click(function(){
            table.draw();
        });
          
      });

});