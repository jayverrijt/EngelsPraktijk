let hoverbutton = document.getElementById('hoverButton');
let containerLeft = document.getElementById('containerLeft');
let containerLeftUl = document.getElementById('containerLeftUl');
let containerBottom = document.getElementById('containerBottom');
let yield = document.getElementById('yield');




hoverbutton.addEventListener('mouseover', function() {
    let s1 = document.getElementById('spanHome')
    let s2 = document.getElementById('spanDB')
    let s3 = document.getElementById('spanUsers')
    let s6 = document.getElementById('spanAdmin')


    if (s1.classList.contains('away') && s2.classList.contains('away') && s3.classList.contains('away') && s6.classList.contains('away')) {
        s1.classList.remove('away')
        s2.classList.remove('away')
        s3.classList.remove('away')
        s6.classList.remove('away')
        containerBottom.style.width = '90%';
        containerLeft.style.width = '10%';
        yield.style.width = '90%'
    } else {
        s1.classList.add('away')
        s2.classList.add('away')
        s3.classList.add('away')
        s6.classList.add('away')
        containerBottom.style.width = '97%';
        containerLeft.style.width = '3%';
        yield.style.width = '97%'
    }
}, false);

