var tablaUsuario;
$(function () {
  tablaUsuario = $('#tbl_usuario').DataTable({
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
        "url":baseurl+"CtrUsuario/getUsuario",
        "type":"POST",            
      },
      'columns': [
        // {data: 'id_cliente','sClass':'dt-body-center'},
        {data: 'nombre'},
        {data: 'correo'},
        {data: 'permisos'},
        // {data: 'correo'},
        {"orderable": true,
          render:function(data, type, row){
            return '<a href="#" class="btn btn-primary btn-xs" onclick="editarUsuario(\''+row.id+'\',\''+row.nombre+'\',\''+row.correo+'\',\''+row.permisos+'\',\''+row.password+'\')" data-toggle="modal" data-target=".editarUsuario"><span class="glyphicon glyphicon-edit"></span> Edit</a> <a href="#" class="btn btn-danger btn-xs" onclick="eliminarUsuario(\''+row.id+'\')" data-toggle="modal" data-target=".eliminarUsuario"><span class="glyphicon glyphicon-trash"></span> Del</a>';
          }
        }
      ],
      "order" : [[0, "asc"]],
  });
});

var tablaEstado;
$(function () {
  tablaEstado = $('#tbl_estado').DataTable({
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
        "url":baseurl+"CtrUsuario/getEstado",
        "type":"POST",            
      },
      'columns': [
        // {data: 'id_cliente','sClass':'dt-body-center'},
        {data: 'fecha'},
        {data: 'estado'},
        // {data: 'permisos'},
        // {data: 'correo'},
        {"orderable": true,
          render:function(data, type, row){
            return '<a href="#" class="btn btn-danger btn-xs" onclick="eliminarEstado(\''+row.id+'\')" data-toggle="modal" data-target=".eliminarEstado"><span class="glyphicon glyphicon-trash"></span> Eliminar</a>';
          }
        }
      ],
      "order" : [[0, "asc"]],
  });
});

eliminarEstado =  function(id){
  $('#meid').val(id);
  // $('#mnombre').val(nombre);
  // $('#mcorreo').val(correo);
  // $('#mpermisos').val(permisos);
  // $('#mpassword').val(password);
}

editarUsuario =  function(id,nombre,correo,permisos,password){
  $('#mid').val(id);
  $('#mnombre').val(nombre);
  $('#mcorreo').val(correo);
  $('#mpermisos').val(permisos);
  $('#mpassword').val(password);
}

eliminarUsuario =  function(id){
  $('#meid').val(id);
}

$(function(){
  $("#agregarUsuario").on("submit", function(e){
    e.preventDefault();
    var formData = new FormData(document.getElementById("agregarUsuario"));
    $.ajax({
        url: baseurl+"CtrUsuario/agregar_usuario",
        type: "post",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
      })
      .done(function(res){
        tablaUsuario.ajax.reload();
        var json = $.parseJSON(res);
        $("#msg_usuario").html(json.msg).delay(2000).hide(0);
        setTimeout(function(){ 
          $("#msg_usuario").html("").delay(0).show(0);
        },1000);       
      });
  });
});

$(function(){
  $("#agregarEstado").on("submit", function(e){
    e.preventDefault();
    var formData = new FormData(document.getElementById("agregarEstado"));
    $.ajax({
        url: baseurl+"CtrUsuario/agregar_estado",
        type: "post",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
      })
      .done(function(res){
        tablaEstado.ajax.reload();
        var json = $.parseJSON(res);
        $("#msg_usuario").html(json.msg).delay(2000).hide(0);
        setTimeout(function(){ 
          $("#msg_usuario").html("").delay(0).show(0);
        },1000);       
      });
  });
});


$(function(){
  $("#updateUsuario").on("submit", function(e){
    e.preventDefault();
    var formData = new FormData(document.getElementById("updateUsuario"));
    $.ajax({
        url: baseurl+"CtrUsuario/update_usuario",
        type: "post",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
      })
      .done(function(res){
        tablaUsuario.ajax.reload();
        var json = $.parseJSON(res);
        $("#msg_ausuario").html(json.msg).delay(2000).hide(0);
        setTimeout(function(){ 
          $("#msg_ausuario").html("").delay(0).show(0);
        },1000);       
      });
  });
});

$(function(){
  $("#eliminarUsuario").on("submit", function(e){
    e.preventDefault();
    var formData = new FormData(document.getElementById("eliminarUsuario"));
    $.ajax({
        url: baseurl+"CtrUsuario/eliminar_usuario",
        type: "post",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
          $("#activo").prop("checked", false);
        }
      })
      .done(function(res){
        tablaUsuario.ajax.reload();
        var json = $.parseJSON(res);
        $("#msg_eusuario").html(json.msg).delay(2000).hide(0);
        setTimeout(function(){ 
          $('#deleteUsuario').modal('hide');
          $("#msg_eusuario").html("").delay(0).show(0);
        },1000);
      });
  });
});

$(function(){
  $("#eliminarEstado").on("submit", function(e){
    e.preventDefault();
    var formData = new FormData(document.getElementById("eliminarEstado"));
    $.ajax({
        url: baseurl+"CtrUsuario/eliminar_estado",
        type: "post",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
          $("#activo").prop("checked", false);
        }
      })
      .done(function(res){
        tablaEstado.ajax.reload();
        var json = $.parseJSON(res);
        $("#msg_eusuario").html(json.msg).delay(2000).hide(0);
        setTimeout(function(){ 
          $('#deleteUsuario').modal('hide');
          $("#msg_eusuario").html("").delay(0).show(0);
        },1000);
      });
  });
});

$('.select2').select2()

$('[data-mask]').inputmask()

function tipoFiltrado()
{
  tipo = document.getElementById('tipo').value;
  if (tipo == "cliente") {
    $('#cliente').attr("disabled", false);  
    $('#mes').attr("disabled", true);  
    $('#estado').attr("disabled", true);      
  }else if(tipo == "estado"){
    $('#cliente').attr("disabled", true);  
    $('#mes').attr("disabled", true);  
    $('#estado').attr("disabled", false);
  }else{
    $('#cliente').attr("disabled", true);  
    $('#mes').attr("disabled", false);  
    $('#estado').attr("disabled", true);
  }
}

$(function(){
  $("#generarReporte").on("submit", function(e){
    e.preventDefault();
    var formData = new FormData(document.getElementById("generarReporte"));
    $.ajax({
        url: baseurl+"CtrUsuario/generar_reporte",
        type: "post",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
      })
      .done(function(response){
        var json = $.parseJSON(response);
        // tablaUsuario.ajax.reload();
        $("#reporte_pdf").html(json.pdf);
        $("#reporte_excel").html(json.excel);
      });
  });
});