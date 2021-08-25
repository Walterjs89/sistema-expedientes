var tablaExpte;
$(function () {
	// Setup - add a text input to each footer cell
	$("#tbl_expediente thead tr").clone(true).appendTo("#tbl_expediente thead");
	$("#tbl_expediente thead tr:eq(1) th").each(function (i) {
		var title = $(this).text();
		$(this).html(
			'<input type="text" style="color: #000" value="" placeholder="' +
				title +
				'" />'
		);

		$("input", this).on("keyup change", function () {
			if (tablaExpte.column(i).search() !== this.value) {
				tablaExpte.column(i).search(this.value).draw();
			}
		});
	});


	var tablaExpte = $("#tbl_expediente").DataTable({
		orderCellsTop: true,
		fixedHeader: true,
		rowReorder: {
			selector: "td:nth-child(2)",
		},
		language: {
			sProcessing: "Procesando...",
			sLengthMenu: "Mostrar _MENU_ registros",
			sInfo: "Registros del _START_ al _END_  (_TOTAL_ registros)",
			sInfoFiltered: "",
			zeroRecords: "No se encontraron datos",
			infoEmpty: "No se encontraron datos",
			search: "Buscar",
			paginate: {
				first: "Primero",
				last: "Ultimo",
				next: "Siguiente",
				previous: "Anterior",
			},
		},
		processing: true,
		serverSide: true,
		dom: "Bfrtip",
		buttons: [
			{
				text: "Exportar a Excel",
				action: function (e, dt, node, config) {

					$("#tbl_expediente").table2excel({
						exclude: ".avoid-xls",
						name: "MEGA SEGURIDAD",
						filename: "MEGASEGURIDAD.xls", // do include extension
						preserveColors: true // set to true if you want background colors and font colors preserved
					    });
				},
			},
		],

		ajax: {
			url: baseurl + "CtrExpedientes/getExpedientes",
			type: "POST",
		},
		columnDefs: [
			{
				targets: [6],
				className: "avoid-xls",
			},
		],
		columns: [
			{ data: "cliente" },
			{ data: "numero" },
			{ data: "periodo" },
			{ data: "monto" },
			{ data: "pedido" },
			{
				orderable: true,
				render: function (data, type, row) {
					return '<span class="label label-success">' + row.estado + "</span>";
				},
			},
			{
				orderable: true,
				render: function (data, type, row) {
					return (
						'<a href="' +
						baseurl +
						"expediente/perfil/" +
						row.id +
						'" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-eye-open"></span> Ver</a> <a href="#" class="btn btn-primary btn-xs" onclick="editarExpte(\'' +
						row.id +
						"','" +
						row.cliente +
						"','" +
						row.numero +
						"','" +
						row.periodo +
						"','" +
						row.monto +
						"','" +
						row.pedido +
						"','" +
						row.fecha +
						"','" +
						row.estado +
						'\')" data-toggle="modal" data-target=".editarExpte"><span class="glyphicon glyphicon-edit"></span> Edit</a> <a href="#" class="btn btn-danger btn-xs" onclick="eliminarUsuario(\'' +
						row.id +
						'\')" data-toggle="modal" data-target=".eliminarUsuario"><span class="glyphicon glyphicon-trash"></span> Del</a>'
					);
				},
			},
		],
		drawCallback: function (response) {
			$(".amount_total").text(`$ ${ response.json.totalAmount }`);
		},

		order: [[0, "asc"]],
	});

	$("#agregarExpediente").on("submit", function (e) {
		e.preventDefault();
		var formData = new FormData(document.getElementById("agregarExpediente"));
		$.ajax({
			url: baseurl + "CtrExpedientes/agregar_expediente",
			type: "post",
			dataType: "html",
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
		}).done(function (res) {
			tablaExpte.ajax.reload();
			var json = $.parseJSON(res);
			$("#msg_agregarexpte").html(json.msg).delay(2000).hide(0);
			setTimeout(function () {
				$("#msg_agregarexpte").html("").delay(0).show(0);
			}, 1000);
		});
	});
});

editarExpte = function (
	id,
	cliente,
	numero,
	periodo,
	monto,
	pedido,
	fecha,
	estado
) {
	$("#mid").val(id);
	$("#mcliente").val(cliente);
	$("#mnumero").val(numero);
	$("#mperiodo").val(periodo);
	$("#mmonto").val(monto);
	$("#mpedido").val(pedido);
	$("#mfecha").val(fecha);
	document.getElementById("mestado").value = estado;
};

function updateAct(id, destino, origen, fecha) {
	$("#midact").val(id);
	$("#mdestino").val(destino);
	$("#morigen").val(origen);
	$("#mfecha").val(fecha);
}

eliminarExpte = function (id) {
	$("#meid").val(id);
};

function nuevaActividad(id) {
	$("#maid").val(id);
}

function verHistorial(id) {
	// $('#mhistorial').val(id);
	var par = {
		id_act: id,
	};
	$.ajax({
		url: baseurl + "CtrExpedientes/mostrar_historial",
		type: "post",
		dataType: "html",
		data: par,
	}).done(function (response) {
		console.log("hola");
		$("#msg_historial").html(response);
	});
}

function updateDatos(
	id,
	cliente,
	num_expte,
	periodo,
	monto,
	num_pedido,
	fecha
) {
	$("#mid").val(id);
	$("#mcliente").val(cliente);
	$("#mnumexpte").val(num_expte);
	$("#mperiodo").val(periodo);
	$("#mmonto").val(monto);
	$("#mnumpedido").val(num_pedido);
	$("#mfecha").val(fecha);
}

