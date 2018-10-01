<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>

<div class="pys-box">
	<div class="pys-col">

        <h2 class="section-title">GDPR Consent Settings</h2>
        <p>According to GDPR rules, you'll have to inform and gather consent from your website visitors about the way
            you use their private data.</p>
        <p>PixelYourSite implements the Facebook pixel tracking code. Chances are that you have other scripts or
            third-party cookies running on your website (embedded videos, ad networks, chats, etc).</p>
        <p><strong>We suggest you globally manage cookie consent with a dedicated solution. On this page, we will
                list a few of them.</strong></p>
        <p><strong>Facebook Pixel</strong> is used for Facebook Ads and Facebook Analytics. It does use private data and
                you will need to ask for prior consent. Facebook also has also implemented flexible ways for their
            users to see and control how the pixel is used o partner websites. Inform your users about it <a
                    href="https://www.facebook.com/ads/preferences/?entry_product=ad_settings_screen"
                    target="_blank">https://www.facebook.com/ads/preferences/?entry_product=ad_settings_screen</a>.
        </p>
        <p>For more information about PixelYourSite and GDPR visit our
            <a href="http://www.pixelyoursite.com/gdpr-cookie-compliance" target="_blank">dedicated page</a>.</p>
        <hr>

        <h2 class="section-title">Cookie Consent Implementations</h2>
        <table class="layout">
            <tr class="tall">
                <td>
			        <?php pys_checkbox( 'gdpr', 'enable_before_consent' ); ?>Enable tracking before consent (for
                    Ginger – EU Cookie Law and Cookieboot plugins only)
                </td>
            </tr>
<!--            <tr>-->
<!--                <td>-->
<!--	                --><?php //if ( pys_is_gdpr_plugin_activated() ) : ?>
<!--		                --><?php //pys_checkbox( 'gdpr', 'gdpr_enabled' ); ?><!--GDPR plugin-->
<!--	                --><?php //else : ?>
<!--                        <input type="checkbox" disabled="disabled">GDPR plugin <a href="https://wordpress.org/plugins/gdpr/" target="_blank">https://wordpress.org/plugins/gdpr/</a>-->
<!--	                --><?php //endif; ?>
<!--                    <span class="help">Free solution that looks promising. It offers Privacy Preference management-->
<!--                        for Cookies with front-end preference UI & banner notifications.</span>-->
<!--                </td>-->
<!--            </tr>-->
            <tr>
                <td>
			        <?php if ( pys_is_ginger_plugin_activated() ) : ?>
				        <?php pys_checkbox( 'gdpr', 'ginger_enabled' ); ?>Ginger – EU Cookie Law plugin
			        <?php else : ?>
                        <input type="checkbox" disabled="disabled">Ginger – EU Cookie Law plugin <a
                                href="https://wordpress.org/plugins/ginger/" target="_blank">https://wordpress.org/plugins/ginger/</a>
			        <?php endif; ?>
                    <span class="help"><strong>Tracking will be disabled before consent is given.</strong></span>
                    <span class="help">This free plugin offers an interesting cookie consent integration with the
                        possibility to turn OFF cookies before consent is given.</span>
                </td>
            </tr>
            <tr class="tall">
                <td>
			        <?php if ( pys_is_cookiebot_plugin_activated() ) : ?>
				        <?php pys_checkbox( 'gdpr', 'cookiebot_enabled' ); ?>Cookieboot plugin
			        <?php else : ?>
                        <input type="checkbox" disabled="disabled">Cookieboot plugin <a href="https://wordpress.org/plugins/cookiebot/" target="_blank">https://wordpress.org/plugins/cookiebot/</a>
			        <?php endif; ?>
                    <span class="help">This is a complete premium solution that also offers a free plan for websites
                        with under 100 pages.</span>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="checkbox" disabled="disabled" checked="checked">PixelYourSite API
                    <span class="help">Plugins and themes can use <code>pys_disable_by_gdpr</code> filter to disable
                        tracking.</span>
                </td>
            </tr>
        </table>
        <button class="pys-btn pys-btn-blue pys-btn-big aligncenter">Save Settings</button>
	</div>
</div>
