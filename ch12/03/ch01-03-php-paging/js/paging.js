var itemsPerPage	= 3;
var pages			= 0;
var totalItems		= 0;
var currentPage		= 1;

$(document).ready(function(){
    init();

    $("#slbPages").change(function () {
        currentPage = $(this).val();
        loadItems();
        showPageInfo();
    });

    $(".goPrevious").click(function () {
        if (currentPage > 1) {
            currentPage -= 1;
            loadItems();
            showPageInfo();
        }
    });

    $(".goNext").click(function () {
        if (currentPage < pages) {
            currentPage += 1;
            loadItems();
            showPageInfo();
        }
    });
});

function init() {
    $.ajax({
        url : 'load-data.php',
        type : 'POST',
        data: {type: 'count', itemsPerPage: itemsPerPage},
        dataType : 'json'
    }).done(function (data) {
        pages = data.pages;
        totalItems = data.totals;
        loadItems();
        showPageInfo();
        for(var i = 1; i <= pages; i++){
            $('#slbPages').append('<option value="' + i + '">Page ' + i +'</option>');
        }
    });
}

function showPageInfo() {
    $(".pageInfo").text('Page ' + currentPage + ' of ' + pages);
    $("#slbPages").val(currentPage);

    if (currentPage == 1) {
        $(".goPrevious").attr('disabled', 'disabled');
    } else {
        $(".goPrevious").removeAttr('disabled');
    }

    if (currentPage == pages) {
        $(".goNext").attr('disabled', 'disabled');
    } else {
        $(".goNext").removeAttr('disabled');
    }

}

function loadItems() {
    $.ajax({
        url : 'load-data.php',
        type : 'POST',
        data: {type: 'list', itemsPerPage: itemsPerPage, currentPage: currentPage},
        dataType : 'json'
    }).done(function (data) {
        if(data.length > 0){
            $('.content-course').empty();
            var xhtml = '';
            $.each(data, function(i, val){
                xhtml += '<div class="media">';
                xhtml += 	'<a class="pull-left" href="#">';
                xhtml += 		'<img class="media-object" src="data/'+ val.image + '">';
                xhtml += 	'</a>';
                xhtml += 	'<div class="media-body">';
                xhtml += 		'<h4 class="media-heading">'+ val.name + '</h4>' + val.description;
                xhtml += 	'</div>';
                xhtml += '</div>';
            });
            $('.content-course').append(xhtml);
        }
    });
}