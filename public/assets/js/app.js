$(document).ready(function () {

    var alert = new Alert('#notifications');

    $('.btn-vote').click(function (e) {
        e.preventDefault();

        var form = $('#form-vote');

        var button = $(this);
        var ticket = button.closest('.ticket');
        var id = ticket.data('id');

        var action = form.attr('action').replace(':id', id);

        button.addClass('hidden');

        $.post(action, form.serialize(), function (response) {
            //alert
            //update count votes
            ticket.find('.btn-unvote').removeClass('hidden');

            alert.success('Gracias port su voto!');

        }).fail(function () {
            //print error message
            button.removeClass('hidden');

            alert.error('Ocurrió un error :(');
        });
    });

});
