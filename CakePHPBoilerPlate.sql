-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 30, 2018 at 04:44 PM
-- Server version: 5.7.23-0ubuntu0.16.04.1
-- PHP Version: 7.0.30-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `CakePHPBoilerPlate`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `body` text,
  `published` tinyint(1) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `user_id`, `title`, `slug`, `body`, `published`, `created`, `modified`) VALUES
(1, 1, 'CakePHP details', 'CakePHP-details', 'Details about first post', 0, '2018-08-27 07:44:33', '2018-08-27 07:44:33');

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` int(11) NOT NULL,
  `title` varchar(60) CHARACTER SET utf8 DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `content` longtext CHARACTER SET utf8,
  `code` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 - active, 1 - inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `title`, `subject`, `content`, `code`, `created`, `modified`, `status`) VALUES
(1, 'Registration By Admin', 'Welcome to Website', '<!doctype html>\n<html>\n  <head>\n    <meta name="viewport" content="width=device-width" />\n    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />\n    <title>Simple Transactional Email</title>\n  </head>\n  <body class="">\n    <table border="0" cellpadding="0" cellspacing="0" class="body">\n      <tr>\n        <td class="container">\n          <div class="content">\n\n            <!-- START CENTERED WHITE CONTAINER -->\n            <span class="preheader">This is preheader text. Some clients will show this text as a preview.</span>\n            <table class="main">\n\n              <!-- START MAIN CONTENT AREA -->\n              <tr>\n                <td class="wrapper">\n                  <table border="0" cellpadding="0" cellspacing="0">\n                    <tr>\n                      <td>\n                        <p>Dear {NAME},</p>\n\n                        <p>Your account has been created successfully.</p>\n                        <p>Please Click or Press below button to activate your account.</p>\n                        <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">\n                          <tbody>\n                            <tr>\n                              <td align="left">\n                                <table border="0" cellpadding="0" cellspacing="0">\n                                  <tbody>\n\n                                    <tr>\n                                      <td> <a href="{ACTIVATION_LINK}" target="_blank">Activate Your Account</a> </td>\n                                    </tr>\n\n                                    \n                                    \n                                  </tbody>\n                                </table>\n                              </td>\n                            </tr>\n                          </tbody>\n                        </table>\n                        <p>By using below credentials you can access your account.</p>\n                        <p>Your Email- {USER_EMAIL}</p>\n                        <p>Your Password- {USER_PASSWORD}</p>\n\n\n                        <p>If clicking the link above does not work, copy and paste the URL in a new browser window instead.</p>\n                        <p>{ACTIVATION_LINK}</p>\n\n                        <p>Thanks & regards</p>\n                        <p>XYZ Company</p>\n                      </td>\n                    </tr>\n                  </table>\n                </td>\n              </tr>\n\n            <!-- END MAIN CONTENT AREA -->\n            </table>\n\n            <!-- START FOOTER -->\n            <div class="footer">\n              <table border="0" cellpadding="0" cellspacing="0">\n                <tr>\n                  <td class="content-block">\n                    <span class="apple-link">Company Address,Lorem Ipsum Lorem Ipsum</span>\n                    \n                  </td>\n                </tr>\n                <tr>\n                  <td class="content-block powered-by">\n                    Powered by <a href="javascript:void(0)">XYZ Company</a>.\n                  </td>\n                </tr>\n              </table>\n            </div>\n            <!-- END FOOTER -->\n\n          <!-- END CENTERED WHITE CONTAINER -->\n          </div>\n        </td>\n\n      </tr>\n    </table>\n  </body>\n    <style>\n      /* -------------------------------------\n          GLOBAL RESETS\n      ------------------------------------- */\n      img {\n        border: none;\n        -ms-interpolation-mode: bicubic;\n        max-width: 100%; }\n\n      body {\n        background-color: #f6f6f6;\n        font-family: sans-serif;\n        -webkit-font-smoothing: antialiased;\n        font-size: 14px;\n        line-height: 1.4;\n        margin: 0;\n        padding: 0;\n        -ms-text-size-adjust: 100%;\n        -webkit-text-size-adjust: 100%; }\n\n      table {\n        border-collapse: separate;\n        mso-table-lspace: 0pt;\n        mso-table-rspace: 0pt;\n        width: 100%; }\n        table td {\n          font-family: sans-serif;\n          font-size: 14px;\n          vertical-align: top; }\n\n      /* -------------------------------------\n          BODY & CONTAINER\n      ------------------------------------- */\n\n      .body {\n        background-color: #f6f6f6;\n        width: 100%; }\n\n      /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */\n      .container {\n        display: block;\n        Margin: 0 auto !important;\n        /* makes it centered */\n       \n        width: 100%; }\n\n      /* This should also be a block element, so that it will fill 100% of the .container */\n      .content {\n        box-sizing: border-box;\n        display: block;\n        Margin: 0 auto;\n        padding: 10px; }\n\n      /* -------------------------------------\n          HEADER, FOOTER, MAIN\n      ------------------------------------- */\n      .main {\n        background: #ffffff;\n        border-radius: 3px;\n        width: 100%; }\n\n      .wrapper {\n        box-sizing: border-box;\n        padding: 20px; }\n\n      .content-block {\n        padding-bottom: 10px;\n        padding-top: 10px;\n      }\n\n      .footer {\n        clear: both;\n        Margin-top: 10px;\n        text-align: center;\n        width: 100%; }\n        .footer td,\n        .footer p,\n        .footer span,\n        .footer a {\n          color: #999999;\n          font-size: 12px;\n          text-align: center; }\n\n      /* -------------------------------------\n          TYPOGRAPHY\n      ------------------------------------- */\n      h1,\n      h2,\n      h3,\n      h4 {\n        color: #000000;\n        font-family: sans-serif;\n        font-weight: 400;\n        line-height: 1.4;\n        margin: 0;\n        Margin-bottom: 30px; }\n\n      h1 {\n        font-size: 35px;\n        font-weight: 300;\n        text-align: center;\n        text-transform: capitalize; }\n\n      p,\n      ul,\n      ol {\n        font-family: sans-serif;\n        font-size: 14px;\n        font-weight: normal;\n        margin: 0;\n        Margin-bottom: 15px; }\n        p li,\n        ul li,\n        ol li {\n          list-style-position: inside;\n          margin-left: 5px; }\n\n      a {\n        color: #3498db;\n        text-decoration: underline; }\n\n      /* -------------------------------------\n          BUTTONS\n      ------------------------------------- */\n      .btn {\n        box-sizing: border-box;\n        width: 100%; }\n        .btn > tbody > tr > td {\n          padding-bottom: 15px; }\n        .btn table {\n          width: auto; }\n        .btn table td {\n          background-color: #ffffff;\n          border-radius: 5px;\n          text-align: center; }\n        .btn a {\n          background-color: #ffffff;\n          border: solid 1px #3498db;\n          border-radius: 5px;\n          box-sizing: border-box;\n          color: #3498db;\n          cursor: pointer;\n          display: inline-block;\n          font-size: 14px;\n          font-weight: bold;\n          margin: 0;\n          padding: 12px 25px;\n          text-decoration: none;\n          text-transform: capitalize; }\n\n      .btn-primary table td {\n        background-color: #3498db; }\n\n      .btn-primary a {\n        background-color: #3498db;\n        border-color: #3498db;\n        color: #ffffff; }\n\n      /* -------------------------------------\n          OTHER STYLES THAT MIGHT BE USEFUL\n      ------------------------------------- */\n      .last {\n        margin-bottom: 0; }\n\n      .first {\n        margin-top: 0; }\n\n      .align-center {\n        text-align: center; }\n\n      .align-right {\n        text-align: right; }\n\n      .align-left {\n        text-align: left; }\n\n      .clear {\n        clear: both; }\n\n      .mt0 {\n        margin-top: 0; }\n\n      .mb0 {\n        margin-bottom: 0; }\n\n      .preheader {\n        color: transparent;\n        display: none;\n        height: 0;\n        max-height: 0;\n        max-width: 0;\n        opacity: 0;\n        overflow: hidden;\n        mso-hide: all;\n        visibility: hidden;\n        width: 0; }\n\n      .powered-by a {\n        text-decoration: none; }\n\n      hr {\n        border: 0;\n        border-bottom: 1px solid #f6f6f6;\n        Margin: 20px 0; }\n\n      /* -------------------------------------\n          RESPONSIVE AND MOBILE FRIENDLY STYLES\n      ------------------------------------- */\n      @media only screen and (max-width: 620px) {\n        table[class=body] h1 {\n          font-size: 28px !important;\n          margin-bottom: 10px !important; }\n        table[class=body] p,\n        table[class=body] ul,\n        table[class=body] ol,\n        table[class=body] td,\n        table[class=body] span,\n        table[class=body] a {\n          font-size: 16px !important; }\n        table[class=body] .wrapper,\n        table[class=body] .article {\n          padding: 10px !important; }\n        table[class=body] .content {\n          padding: 0 !important; }\n        table[class=body] .container {\n          padding: 0 !important;\n          width: 100% !important; }\n        table[class=body] .main {\n          border-left-width: 0 !important;\n          border-radius: 0 !important;\n          border-right-width: 0 !important; }\n        table[class=body] .btn table {\n          width: 100% !important; }\n        table[class=body] .btn a {\n          width: 100% !important; }\n        table[class=body] .img-responsive {\n          height: auto !important;\n          max-width: 100% !important;\n          width: auto !important; }}\n\n      /* -------------------------------------\n          PRESERVE THESE STYLES IN THE HEAD\n      ------------------------------------- */\n      @media all {\n        .ExternalClass {\n          width: 100%; }\n        .ExternalClass,\n        .ExternalClass p,\n        .ExternalClass span,\n        .ExternalClass font,\n        .ExternalClass td,\n        .ExternalClass div {\n          line-height: 100%; }\n        .apple-link a {\n          color: inherit !important;\n          font-family: inherit !important;\n          font-size: inherit !important;\n          font-weight: inherit !important;\n          line-height: inherit !important;\n          text-decoration: none !important; }\n        .btn-primary table td:hover {\n          background-color: #34495e !important; }\n        .btn-primary a:hover {\n          background-color: #34495e !important;\n          border-color: #34495e !important; } }\n\n    </style>\n</html>\n', 'REG001', '2018-08-22 07:16:17', '2018-08-22 07:16:17', 1),
(2, 'User Registration', 'Welcome to Website', '<!doctype html>\n<html>\n  <head>\n    <meta name="viewport" content="width=device-width" />\n    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />\n    <title>Simple Transactional Email</title>\n  </head>\n  <body class="">\n    <table border="0" cellpadding="0" cellspacing="0" class="body">\n      <tr>\n        <td class="container">\n          <div class="content">\n\n            <!-- START CENTERED WHITE CONTAINER -->\n            <span class="preheader">This is preheader text. Some clients will show this text as a preview.</span>\n            <table class="main">\n\n              <!-- START MAIN CONTENT AREA -->\n              <tr>\n                <td class="wrapper">\n                  <table border="0" cellpadding="0" cellspacing="0">\n                    <tr>\n                      <td>\n                        <p>Dear {NAME},</p>\n\n                        <p>Your account has been created successfully.</p>\n                        <p>Please Click or Press below button to activate your account.</p>\n                        <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">\n                          <tbody>\n                            <tr>\n                              <td align="left">\n                                <table border="0" cellpadding="0" cellspacing="0">\n                                  <tbody>\n\n                                    <tr>\n                                      <td> <a href="{ACTIVATION_LINK}" target="_blank">Activate Your Account</a> </td>\n                                    </tr>\n\n                                    \n                                    \n                                  </tbody>\n                                </table>\n                              </td>\n                            </tr>\n                          </tbody>\n                        </table>\n                        <p>By using below credentials you can access your account.</p>\n                        <p>Your Email- {USER_EMAIL}</p>\n                        <p>Your Password- {USER_PASSWORD}</p>\n\n\n                        <p>If clicking the link above does not work, copy and paste the URL in a new browser window instead.</p>\n                        <p>{ACTIVATION_LINK}</p>\n\n                        <p>Thanks & regards</p>\n                        <p>XYZ Company</p>\n                      </td>\n                    </tr>\n                  </table>\n                </td>\n              </tr>\n\n            <!-- END MAIN CONTENT AREA -->\n            </table>\n\n            <!-- START FOOTER -->\n            <div class="footer">\n              <table border="0" cellpadding="0" cellspacing="0">\n                <tr>\n                  <td class="content-block">\n                    <span class="apple-link">Company Address,Lorem Ipsum Lorem Ipsum</span>\n                    \n                  </td>\n                </tr>\n                <tr>\n                  <td class="content-block powered-by">\n                    Powered by <a href="javascript:void(0)">XYZ Company</a>.\n                  </td>\n                </tr>\n              </table>\n            </div>\n            <!-- END FOOTER -->\n\n          <!-- END CENTERED WHITE CONTAINER -->\n          </div>\n        </td>\n\n      </tr>\n    </table>\n  </body>\n    <style>\n      /* -------------------------------------\n          GLOBAL RESETS\n      ------------------------------------- */\n      img {\n        border: none;\n        -ms-interpolation-mode: bicubic;\n        max-width: 100%; }\n\n      body {\n        background-color: #f6f6f6;\n        font-family: sans-serif;\n        -webkit-font-smoothing: antialiased;\n        font-size: 14px;\n        line-height: 1.4;\n        margin: 0;\n        padding: 0;\n        -ms-text-size-adjust: 100%;\n        -webkit-text-size-adjust: 100%; }\n\n      table {\n        border-collapse: separate;\n        mso-table-lspace: 0pt;\n        mso-table-rspace: 0pt;\n        width: 100%; }\n        table td {\n          font-family: sans-serif;\n          font-size: 14px;\n          vertical-align: top; }\n\n      /* -------------------------------------\n          BODY & CONTAINER\n      ------------------------------------- */\n\n      .body {\n        background-color: #f6f6f6;\n        width: 100%; }\n\n      /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */\n      .container {\n        display: block;\n        Margin: 0 auto !important;\n        /* makes it centered */\n       \n        width: 100%; }\n\n      /* This should also be a block element, so that it will fill 100% of the .container */\n      .content {\n        box-sizing: border-box;\n        display: block;\n        Margin: 0 auto;\n        padding: 10px; }\n\n      /* -------------------------------------\n          HEADER, FOOTER, MAIN\n      ------------------------------------- */\n      .main {\n        background: #ffffff;\n        border-radius: 3px;\n        width: 100%; }\n\n      .wrapper {\n        box-sizing: border-box;\n        padding: 20px; }\n\n      .content-block {\n        padding-bottom: 10px;\n        padding-top: 10px;\n      }\n\n      .footer {\n        clear: both;\n        Margin-top: 10px;\n        text-align: center;\n        width: 100%; }\n        .footer td,\n        .footer p,\n        .footer span,\n        .footer a {\n          color: #999999;\n          font-size: 12px;\n          text-align: center; }\n\n      /* -------------------------------------\n          TYPOGRAPHY\n      ------------------------------------- */\n      h1,\n      h2,\n      h3,\n      h4 {\n        color: #000000;\n        font-family: sans-serif;\n        font-weight: 400;\n        line-height: 1.4;\n        margin: 0;\n        Margin-bottom: 30px; }\n\n      h1 {\n        font-size: 35px;\n        font-weight: 300;\n        text-align: center;\n        text-transform: capitalize; }\n\n      p,\n      ul,\n      ol {\n        font-family: sans-serif;\n        font-size: 14px;\n        font-weight: normal;\n        margin: 0;\n        Margin-bottom: 15px; }\n        p li,\n        ul li,\n        ol li {\n          list-style-position: inside;\n          margin-left: 5px; }\n\n      a {\n        color: #3498db;\n        text-decoration: underline; }\n\n      /* -------------------------------------\n          BUTTONS\n      ------------------------------------- */\n      .btn {\n        box-sizing: border-box;\n        width: 100%; }\n        .btn > tbody > tr > td {\n          padding-bottom: 15px; }\n        .btn table {\n          width: auto; }\n        .btn table td {\n          background-color: #ffffff;\n          border-radius: 5px;\n          text-align: center; }\n        .btn a {\n          background-color: #ffffff;\n          border: solid 1px #3498db;\n          border-radius: 5px;\n          box-sizing: border-box;\n          color: #3498db;\n          cursor: pointer;\n          display: inline-block;\n          font-size: 14px;\n          font-weight: bold;\n          margin: 0;\n          padding: 12px 25px;\n          text-decoration: none;\n          text-transform: capitalize; }\n\n      .btn-primary table td {\n        background-color: #3498db; }\n\n      .btn-primary a {\n        background-color: #3498db;\n        border-color: #3498db;\n        color: #ffffff; }\n\n      /* -------------------------------------\n          OTHER STYLES THAT MIGHT BE USEFUL\n      ------------------------------------- */\n      .last {\n        margin-bottom: 0; }\n\n      .first {\n        margin-top: 0; }\n\n      .align-center {\n        text-align: center; }\n\n      .align-right {\n        text-align: right; }\n\n      .align-left {\n        text-align: left; }\n\n      .clear {\n        clear: both; }\n\n      .mt0 {\n        margin-top: 0; }\n\n      .mb0 {\n        margin-bottom: 0; }\n\n      .preheader {\n        color: transparent;\n        display: none;\n        height: 0;\n        max-height: 0;\n        max-width: 0;\n        opacity: 0;\n        overflow: hidden;\n        mso-hide: all;\n        visibility: hidden;\n        width: 0; }\n\n      .powered-by a {\n        text-decoration: none; }\n\n      hr {\n        border: 0;\n        border-bottom: 1px solid #f6f6f6;\n        Margin: 20px 0; }\n\n      /* -------------------------------------\n          RESPONSIVE AND MOBILE FRIENDLY STYLES\n      ------------------------------------- */\n      @media only screen and (max-width: 620px) {\n        table[class=body] h1 {\n          font-size: 28px !important;\n          margin-bottom: 10px !important; }\n        table[class=body] p,\n        table[class=body] ul,\n        table[class=body] ol,\n        table[class=body] td,\n        table[class=body] span,\n        table[class=body] a {\n          font-size: 16px !important; }\n        table[class=body] .wrapper,\n        table[class=body] .article {\n          padding: 10px !important; }\n        table[class=body] .content {\n          padding: 0 !important; }\n        table[class=body] .container {\n          padding: 0 !important;\n          width: 100% !important; }\n        table[class=body] .main {\n          border-left-width: 0 !important;\n          border-radius: 0 !important;\n          border-right-width: 0 !important; }\n        table[class=body] .btn table {\n          width: 100% !important; }\n        table[class=body] .btn a {\n          width: 100% !important; }\n        table[class=body] .img-responsive {\n          height: auto !important;\n          max-width: 100% !important;\n          width: auto !important; }}\n\n      /* -------------------------------------\n          PRESERVE THESE STYLES IN THE HEAD\n      ------------------------------------- */\n      @media all {\n        .ExternalClass {\n          width: 100%; }\n        .ExternalClass,\n        .ExternalClass p,\n        .ExternalClass span,\n        .ExternalClass font,\n        .ExternalClass td,\n        .ExternalClass div {\n          line-height: 100%; }\n        .apple-link a {\n          color: inherit !important;\n          font-family: inherit !important;\n          font-size: inherit !important;\n          font-weight: inherit !important;\n          line-height: inherit !important;\n          text-decoration: none !important; }\n        .btn-primary table td:hover {\n          background-color: #34495e !important; }\n        .btn-primary a:hover {\n          background-color: #34495e !important;\n          border-color: #34495e !important; } }\n\n    </style>\n</html>\n', 'REG002', '2018-08-22 07:16:17', '2018-08-22 07:16:17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `token_status` enum('1','2') NOT NULL DEFAULT '1' COMMENT '(1 for active , 2 for expire )',
  `status` enum('1','2','3') NOT NULL DEFAULT '2' COMMENT '(1 for ''Active'', 2 for Inactive, ''3'' for deleted)',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `token`, `token_status`, `status`, `created`, `modified`) VALUES
(1, 'Admin', 'admin@localhost.com', '$2y$10$PI3eItqTkL.pF6hWE.aEiu72iyr7Df4wEsrBXJZbdQTtzxQOBduW6', NULL, '1', '1', '2018-08-27 07:39:22', '2018-08-27 07:39:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `user_key` (`user_id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
