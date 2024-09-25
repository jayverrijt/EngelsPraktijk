function toggleDropdown () {
    document.getElementById("dropdown").classList.toggle("away");
    let adminc = document.getElementById("controlContainer");
    if (adminc.classList.contains('show')) {
        adminc.classList.remove('show');
        adminc.classList.add('away');
    } else {
        adminc.classList.remove('away');
        adminc.classList.add('show');
    }
}
function toggleUnDropdown () {
    document.getElementById("undropdown").classList.toggle("away");
    let adminc = document.getElementById("controlContainer");
    if (adminc.classList.contains('show')) {
        adminc.classList.remove('show');
        adminc.classList.add('away');
    } else {
        adminc.classList.remove('away');
        adminc.classList.add('show');
    }
}