$(function () {
	$("#updateExpediente").on("submit", function (e) {
		e.preventDefault();
		var formData = new FormData(document.getElementById("updateExpediente"));
		$.ajax({
			url: baseurl + "CtrExpedientes/update_expediente",
			type: "post",
			dataType: "html",
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
		}).done(function (res) {
			tablaExpte.ajax.reload();
			var json = $.parseJSON(res);
			$("#msg_mexpte").html(json.msg).delay(2000).hide(0);
			setTimeout(function () {
				$("#msg_mexpte").html("").delay(0).show(0);
			}, 1000);
		});
	});
});

$(function () {
	$("#eliminarExpte").on("submit", function (e) {
		e.preventDefault();
		var formData = new FormData(document.getElementById("eliminarExpte"));
		$.ajax({
			url: baseurl + "CtrExpedientes/eliminar_expte",
			type: "post",
			dataType: "html",
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: function () {
				// $("#activo").prop("checked", false);
			},
		}).done(function (res) {
			tablaExpte.ajax.reload();
			var json = $.parseJSON(res);
			$("#msg_eexpte").html(json.msg).delay(2000).hide(0);
			setTimeout(function () {
				$("#deleteExpte").modal("hide");
				$("#msg_eexpte").html("").delay(0).show(0);
			}, 1000);
		});
	});
});

$(function () {
	$("#updateExpte").on("submit", function (e) {
		e.preventDefault();
		var formData = new FormData(document.getElementById("updateExpte"));
		$.ajax({
			url: baseurl + "CtrExpedientes/update_expte",
			type: "post",
			dataType: "html",
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: function () {
				// $("#activo").prop("checked", false);
			},
		}).done(function (res) {
			tablaExpte.ajax.reload();
			var json = $.parseJSON(res);
			$("#msg_expte").html(json.msg).delay(2000).hide(0);
			setTimeout(function () {
				$("#msg_expte").html("").delay(0).show(0);
			}, 1000);
		});
	});
});

// $(function(){
//   $("#agregarActividad").on("submit", function(e){
//     e.preventDefault();
//     var formData = new FormData(document.getElementById("agregarActividad"));
//     $.ajax({
//         url: baseurl+"CtrExpedientes/agregar_actividad",
//         type: "post",
//         dataType: "html",
//         data: formData,
//         cache: false,
//         contentType: false,
//         processData: false,
//         beforeSend: function(){
//           // $("#activo").prop("checked", false);
//         }
//       })
//       .done(function(res){
//         tablaExpte.ajax.reload();
//         var json = $.parseJSON(res);
//         $("#msg_expte").html(json.msg).delay(2000).hide(0);
//         setTimeout(function(){
//           $("#msg_expte").html("").delay(0).show(0);
//         },1000);
//       });
//   });
// });

$(function () {
	$("#updateActividad").on("submit", function (e) {
		e.preventDefault();
		var formData = new FormData(document.getElementById("updateActividad"));
		$.ajax({
			url: baseurl + "CtrExpedientes/update_actividad",
			type: "post",
			dataType: "html",
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
		}).done(function (res) {
			tablaExpte.ajax.reload();
			var json = $.parseJSON(res);
			$("#msg_aactividad").html(json.msg).delay(2000).hide(0);
			setTimeout(function () {
				$("#msg_aactividad").html("").delay(0).show(0);
			}, 1000);
		});
	});
});

$(function () {
	$("#agregarActividad").on("submit", function (e) {
		e.preventDefault();
		var formData = new FormData(document.getElementById("agregarActividad"));
		$.ajax({
			url: baseurl + "CtrExpedientes/agregar_actividad",
			type: "post",
			dataType: "html",
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
		}).done(function (res) {
			tablaExpte.ajax.reload();
			var json = $.parseJSON(res);
			$("#msg_agactividad").html(json.msg).delay(2000).hide(0);
			setTimeout(function () {
				$("#msg_agactividad").html("").delay(0).show(0);
			}, 1000);
		});
	});
});

$(function () {
	$("#agregarRelacionExpte").on("submit", function (e) {
		e.preventDefault();
		var formData = new FormData(
			document.getElementById("agregarRelacionExpte")
		);
		$.ajax({
			url: baseurl + "CtrExpedientes/agregar_relacion",
			type: "post",
			dataType: "html",
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
		}).done(function (res) {
			var json = $.parseJSON(res);
			$("#msg_arelacion").html(json.msg).delay(2000).hide(0);
			setTimeout(function () {
				$("#msg_arelacion").html("").delay(0).show(0);
			}, 1000);
		});
	});
});

var tablaAct;
$(function () {
	tablaAct = $("#tbl_act").DataTable({
		paging: true,
		info: false,
		filter: false,
		stateSave: false,
		ordering: false,
		language: {
			sProcessing: "Procesando...",
			sLengthMenu: "Mostrar _MENU_ registros",
			sInfo: "Registros del _START_ al _END_  (_TOTAL_ registros)",
			sInfoFiltered: "",
			zeroRecords: "No se encontraron datos",
			infoEmpty: "No se encontraron datos",
			search: "Buscar",
			paginate: {
				first: "Primero",
				last: "Ultimo",
				next: "Siguiente",
				previous: "Anterior",
			},
		},
	});
});
