    var calendar;
    var Calendar = FullCalendar.Calendar;
    $(function() {
        calendar = new Calendar(document.getElementById('agenda'), {
            headerToolbar: {
                left: 'prev,next today',
                right: 'dayGridMonth,dayGridWeek,list',
                center: 'title',
            },
            selectable: true,
            //Random default events
            events: BASE_URL + "evento/agenda",
            editable: true,
            locale:'es',
            height: '500px',
        });

        calendar.render();
});