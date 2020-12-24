$(document).ready(function() {
	
    var form_clone = $('#form-section .section:first').clone();
    var sectionsCount = 1;

    $('body').on('click', '.addsection', function() {
        sectionsCount++;

        var section = form_clone.clone().find(':input').each(function(){
            var newId = this.id + sectionsCount;
            $(this).prev().attr('for', newId);
            this.id = newId;
        }).end().appendTo('#form-section');

        return false;
    });

    $('#form-section').on('click', '.remove', function() {
        $(this).parent().fadeOut(300, function(){
            $(this).parent().remove();
            return false;
        });
        return false;
    });

});