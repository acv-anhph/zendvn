function deleteGroup (id) {
    $.post('index.php?controller=group&action=delete', {id : id	}, function(data) {
        $('div#item-' + id).hide(500);
    });
}
