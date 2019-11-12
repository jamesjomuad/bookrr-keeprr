$('.keeprr-comp-datetime').datetimepicker({
    minDate: moment().add(1, 'day')
});

component = {
    name: "Booker component",
    element: function(){
        return $('[data-request="booker::onBook"]');
    }
};

component.success = function(){
    $el = this.element();
    console.log($el)
    $el.find('.booker').fadeOut(function(){
        $el.find('.success').fadeIn();
    });
    $.oc.flashMsg({text: 'Booking successfull.', 'class': 'success', 'interval': 5});
}