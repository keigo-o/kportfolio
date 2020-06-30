<script>
    var pastShowYear = new Date().getFullYear() -10;
    var futureShowYear = new Date().getFullYear() + 10;

    jQuery.noConflict();
    $( function() {
        $( "#end_day" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd',
            yearRange: pastShowYear + ":" + futureShowYear,
        });
    } );
</script>