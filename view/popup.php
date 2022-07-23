<div class="popup popup-<?php echo Bekthemes_Popup::$popupId ?>" id="bakethemesPopup<?php echo Bekthemes_Popup::$FormId ?>">
<div class="popup__overlay" id="bakethemesPopupOverlay<?php echo Bekthemes_Popup::$FormId ?>"></div>
    <div class="popup_wraper">
        <button class="popup__close-btn bakethemes-Popup-Close" id="bakethemesPopupCloseBtn<?php echo Bekthemes_Popup::$FormId ?>">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M2 2L22 22M2 22L22 2" stroke="black" stroke-width="3"/>
            </svg>
        </button>
        <div class="popup_content">
            <h2 class="popup_heading"><?php echo Bekthemes_Popup::$heading ?></h2>
            <p class="popup_para"><?php echo Bekthemes_Popup::$paragraph ?></p>
            <?php if(Bekthemes_Popup::$ButtonName) : ?>
            <form action="<?php echo Bekthemes_Popup::$redirect ?>">
                <button class="btn-content btn--dark"><?php echo Bekthemes_Popup::$ButtonName ?></button>
            </form>
            <?php endif ?>
        </div>
        <img src="<?php echo Bekthemes_Popup::$image ?>" class="popup_img"/>
    </div>
</div>