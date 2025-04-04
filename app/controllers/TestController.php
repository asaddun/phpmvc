<?php

class TestController extends Controller
{

    public function page()
    {
        $url = rtrim($_GET['url'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);
        var_dump($_GET['url']);
        var_dump($url[1]);
    }

    public function email()
    {
        $recipientEmail = 'muhammadasaddun@gmail.com';
        $subject = 'Reset Password';
        $loginurl = BASEURL . '/auth';
        $body = '
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Reset Password</title>
            <style>
                /* Define the custom container class */
                .container {
                    width: 100%;
                    max-width: 720px;
                    /* Adjust this based on your design */
                    margin: 0 auto;
                    /* Center the container */
                    padding-left: 15px;
                    padding-right: 15px;
                }

                /* Responsive behavior */
                @media (max-width: 1200px) {
                    .container {
                        max-width: 960px;
                    }
                }

                @media (max-width: 992px) {
                    .container {
                        max-width: 720px;
                    }
                }

                @media (max-width: 768px) {
                    .container {
                        max-width: 540px;
                    }
                }

                .btn {
                    display: inline-block;
                    padding: 10px 20px;
                    /* Adjust padding for size */
                    font-size: 16px;
                    /* Adjust font size */
                    font-weight: 600;
                    /* Bold text */
                    color: #fff;
                    /* Text color */
                    background-color: #007bff;
                    /* Default background color (Bootstrap blue) */
                    border: 1px solid #007bff;
                    /* Border to match background */
                    border-radius: 5px;
                    /* Rounded corners */
                    text-align: center;
                    /* Center the text */
                    text-decoration: none;
                    /* Remove underline for links */
                    cursor: pointer;
                    /* Pointer cursor on hover */
                    transition: all 0.3s ease;
                    /* Smooth transition for hover effects */
                }

                /* Hover effect */
                .btn:hover {
                    background-color: #0056b3;
                    /* Darker blue */
                    border-color: #0056b3;
                    /* Darker border */
                }
            </style>
        </head>

        <body>
            <div class="container">
                <div style="text-align: center;">
                    <h1>Reset Password</h1>
                </div>
                <h2>Halo!</h2>
                <p class="mb-3">Anda menerima email ini karena kami menerima permintaan reset password atas email ini.</p>
                <div style="text-align: center;">
                    <button class="btn">Reset Password</button>
                </div>
                <p >Jika anda tidak mengenali aktivitas ini, anda dapat mengabaikan email ini. Atau anda dapat <a
                        href="' . $loginurl . '">login</a> lalu mengubah password anda.
                </p>
            </div>
        </body>

        </html>
        ';

        Email::sendEmail($recipientEmail, $subject, $body);
    }
}
