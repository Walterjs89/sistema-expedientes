  </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>MEGA SEGURIDAD.</strong>
  </footer>

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
  <!-- ./wrapper -->
  <!-- jQuery 3 -->
  <script src="<?= base_url() ?>assets/admin-lte/js/jquery.min.js"></script>
  <!-- <script src="https://vitalets.github.io/x-editable/assets/mockjax/jquery.mockjax.js"></script> -->
  <!-- Bootstrap 3.3.7 -->
  <script src="<?= base_url() ?>assets/admin-lte/js/bootstrap.min.js"></script>
  <!-- PACE -->
  <script src="<?= base_url() ?>assets/admin-lte/js/pace.min.js"></script>
  <!-- Select2 -->
  <script src="<?= base_url() ?>assets/admin-lte/js/select2.full.min.js"></script>
  <!-- InputMask -->
  <script src="<?= base_url() ?>assets/admin-lte/js/jquery.inputmask.js"></script>
  <!-- bootstrap datepicker -->
  <script src="<?= base_url() ?>assets/admin-lte/js/bootstrap-datepicker.min.js"></script>
  <script src="<?= base_url() ?>assets/admin-lte/js/bootstrap-datepicker.es.min.js"></script>
  <!-- FastClick -->
  <script src="<?= base_url() ?>assets/admin-lte/js/fastclick.js"></script>
  <!-- DataTables -->
  <script src="<?= base_url() ?>assets/admin-lte/js/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>assets/admin-lte/js/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.8/js/dataTables.fixedHeader.min.js"></script>

  <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
  <!-- fullCalendar -->
   <script src="<?= base_url() ?>assets/admin-lte/js/moment.js"></script>
  <script src="<?= base_url() ?>assets/admin-lte/js/fullcalendar.min.js"></script>
  <script src="<?= base_url() ?>assets/admin-lte/js/es.js"></script>
  <!-- SlimScroll -->
  <script src="<?= base_url() ?>assets/admin-lte/js/jquery.slimscroll.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url() ?>assets/admin-lte/js/adminlte.min.js"></script>

  <script src="<?= base_url() ?>assets/js/usuario.js"></script>
  <script src="<?= base_url() ?>assets/js/expediente.js"></script>
  <script src="<?= base_url() ?>assets/js/cliente.js"></script>
  
  <script type="text/javascript">
    var baseurl = "<?php echo base_url(); ?>";
  </script>
  <script>
  $(function () {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function init_events(ele) {
      ele.each(function () {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        })

      })
    }

    init_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()
    $('#calendar').fullCalendar({
      header    : {
        left  : 'prev,next today',
        center: 'title',
        right : 'month,agendaWeek,agendaDay'
      },
      buttonText: {
        today: 'today',
        month: 'month',
        week : 'week',
        day  : 'day'
      },
      //Random default events
      events    : [
        {
          title          : 'All Day Event',
          start          : new Date(y, m, 1),
          backgroundColor: '#f56954', //red
          borderColor    : '#f56954' //red
        }
      ],
      editable  : true,
      droppable : true, // this allows things to be dropped onto the calendar !!!
      drop      : function (date, allDay) { // this function is called when something is dropped

        // retrieve the dropped element's stored Event Object
        var originalEventObject = $(this).data('eventObject')

        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject)

        // assign it the date that was reported
        copiedEventObject.start           = date
        copiedEventObject.allDay          = allDay
        copiedEventObject.backgroundColor = $(this).css('background-color')
        copiedEventObject.borderColor     = $(this).css('border-color')

        // render the event on the calendar
        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove()
        }

      }
    })

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    //Color chooser button
    var colorChooser = $('#color-chooser-btn')
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      //Save color
      currColor = $(this).css('color')
      //Add color effect to button
      $('#add-new-event').css({ 'background-color': currColor, 'border-color': currColor })
    })
    $('#add-new-event').click(function (e) {
      e.preventDefault()
      //Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      //Create events
      var event = $('<div />')
      event.css({
        'background-color': currColor,
        'border-color'    : currColor,
        'color'           : '#fff'
      }).addClass('external-event')
      event.html(val)
      $('#external-events').prepend(event)

      //Add draggable funtionality
      init_events(event)

      //Remove event from text input
      $('#new-event').val('')
    })
  })
</script>
</body>
</html>
