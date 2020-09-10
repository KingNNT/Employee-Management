const menubtn = document.querySelector('.menuBtn');
let menuOpen = false;
menubtn.addEventListener('click', () => {
    if (!menuOpen){
        menubtn.classList.add('openmenu');
        document.getElementById('container').style.marginLeft="-150px";
        menuOpen = true;
    } else 
    {
        menubtn.classList.remove('openmenu');
        document.getElementById('container').style.marginLeft="0px";
        menuOpen = false;
    }
});


// event popup
function popupEvent()
{
    document.getElementById('popup').style.display='none';
}
setTimeout(popupEvent,3000);

// load thông tin form Info
function loadFormInfo()
{
    var load = document.getElementById('contentInfo');
    load.classList.toggle('loadInfo');
}