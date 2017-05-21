

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


$(document).on('keyup', '#search', function() {

    var value = $(this).val();
    var url = $(this).data('url');

    if(value.length) {

        $('.preloader-col').show();

        $.ajax({
            type: 'post',
            url: url,
            data: {
                search: value
            },
            success: function(response) {

                try {
                    response = JSON.parse(response);
                }
                catch (ex){}

                var html = '';
                $.each(response, function(index, value) {
                    html += '<a class="collection-item" href="/object/' + value.id + '">' + value.name + '</a>';
                });

                $('#search-result').html(html);

                $('.preloader-col').hide();
            }
        });


    }

});

$('.datepicker').pickadate({
    selectYears: 100,
    max: true
});