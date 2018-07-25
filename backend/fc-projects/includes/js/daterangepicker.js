function activateDatepicker(){
$('input[name="datefilter"]').daterangepicker({

        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        },
        parentEl: ".modal-lg",
        autoApply: true
});

$('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
    $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
});

$('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
    $(this).val('');
});

}
activateDatepicker();
// Picker de Add/Edit Project y Dataset

$('input[name="datefilter2"]').daterangepicker({

        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        },
        parentEl: "#datepicker",
        autoApply: true
});

$('input[name="datefilter2"]').on('apply.daterangepicker', function(ev, picker) {
    $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
});

$('input[name="datefilter2"]').on('cancel.daterangepicker', function(ev, picker) {
    $(this).val('');
});
