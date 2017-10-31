function getUrlVar(key){
    var result = new RegExp(key + "=([^&]*)", "i").exec(window.location.search);
    return result && unescape(result[1]) || "";
}

$(document).ready(function () {
    var controller = (getUrlVar('controller')) ? getUrlVar('controller') : 'index';
    var action = (getUrlVar('action')) ? getUrlVar('action') : 'index';
    var className = controller + '-' + action;
    $("#menu ul li." + className).addClass('selected');
});