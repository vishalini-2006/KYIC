$(document).ready(function(){
    var table = $('#example').Datatable(
        {
            "ajax":'array.json',
            "deferRender": true
        });
});