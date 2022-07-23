<h1><?php echo Add_Popup_Cpt::$popupTitle ?></h1>
<form>
    <table class='cs-popup-setting-setting form-table' role="presentation">
        <tbody>
            <tr class="cs-popup-setting__config__input-wraper">
                <th scope="row">
                    <label for="popup_title">Title</label>
                </th>
                <td>
                    <input name="popup_title" type="text" class="regular-text" value='<?php echo Add_Popup_Cpt::$popupTitle ?>' />
                </td>
            <tr>
    </table>
    <h2 class="bekthemes-title">Popup Content</h2>
    <table class='cs-popup-setting-setting form-table' role="presentation">
        <tbody>
            <tr class="cs-popup-setting__config__input-wraper">
                <th scope="row">
                    <label for="popup_heading">Heading</label>
                </th>
                <td>
                    <textarea name="popup_heading" class="regular-text" disabled><?php echo Add_Popup_Cpt::$popupHeading ?></textarea>
                </td>
            <tr>
            <tr class="cs-popup-setting__config__input-wraper">
                <th scope="row">
                    <label for="popup_para">Paragraph</label>
                </th>
                <td>
                    <textarea name="popup_para" class="regular-text" disabled><?php echo Add_Popup_Cpt::$popupPara ?></textarea>
                </td>
            <tr>
        </tbody>
    </table>
    <!-- Button -->
    <h2 class="bekthemes-title">Popup Button</h2>
    <p id="tagline-description" class="description">
        Keep The <b>"Button Name"</b> Empty To Remove The Button
    </p>
    <table class="form-table" role="presentation">
        <tbody>
            <tr class="cs-popup-setting__config__input-wraper">
                <th scope="row">
                    <label>Redirect Button Link</label>
                </th>
                <td id="cs_redirect_button_link_wraper">
                    <input type="hidden" name="popup_redirect_url" value='<?php echo Add_Popup_Cpt::$popupRedirectUrl ?>' id="cs_redirect_button_link" class='regular-text' />
                    <input type='hidden' value='<?php echo Add_Popup_Cpt::$popupRedirectUrl ?>' id="cs_redirect_button_link_value" />
                    <select id="popup_redirect_url_type_select" name="popup_redirect_url_type" value='<?php echo Add_Popup_Cpt::$popupRedirectUrlType ?> '>
                        <option value="link" <?php if (Add_Popup_Cpt::$popupRedirectUrlType === 'link') : ?> selected="selected" <?php endif; ?>>Link</option>
                        <option value="post" <?php if (Add_Popup_Cpt::$popupRedirectUrlType === 'post') : ?> selected="selected" <?php endif; ?>>Post</option>
                        <option value="page" <?php if (Add_Popup_Cpt::$popupRedirectUrlType === 'page') : ?> selected="selected" <?php endif; ?>>Page</option>
                    <select>
                </td>
            <tr>
            <tr class="cs-popup-setting__config__input-wraper">
                <th scope="row">
                    <label for="popup_button_name">Redirect Button Name</label>
                </th>
                <td>
                    <input name="popup_button_name" type="text" class="regular-text" value='<?php echo Add_Popup_Cpt::$popupButtonName ?>' disabled/>
                </td>
            <tr>
        </tbody>
    </table>
    <h2 class="bekthemes-title">Popup Image</h2>
    <table class="form-table" role="presentation">
        <tbody>
            <tr class="cs-popup-setting__config__input-wraper">
                <th scope="row">
                    <label for="popup_image">Add Popup Image</label>
                </th>
                <td>
                    <?php echo BekThemes_Controller::add_view("add-popup-img"); ?>
                </td>
            <tr>
            <tr class="cs-popup-setting__config__input-wraper">
                <th scope="row">
                    <label for="location_shortcode">Add The Form Id</label>
                </th>
                <td>
                    <input type="text" name="location_shortcode" class="regular-text" value='<?php echo Add_Popup_Cpt::$locationShortcode ?>' placeholder='2923' />
                </td>
            <tr>
        </tbody>
    </table>
</form>