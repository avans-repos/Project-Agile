setupDropdown(
    document.getElementById('avans-menu'),
    document.getElementById('avans-mail-dropdown'),
    document.getElementById('avans-mail-dropdown-button')
);

setupDropdown(
    document.getElementById('avans-menu'),
    document.getElementById('avans-user-dropdown'),
    document.getElementById('avans-user-dropdown-button')
);

let timeout;

function setupDropdown(menu, list, anchor)
{
    list.style.height = '0px';

    menu.addEventListener('mouseleave', function() {collapse(list, anchor, 3)});
    anchor.addEventListener('mouseenter', function() {expand(list, anchor)});
    anchor.addEventListener('mouseleave', function(event) {
        if (document.elementFromPoint(event.clientX, event.clientY) == list.childNodes[1]) return;
        
        collapse(list, anchor, 0);
    });
}

function expand(list, anchor)
{
    clearInterval(timeout);
    timeout = setInterval(function() {
        console.log("expanding");
        let position = anchor.getBoundingClientRect();
        list.style.left = Math.round(position.left) + "px";
        list.style.top = Math.round(position.bottom) + "px";
        list.style.display = 'flex';
        if (parseInt(list.style.height) < 75*2)
            list.style.height = parseInt(list.style.height) + 20 + "px";
        else
            list.style.height = 75*2;
    }, 16);
}

function collapse(list, anchor, compensation)
{
    clearInterval(timeout);
    let collapseTimeout = setInterval(function() {
        console.log("collapsing");
        if (parseInt(list.style.height) >= 20) {
            let position = anchor.getBoundingClientRect();
            list.style.left = Math.round(position.left) + "px";
            list.style.top = Math.round(position.bottom) - compensation + "px";
            list.style.height = parseInt(list.style.height) - 20 + "px";
        } else {
            list.style.display = 'none';
            clearInterval(collapseTimeout);
        }
    }, 16);
}