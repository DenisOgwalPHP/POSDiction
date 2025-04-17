<div>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Calendar</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin/Dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Calendar</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="sticky-top mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Draggable Events</h4>
                                </div>
                                <div class="card-body">
                                    <!-- the events -->
                                    <div id="external-events">
                                        <div class="external-event bg-success">General Meeting</div>
                                        <div class="external-event bg-info">Live App Users Meet</div>
                                        <div class="external-event bg-primary">Live Administrators Meet</div>
                                        <div class="external-event bg-danger">New Version Upcoming</div>
                                        <div class="external-event bg-warning">Marketing Meeting</div>
                                        <div class="checkbox">
                                            <label for="drop-remove">
                                                <input type="checkbox" id="drop-remove">
                                                Remove after drop
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Create Event</h3>
                                </div>
                                <div class="card-body">
                                    <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                                        <ul class="fc-color-picker" id="color-chooser">
                                            <li><a class="text-primary" href="#"><i class="fas fa-square"></i></a>
                                            </li>
                                            <li><a class="text-warning" href="#"><i class="fas fa-square"></i></a>
                                            </li>
                                            <li><a class="text-success" href="#"><i class="fas fa-square"></i></a>
                                            </li>
                                            <li><a class="text-danger" href="#"><i class="fas fa-square"></i></a>
                                            </li>
                                            <li><a class="text-muted" href="#"><i class="fas fa-square"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /btn-group -->
                                    <form wire:submit.prevent="CreateEvent" action=""
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="input-group mb-3">
                                            <input id="new-event" type="text" wire:model="EventTitle"
                                                class="form-control" placeholder="Event Title">
                                            <!-- /btn-group -->
                                        </div>
                                        @error('EventTitle')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                        <div class="input-group mb-3">
                                            <input type="datetime-local" class="form-control" wire:model="eventdate"
                                                placeholder="Select Event Date" />
                                        </div>
                                        @error('eventdate')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                        <div class="input-group mb-3">
                                            <textarea class="form-control" placeholder="Event Description" wire:model="description"></textarea>
                                        </div>
                                        @error('description')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                        <div class="input-group mb-3">
                                            <select id="colorSelector" wire:model="eventlength" class="form-control">
                                                <option value="" selected>Select Event Length</option>
                                                <option value="1">All Day</option>
                                                <option value="0">Few Hours</option>
                                                <!-- Add more color options as needed -->
                                            </select>

                                        </div>
                                        @error('description')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                        <div class="input-group mb-3">
                                            <select id="colorSelector" wire:model="eventcolor" class="form-control">
                                                <option value="" disabled>Select Event color</option>
                                                <option value="#3c8dbc" selected class="bg-primary">Light Blue</option>
                                                <option value="#f56954" class="bg-danger">Red</option>
                                                <option value="#00a65a" class="bg-success">Green</option>
                                                <option value="#f39c12" class="bg-warning">Yellow</option>
                                                <option value="#00c0ef" class="bg-info">Aqua</option>
                                                <!-- Add more color options as needed -->
                                            </select>

                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-block btn-primary btn-lg">Add</button>
                                        </div>
                                        @error('eventcolor')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror

                                    </form>
                                    <!-- /input-group -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card card-primary" wire:ignore>
                            <div class="card-body p-0">
                                <!-- THE CALENDAR -->
                                <div id="calendar"></div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

