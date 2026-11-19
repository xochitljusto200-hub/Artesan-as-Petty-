document.getElementById('f').addEventListener('submit', function (e) {
    e.preventDefault();
    document.getElementById('ok').style.display = 'block';
    this.reset();
});

var links = [].slice.call(document.querySelectorAll('#nav a'));
var secs = links.map(function (a) {
    return document.querySelector(a.getAttribute('href'));
});

function spy() {
    var y = window.scrollY + 120;
    var c = 0;
    
    secs.forEach(function (s, i) {
        if (s.offsetTop <= y) {
            c = i;
        }
    });
    
    links.forEach(function (a, i) {
        a.classList.toggle('on', i === c);
    });
}

window.addEventListener('scroll', spy);
spy(); 