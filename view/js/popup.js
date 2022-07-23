
function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
  }

const setPopupCookie = (value,formId) => {
    console.log(getCookie('popupClosed' + formId))
    if(!getCookie('popupClosed' + formId)){
        document.cookie = "popupClosed" + formId + '=' + value; 
    }
    document.cookie = "popupClosed" + formId + '=' + value; 
}

// on popup close 
const closePopup = (closingElement,elementToHide,formId) => {
        if(closingElement){
            closingElement.addEventListener('click',() => {
                if(elementToHide){
                    elementToHide.style.display = 'none'
                    //Enable close popup cookie
                    setPopupCookie(true,formId)
                }
            })
        }
}



window.addEventListener('load',() => {
    let forms = document.getElementsByClassName('wpforms-form');
    //convert to an array
    forms = Array.from(forms)
    forms.map(form => {
        const formIdpopup = form.dataset.formid
        // On Form Submit 
        form.addEventListener('submit',() => {
            setPopupCookie(false,formIdpopup)
        })
        const formPopup = document.getElementById('bakethemesPopup' + formIdpopup);
        const popupOverlay = document.getElementById('bakethemesPopupOverlay' + formIdpopup);
        const popupCloseBtn = document.getElementById('bakethemesPopupCloseBtn' + formIdpopup);
        if(getCookie("popupClosed" + formIdpopup) === 'true'){

            console.log(formPopup)
        }
        //Close Popup
        closePopup(popupCloseBtn,formPopup,formIdpopup)
        closePopup(popupOverlay,formPopup,formIdpopup)
    })
})

