var tablaCliente;
$(function () {
  tablaCliente = $('#tbl_cliente').DataTable({
    'paging'      : true,
    'info'        : true,
    'filter'      : true,
    'stateSave'   : true,
    'ordering'    : false,
    "language": {
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sInfo":           "Registros del _START_ al _END_  (_TOTAL_ registros)",
        "sInfoFiltered":   "",
        "zeroRecords": "No se encontraron datos",
        "infoEmpty": "No se encontraron datos",
        "search": "Buscar",
      "paginate": {
        "first":      "Primero",
        "last":       "Ultimo",
        "next":       "Siguiente",
        "previous":   "Anterior"
      }
    },
    'processing': true,
    'serverSide':true,
    'ajax': {
        "url":baseurl+"CtrCliente/getClientes",
        "type":"POST",            
      },
      'columns': [
        // {data: 'id_cliente','sClass':'dt-body-center'},
        {data: 'cliente'},
        {data: 'telefono'},
        {data: 'correo'},
        // {data: 'correo'},
        {"orderable": true,
          render:function(data, type, row){
            return '<a href="'+baseurl+'cliente/perfil/'+row.id+'" class="btn btn-block btn-primary btn-xs">Ver</a>'
          }
        }
      ],
      "order" : [[0, "asc"]],
  });
});

$(function(){
  $("#agregarCliente").on("submit", function(e){
    e.preventDefault();
    var formData = new FormData(document.getElementById("agregarCliente"));
    $.ajax({
        url: baseurl+"CtrCliente/agregar_cliente",
        type: "post",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
      })
      .done(function(res){
        tablaCliente.ajax.reload();
        var json = $.parseJSON(res);
        $("#msg_cliente").html(json.msg).delay(2000).hide(0);
        setTimeout(function(){ 
          $("#msg_cliente").html("").delay(0).show(0);
        },1000);       
      });
  });
});

$(function(){
  $("#updateCliente").on("submit", function(e){
    e.preventDefault();
    var formData = new FormData(document.getElementById("updateCliente"));
    $.ajax({
        url: baseurl+"CtrCliente/update_cliente",
        type: "post",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
      })
      .done(function(res){
        tablaCliente.ajax.reload();
        var json = $.parseJSON(res);
        $("#msg_ucliente").html(json.msg).delay(2000).hide(0);
        setTimeout(function(){ 
          $("#msg_ucliente").html("").delay(0).show(0);
        },1000);       
      });
  });
});
