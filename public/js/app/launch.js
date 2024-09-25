let hoverbutton = document.getElementById('hoverButton');
let containerLeft = document.getElementById('containerLeft');
let containerLeftUl = document.getElementById('containerLeftUl');
let containerBottom = document.getElementById('containerBottom');
let yield = document.getElementById('yield');



hoverbutton.addEventListener('mouseover', function() {
    let s1 = document.getElementById('spanHome')
    let s2 = document.getElementById('spanWardrobe')
    let s3 = document.getElementById('spanFriends')
    let s4 = document.getElementById('spanShop')
    let s5 = document.getElementById('spanIYC')
    let s6 = document.getElementById('spanSettings')


    if (s1.classList.contains('away') && s2.classList.contains('away') && s3.classList.contains('away') && s4.classList.contains('away') && s5.classList.contains('away') && s6.classList.contains('away')) {
        s1.classList.remove('away')
        s2.classList.remove('away')
        s3.classList.remove('away')
        s4.classList.remove('away')
        s5.classList.remove('away')
        s6.classList.remove('away')
        containerBottom.style.width = '90%';
        containerLeft.style.width = '10%';
        yield.style.width = '90%'
    } else {
        s1.classList.add('away')
        s2.classList.add('away')
        s3.classList.add('away')
        s4.classList.add('away')
        s5.classList.add('away')
        s6.classList.add('away')
        containerBottom.style.width = '97%';
        containerLeft.style.width = '3%';
        yield.style.width = '97%'
    }



}, false);