</div>
@push('scripts')
    <script>
        $(function() {

            /* initialize the external events
             -----------------------------------------------------------------*/
            function ini_events(ele) {
                ele.each(function() {

                    // create an Event Object (https://fullcalendar.io/docs/event-object)
                    // it doesn't need to have a start or end
                    var eventObject = {
                        title: $.trim($(this).text()) // use the element's text as the event title
                    }

                    // store the Event Object in the DOM element so we can get to it later
                    $(this).data('eventObject', eventObject)

                    // make the event draggable using jQuery UI
                    $(this).draggable({
                        zIndex: 1070,
                        revert: true, // will cause the event to go back to its
                        revertDuration: 0 //  original position after the drag
                    })

                })
            }

            ini_events($('#external-events div.external-event'))

            /* initialize the calendar
             -----------------------------------------------------------------*/
            //Date for the calendar events (dummy data)
            var date = new Date()
            var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear()

            var Calendar = FullCalendar.Calendar;
            var Draggable = FullCalendar.Draggable;

            var containerEl = document.getElementById('external-events');
            var checkbox = document.getElementById('drop-remove');
            var calendarEl = document.getElementById('calendar');

            // initialize the external events
            // -----------------------------------------------------------------

            new Draggable(containerEl, {
                itemSelector: '.external-event',
                eventData: function(eventEl) {
                    return {
                        title: eventEl.innerText,
                        backgroundColor: window.getComputedStyle(eventEl, null).getPropertyValue(
                            'background-color'),
                        borderColor: window.getComputedStyle(eventEl, null).getPropertyValue(
                            'background-color'),
                        textColor: window.getComputedStyle(eventEl, null).getPropertyValue('color'),
                    };
                }
            });
            const eventData = @json($events);
            const eventdatas = eventData.map(event => ({
                title: event.EventName,
                start: new Date(event.EventDate),
                backgroundColor: event.EventColor,
                borderColor: event.EventColor,
                allDay: event.EventLength
            }));
            console.log(eventdatas);

            var calendar = new Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                themeSystem: 'bootstrap',
                //Random default events


                events: eventdatas,
                /* collectionData.forEach(item => {
                     title: $ {
                         item.EventName
                     },
                     start: new Date(y, m, 1),
                     backgroundColor: '#f56954', //red
                     borderColor: '#f56954', //red
                     allDay: true
                 });


                {
                    title: 'All Day Event',
                    start: new Date(y, m, 1),
                    backgroundColor: '#f56954', //red
                    borderColor: '#f56954', //red
                    allDay: true
                },
                {
                    title: 'Long Event',
                    start: new Date(y, m, d - 5),
                    end: new Date(y, m, d - 2),
                    backgroundColor: '#f39c12', //yellow
                    borderColor: '#f39c12' //yellow
                },
                {
                    title: 'Meeting',
                    start: new Date(y, m, d, 10, 30),
                    allDay: false,
                    backgroundColor: '#0073b7', //Blue
                    borderColor: '#0073b7' //Blue
                },
                {
                    title: 'Lunch',
                    start: new Date(y, m, d, 12, 0),
                    end: new Date(y, m, d, 14, 0),
                    allDay: false,
                    backgroundColor: '#00c0ef', //Info (aqua)
                    borderColor: '#00c0ef' //Info (aqua)
                },
                {
                    title: 'Birthday Party',
                    start: new Date(y, m, d + 1, 19, 0),
                    end: new Date(y, m, d + 1, 22, 30),
                    allDay: false,
                    backgroundColor: '#00a65a', //Success (green)
                    borderColor: '#00a65a' //Success (green)
                },
                {
                    title: 'Click for Google',
                    start: new Date(y, m, 28),
                    end: new Date(y, m, 29),
                    url: 'https://www.google.com/',
                    backgroundColor: '#3c8dbc', //Primary (light-blue)
                    borderColor: '#3c8dbc' //Primary (light-blue)
                }*/
                //],
                editable: true,
                droppable: true, // this allows things to be dropped onto the calendar !!!
                drop: function(info) {
                    // is the "remove after drop" checkbox checked?
                    if (checkbox.checked) {
                        // if so, remove the element from the "Draggable Events" list
                        info.draggedEl.parentNode.removeChild(info.draggedEl);
                    }
                }
            });

            calendar.render();
            // $('#calendar').fullCalendar()

            /* ADDING EVENTS */
            var currColor = '#3c8dbc' //Red by default
            // Color chooser button
            $('#color-chooser > li > a').click(function(e) {
                e.preventDefault()
                // Save color
                currColor = $(this).css('color')
                // Add color effect to button
                $('#add-new-event').css({
                    'background-color': currColor,
                    'border-color': currColor
                })
            })
            $('#add-new-event').click(function(e) {
                e.preventDefault()
                // Get value and make sure it is not null
                var val = $('#new-event').val()
                if (val.length == 0) {
                    return
                }

                // Create events
                var event = $('<div />')
                event.css({
                    'background-color': currColor,
                    'border-color': currColor,
                    'color': '#fff'
                }).addClass('external-event')
                event.text(val)
                $('#external-events').prepend(event)

                // Add draggable funtionality
                ini_events(event)

                // Remove event from text input
                $('#new-event').val('')
            })
        })
    </script>
@endpush
