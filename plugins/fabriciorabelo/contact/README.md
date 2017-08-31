# Contact Plugin

A powerful plugin to send email messages based on custom email templates.

## How do this work

Create an email template for OctoberCMS to help easily send email message from any page of your website. It works using the AJAX Framework, so jQuery is required. You can use Google reCaptcha, to protect your forms of spamming. You must configure your mail settings also your server should be able to send emails to this plugin work.

### Enabled injected variables on the page

You can access the following variables in your page embedding with Contact component:

* **renderReCaptcha:** return boolean value if the selected template enables or not the Google reCaptcha.
* **reCaptchaSiteKey:** return string value of selected template Google reCaptcha public key. This is injected in the page only if the selected template is enabled for Google reCaptcha.
* **reCaptchaLang:** return string value of selected template Google reCaptcha language. This is injected in the page only if the selected template is enabled for Google reCaptcha.
* **reCaptchaTheme:** return string value of selected template Google reCaptcha theme. This is injected in the page only if the selected template is enabled for Google reCaptcha.
* **reCaptcha_script:** return <script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl=en" async defer></script> value of Google reCaptcha javascript with his following selected language. This is injected in the page only if the selected template is enabled for Google reCaptcha.
* **reCaptcha_div:** return <div class="g-recaptcha" data-sitekey="your_site_key" data-theme="light"></div> value of Google reCaptcha with the public key and theme. This is injected in the page only if the selected template is enabled for Google reCaptcha.

### Using custom markup html

After create an email template, you can use your own html form:

If you need to customize the markup for custom styling, do not embed the component as instructed above. Instead, embed the following html anywhere and remove the bootstrap specific classes and add your own. However, you must leave the (data-request, data-request-success and data-request-update) data-attributes intact as they are needed for the ajax to work. Refer to this [doc section](http://octobercms.com/docs/cms/ajax) to know what's happening here in detail.

**Page: HTML Form**

```
<form role="form"
      data-request="onContactSent"
      data-request-update="'confirm': '.confirm-container'"
      data-request-success="$('#form-contact').slideUp(1000)" id="form-contact">

        <div>
            <label for="nameForm">Name</label>
            <input type="text" name="name" id="nameForm">
        </div>
        <div>
            <label for="emailForm">Email</label>
            <input type="text" name="email" id="emailForm">
        </div>
        <div>
            <label for="phoneForm">Phone</label>
            <input type="text" name="phone" id="phoneForm">
        </div>
        <div>
            <label for="subjectForm">Subject</label>
            <input type="text" name="subject" id="subjectForm">
        </div>
        <div>
            <label for="messageForm">Message</label>
            <textarea name="body" cols="30" rows="10" id="messageForm"></textarea>
        </div>
        {% if renderReCaptcha %}
        <div>
            <div class="g-recaptcha" data-sitekey="{{ reCaptchaSiteKey }}" data-theme="{{ reCaptchaTheme }}"></div>
        </div>
        {% endif %}
        <button type="submit">Send</button>
    </div>
</form>
<div class="confirm-container">
    <!--This will contain the confirmation when the email is successfully sent-->
</div>
{% if renderReCaptcha %}
<script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl={{ reCaptchaLang }}" async defer></script>
{% endif %}
```

**Partial: Confirm Result**

```
{% if result == true %}
    <h4>Email Sent successfully</h4>
    <p>
        {{ confirmation_text }}
    </p>
{% endif %}
```
