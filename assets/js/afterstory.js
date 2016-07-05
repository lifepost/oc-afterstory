function showContent(id) {
    if(document.getElementById(id + '-content').style.display == 'none') {
        document.getElementById(id + '-content-short').style.display = 'none';
        document.getElementById(id + '-content').style.display = 'block';
        document.getElementById(id + '-more').innerHTML = '...감추기';
    } else {
        document.getElementById(id + '-content-short').style.display = 'block';
        document.getElementById(id + '-content').style.display = 'none';
        document.getElementById(id + '-more').innerHTML = '...더보기';
    }
}

function showBestContent(id) {
    if(document.getElementById(id + '-best-content').style.display == 'none') {
        document.getElementById('show-best-content').style.display = 'block';
    }
    var content = document.getElementById(id + '-best-content').innerHTML;
    document.getElementById('show-best-content').innerHTML = content;
}

$(function () {
    var showModal = function () {
        var browserWidth = $(window).width();
        if (browserWidth < 500) { return false; }
        var $input = $(this);
        var imgAlt = $input.attr("alt");
        $("#theModal h4.modal-title").html(imgAlt);
        var img = this;
        var picSrc = new Image();
        picSrc.src = $input.attr("src");
        var NewimgWidth = picSrc.width;
        if (browserWidth < NewimgWidth) {
            NewimgWidth = browserWidth - 40;
        }
        var NewImgHeight = picSrc.height;
        $("#theModal img").attr('src', picSrc.src);
        //set new image width
        $("div.modal-dialog").css("width", NewimgWidth);
        $("#theModal img").width(NewimgWidth);
        //set new image height
        $("#theModal img").height(NewImgHeight);
        $("#theModal").modal("show");
    };
    var MyHtml = '<div id="theModal" class="modal fade">' +
        ' <div class="modal-dialog ">' +
        '<div class="modal-content">' +
        ' <div class="modal-header">' +
        '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>' +
        '<h4 class="modal-title">이미지</h4>' +
        '</div>' +
        '<div class="modal-body">' +
        '  <img not-to-enlarge="true" class="img-responsive" + src=""alt="...">' +
        '</div>' +
        '<div class="modal-footer">' +
        '<button type="button" class="btn btn-default" data-dismiss="modal">' +
        'Close' +
        '</button>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>';
    $("div.afterstory-wrapper").append(MyHtml);
    $("img[not-to-enlarge!=true]").click(showModal);
    $("img[not-to-enlarge!=true]").css("cursor", "pointer");
});