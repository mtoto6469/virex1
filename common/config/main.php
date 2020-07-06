<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@upload'=>'@upload'
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        //application components
            'Smtpmail'=>array(
                'class'=>'application.extensions.smtpmail.PHPMailer',
                'Host'=>"smtp.mail.yahoo.com",
                'Username'=>'myemail@yahoo.com',
                'Password'=>'myemailpassword',
                'Mailer'=>'smtp',
                'Port'=>465,
                'SMTPAuth'=>true,
            ),
    ],

];
