

$(document).ready(function() {
    $('select').material_select();
});


$(document).on('change', 'select[name="author[]"]', function() {
    // console.log(this);
    // console.log($(this).val());

    var authorIds = [];

    $('select[name="author[]"]').each(function(index, value) {

        console.log(value);
        authorIds[index] = $(value).val();
    });

    // console.log(authorIds);
    var countSelectRoles = $('select[name*="role"]').length;
    var self = $(this).parent().parent().parent();

    if(authorIds.length) {

        $.ajax({
            type: 'get',
            url: '/objects/add/select-row',
            data: {
                author_ids: authorIds,
                count_roles: countSelectRoles
            },
            success: function(response) {
                // console.log(response);
                console.log(countSelectRoles);


                self.after(response);
                $('select').material_select();
            }
        });
    }
});

$(document).on('click', '.remove-row', function(){
    var block = $(this).parent().parent();
    block.remove();
});