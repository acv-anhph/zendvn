$(document).ready(function (e) {
    $('input[name="checkall-toggle"]').change(function () {
        var checkStatus = $(this).prop( "checked" );
        $("#adminForm").find(':checkbox').each(function (i, val) {
            $(this).prop( "checked", checkStatus);
        })
    });

    $("a.modal").click(function () {
        var url = $(this).data("link");
        if (url) {
            submitForm(url);
        }
    });

    $("#filter-bar button[name='submit-keyword']").click(function () {
        $('#adminForm').submit();
    });

    $("#filter-bar button[name='clear-keyword']").click(function () {
        $("input[name='filter_search']").val('');
        $('#adminForm').submit();
    });

    $("#filter-bar select[name='filter_state']").change(function () {
        $('#adminForm').submit();
    });

    $("#filter-bar select[name='filter_acp']").change(function () {
        $('#adminForm').submit();
    });

    $("#filter-bar select[name='filter_group']").change(function () {
        $('#adminForm').submit();
    });
});

function sortList (column, order) {
    $("input[name='filter-column']").val(column);
    $("input[name='filter-column-dir']").val(order);
    $('#adminForm').submit();
}

function submitForm (url) {
    $("#adminForm").attr('action', url).submit();
}

function changeStatus (url) {
    $.get(url, function (data) {
        var id = data.id;
        var status = data.status;
        var link = data.link;
        var element = 'a#status-' + id;
        var classRemove = 'unpublish';
        var classAdd = 'publish';

        if (status == 0) {
            classRemove = 'publish';
            classAdd = 'unpublish';
        }

        $(element + ' span').removeClass(classRemove).addClass(classAdd);
        $(element).attr('href', 'javascript:changeStatus(\'' + link + '\');');

    }, 'json');
}

function changeGroupACP (url) {
    $.get(url, function (data) {
        console.log(data);
        var id = data.id;
        var groupACP = data.group_acp;
        var link = data.link;
        var element = 'a#group-acp-' + id;
        var classRemove = 'unpublish';
        var classAdd = 'publish';

        if (groupACP == 0) {
            classRemove = 'publish';
            classAdd = 'unpublish';
        }

        $(element + ' span').removeClass(classRemove).addClass(classAdd);
        $(element).attr('href', 'javascript:changeGroupACP(\'' + link + '\');');

    }, 'json');
}

function changePage (page) {
    $("input[name='filter-page']").val(page);
    $('#adminForm').submit();
}