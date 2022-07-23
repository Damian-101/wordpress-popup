const fetchPosts = (popUpLinkType) => {
    const domainName = window.location.origin
    const per_page = "&per_page=" + post_count[0].publish
    let url = domainName + '/wp-json/wp/v2/pages'
    if(popUpLinkType === 'post'){
        url = domainName + '/wp-json/wp/v2/posts?_embed' + per_page
    }
    return new Promise((resolve, reject) => {
        fetch(url)
            .then(res => {
                return res.json()
            })
            .then(data => {
                if (!data.code) {
                    resolve(data)
                } else {
                    reject(data.code)
                }
            })
            .catch(err => {
                reject(err)
            })
    })
}

/**
 * Render Input type accourdingly
 */

const addValue = async (popUpLinkType) => {
    const redirectButton = document.getElementById('cs_redirect_button_link')
    const redirectButtonUrl = document.getElementById('cs_redirect_button_link_value')
    const posts = await fetchPosts(popUpLinkType)
    if(redirectButton){
        const selectTag = document.createElement("option");
        selectTag.innerText = 'Select A Option'
        redirectButton.appendChild(selectTag)
        if(posts){
            posts.map(post => {
                const selectTag = document.createElement("option");
                selectTag.innerText = post.title.rendered
                selectTag.value = post.link
                redirectButton.appendChild(selectTag)
                if(redirectButtonUrl && redirectButtonUrl.value === post.link){
                    selectTag.selected = 'selected'
                }
            })
        }
    }
}


const inputType = (popUpLinkType) => {
    /**
     * Add The Placeholder html
     */
    const redirectButtonWraper = document.getElementById('cs_redirect_button_link_wraper')
    const redirectButtonUrl = document.getElementById('cs_redirect_button_link_value')
    const redirectButton = document.getElementById('cs_redirect_button_link')
    if(redirectButtonWraper){
        if (popUpLinkType === 'link') {
            const selectTag = document.createElement("input");
            selectTag.id = 'cs_redirect_button_link'
            selectTag.type = 'text'
            selectTag.name = 'popup_redirect_url'
            selectTag.className="regular-text"
            selectTag.value = redirectButtonUrl && redirectButtonUrl.value
            redirectButtonWraper.replaceChild(selectTag, redirectButton)
        }
        if (popUpLinkType === 'page') {
            const selectTag = document.createElement("select");
            selectTag.id = 'cs_redirect_button_link'
            selectTag.className="regular-text"
            selectTag.name = 'popup_redirect_url'
            redirectButtonWraper.replaceChild(selectTag, redirectButton)
            addValue(popUpLinkType)
        }
        if (popUpLinkType === 'post') {
            const selectTag = document.createElement("select");
            selectTag.id = 'cs_redirect_button_link'
            selectTag.className="regular-text"
            selectTag.name = 'popup_redirect_url'
            redirectButtonWraper.replaceChild(selectTag, redirectButton)
            addValue(popUpLinkType)
        }
    }


    // const posts = await fetchPosts()
    /**
     * Add Values
     */

}

window.addEventListener('load', () => {
    const popUpLinkType = document.getElementById('popup_redirect_url_type_select')
    if (popUpLinkType) {
        inputType(popUpLinkType.value)
        popUpLinkType.addEventListener('change', (e) => {
            console.log(e.target.value)
            inputType(e.target.value)
        })
    }
})




//////Form Validation//////

// Validation functions
const addRecommendedCharCount = (location,maxChar) => {
    const msgTag = document.createElement('p')
    msgTag.id = 'tagline-description'
    msgTag.className = 'description'
    msgTag.innerText = 'Maximum Character Count ' + maxChar;
    location.parentElement.appendChild(msgTag)
}

//Remove disabled Input
const removeDisabledAttr = (element) => {
    element.disabled = false
}

const disableTyping = () => {
    
}


// alert('as')
const addElementCharCount = (element,maxChar) => {
    removeDisabledAttr(element)
    let charLeft = maxChar - element.value.length
    const msgTag = document.createElement('p')
    msgTag.id = 'tagline-description'
    msgTag.className = 'description'
    msgTag.innerText = 'Characters Left ' + charLeft;
    element.setAttribute('maxlength',maxChar)
    // msgTag.setAttribute('maxlength',maxChar)
    //Update Current Character Count On Input Value Change
    element.addEventListener('input',(e) =>{
        charLeft = maxChar - e.target.value.length
        msgTag.innerText = 'Characters Left ' + charLeft;
    })


    // add character count to the parent element 
    element.parentElement.appendChild(msgTag)
}

//Get Input All Fields
window.addEventListener('load', () => {
    const title = document.getElementsByName("popup_title")[0]
    const heading = document.getElementsByName("popup_heading")[0]
    const paragraph = document.getElementsByName("popup_para")[0]
    const buttonName = document.getElementsByName("popup_button_name")[0]
    const counselorName = document.getElementsByName("counselor_name")[0]
    const counselorQualification = document.getElementsByName("qualification")[0]
    if(heading){
        addElementCharCount(heading,61)
    }
    if(paragraph){
        addElementCharCount(paragraph,84)
    }
    if(buttonName){
        addElementCharCount(buttonName,22)
    }
    if(counselorName){
        addElementCharCount(counselorName,16)
    }
    if(counselorQualification){
        addElementCharCount(counselorQualification,24)
    }
})