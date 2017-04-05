$(function()
{
    $(document).on('click', '.btn-add', function(e)
    {
        e.preventDefault();

        if (document.getElementsByName("accessionNumber[]").length >= 5) {
            alert('You can only loan up to 5 books at a time.');
            return false;
        }
        var controlForm = $('.dynamicArea'),
            currentEntry = $(this).parents('.entry:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlForm);

        newEntry.find('input').val('');

        controlForm.find('.entry:not(:last) .btn-add')
            .removeClass('btn-add').addClass('btn-remove')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<span class="glyphicon glyphicon-minus"></span>');
    }).on('click', '.btn-remove', function(e)
    {
		$(this).parents('.entry:first').remove();

		e.preventDefault();
		return false;
	});
});