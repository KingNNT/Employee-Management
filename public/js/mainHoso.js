const menubtn = document.querySelector('.menuBtn');
let menuOpen = false;
menubtn.addEventListener('click', () => {
    if (!menuOpen){
        menubtn.classList.add('openmenu');
        document.getElementById('containerMain').style.marginLeft="-140px";
        menuOpen = true;
    } else 
    {
        menubtn.classList.remove('openmenu');
        document.getElementById('containerMain').style.marginLeft="0px";
        menuOpen = false;
    }
});

