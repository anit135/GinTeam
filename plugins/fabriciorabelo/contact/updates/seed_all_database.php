<?php namespace FabricioRabelo\Contact\Updates;

use FabricioRabelo\Contact\Models\Template;
use October\Rain\Database\Updates\Seeder;

class SeedAllTables extends Seeder {

    public function run() {
        //
        // @todo
        //
        // Add a Welcome template or something
        //

// настройки в Settings - Mail configuration

//Sender name - Sender name
//Sender email - no-reply@ginteam.net
//Mail method - SMTP
//SMTP address - smtp.yandex.com
//SMTP port - 587
//SMTP encryption protocol - TLS
//SMTP authorization required - +
//Username - no-reply@ginteam.net
//Password - teamgin99

        Template::create([
            'title' => 'Contact Page',
            'slug' => 'contact-template',
            'autoresponse' => 1,
            'content' => "Hi {{ sender_name }},\r\n"
            . "A user left a message on your website at {{ 'now'|date('F, d Y H:i') }}.\r\n"
            . "Name: {{ name }}\r\n"
            . "Email: {{ email }}\r\n"
            . "Fax: {{ phone }}\r\n"
            . "Message: \r\n\n{{ body|raw }}\r\n",
            'content_html' => "<p>Hi {{ sender_name }},</p>\r\n"
            . "<p>A user left a message on your website at {{ 'now'|date('F, d Y H:i') }}.</p>\r\n"
            . "<div><strong>Name:</strong> {{ name }}</div>\r\n"
            . "<div><strong>Email:</strong> {{ email }}</div>\r\n"
            . "<div><strong>Fax:</strong> {{ phone }}</div>\r\n"
            . "<div><strong>Message:</strong><hr/></div>\r\n<div>{{ body|raw }}</div>\r\n",
            'fields' => 'name|required, email|required|email, phone|required, body|required',
            'sender_name' => 'GinTeam',
            'sender_email' => 'no-reply@ginteam.net',
            'recipient_name' => 'GTinfo',
            'recipient_email' => 'info@ginteam.net',
            'subject' => 'Contact page :: Message',
            'confirmation_text' => 'Thank you! Your message has been successfully received, we\'ll return the contact soon.',
        ]);
    }

}
