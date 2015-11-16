$(document).ready(function () {
    var studlist = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        limit:6,
        remote: '/search_for_student/%QUERY'
    });
    studlist.initialize();
    //student_list.clearRemoteCache();
    $('input[name=student]').typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        },
        {
            name: 'student_list',
            displayKey: 'value',
            templates:{
                suggestion: Handlebars.compile('<p style="padding: 0;"> {{ value }} </p>' +
                '<span> {{ name }} </span>'),
                empty:['<div class="alert alert-danger">Unable to find student</div>']
            },
            source: studlist.ttAdapter()
    });
});
