document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialDate: new Date,
                locale: 'pt-br',
                initialView: 'timeGridWeek',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                height: 'auto',
                navLinks: true, // can click day/week names to navigate views
                editable: true,
                selectable: true,
                selectMirror: true,
                nowIndicator: true,
                events: 'list_event.php',
                extraParams: function() {
                    return {
                        cachebuster: new Date().valueOf()
                    };
                },
                eventClick: function(info) { // Evento click

                    $('#myModal').modal('show')
                    // alert('Event: ' + info.event.title);
                    // alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                    // alert('View: ' + info.view.type);

                    // // change the border color just for fun
                    // info.el.style.borderColor = 'red';
                }

            });

            calendar.render();
        });