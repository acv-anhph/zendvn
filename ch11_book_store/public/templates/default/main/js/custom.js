function getUrlVar(key){
    var result = new RegExp(key + "=([^&]*)", "i").exec(window.location.search);
    return result && unescape(result[1]) || "";
}

$(document).ready(function () {
    var controller = (getUrlVar('controller')) ? getUrlVar('controller') : 'index';
    var action = (getUrlVar('action')) ? getUrlVar('action') : 'index';
    var className = controller + '-' + action;
    $("#menu ul li." + className).addClass('selected');

    $("a#single_image").fancybox();

    $("a.tab1").click(function(e){
        $("div#tab1").css('display','block');
        $("div#tab2").css('display','none');
        $("a.tab2").removeClass('active');
        $("a.tab1").addClass('active');
        return false;
    });

    $("a.tab2").click(function(e){
        $("div#tab2").css('display','block');
        $("div#tab1").css('display','none');
        $("a.tab1").removeClass('active');
        $("a.tab2").addClass('active');
        return false;
    });
});