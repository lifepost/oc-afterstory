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