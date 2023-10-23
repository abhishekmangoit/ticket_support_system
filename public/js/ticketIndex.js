$(document).ready(function() {

    $(function () {

        var Url = $(location).attr('href');
        if ($("#assigned").length) {
            var table = $('#example1').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                  url: Url,
                  data: function (d) {
                        d.status = $('#status').val(),
                        d.priority = $('#priority').val(),
                        d.assigned = $('#assigned').val(),
                        d.category = $('#CategorySelect').val(),
                        d.search = $('input[type="search"]').val()
                    }
                },
                columns: [
                    {data: 'ticket_number', name: 'ticket_number'},
                    {data: 'title', name: 'title'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'category_id', name: 'category_id'},
                    {data: 'status', name: 'status'},
                    {data: 'priority', name: 'priority'},
                    {data: 'assigned', name: 'assigned'},
                    {data: 'action', name: 'action'},
                ],
                error: function (request, status, error) {
                    alert(request.responseText);
                }
            });
        } else {
            var table = $('#example1').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                  url: Url,
                  data: function (d) {
                        d.status = $('#status').val(),
                        d.priority = $('#priority').val(),
                        d.category = $('#CategorySelect').val(),
                        d.search = $('input[type="search"]').val()
                    }
                },
                columns: [
                    {data: 'ticket_number', name: 'ticket_number'},
                    {data: 'title', name: 'title'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'category_id', name: 'category_id'},
                    {data: 'status', name: 'status'},
                    {data: 'priority', name: 'priority'},
                    {data: 'action', name: 'action'},
                ],
                error: function (request, status, error) {
                    alert(request.responseText);
                }
            });
        }

        
    
        $('#search').click(function(){
            table.draw();
        });
          
      });

});