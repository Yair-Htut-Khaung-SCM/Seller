<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Car Seller Password Reset</title>
    <style>
      .container {
        width: 80%;
        margin: auto;
        text-align: center;
      }
      .box {
        background-color: #eee;
        padding: 1rem;
      }
      .brand-name {
        display: inline-block;
        color: #39b87e;
        font-size: 3rem;
        font-family: 'Segoe UI';
        font-weight: 500;
        text-align: center;
      }
      .title {
        display: inline-block;
        font-size: 1.5rem;
        font-family: 'Segoe UI';
        font-weight: 500;
        color: #222;
        margin-bottom: 1rem;
      }
      .text {
        display: inline-block;
        font-size: 1rem;
        font-family: 'Segoe UI';
        font-weight: 400;
        color: #555;
      }
      .btn-reset {
        display: inline-block;
        font-size: 1.2rem;
        text-decoration: none;
        font-family: 'Segoe UI';
        font-weight: 500;
        color: #fff;
        background-color: #39b87e;
        padding: 1rem;
        margin: 1rem;
      }
      .link-reset {
        font-size: 1rem;
        text-decoration: none;
        font-family: 'Segoe UI';
        font-weight: 400;
        color: #39b87e;
        text-align: center;
      }
      .logo {
        display: inline-block;
        color: #39b87e;
        text-align: center;
      }
      .footer {
        font-size: 1rem;
        color: #111;
        font-family: 'Segoe UI';
        font-weight: 400;
      }
      .user-email {
        color: #39b87e;
        font-weight: 400;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <h1 class="brand-name">Car Seller</h1>
      <div class="box">
        <h5 class="title">We received a request to reset your password.</h5>
        <p class="text">
          Use the link below to set up a new password for your account. If you
          did not request to reset your password, ignore this email and the link
          will expire on its own.
        </p>
        <a href={{ $link }} class="btn-reset" target="_blank" >SET NEW PASSWORD</a>
        <p class="text">
          If the button above isn't working, paste the link below into your
          browser :
        </p>
        <p><a href={{ $link }} class="link-reset" target="_blank" >{{ $link }}</a></p>
      </div>
      <h1 class="logo">Car Seller</h1>
      <div class="footer">
        <p>
          We love hearing from you! Have any questions? Please check out our
          Support.
        </p>
        <p>Car Seller Co. Ltd,.</p>
        <p>
          This email was sent to
          <span class="user-email">{{ $email }}</span>
        </p>
      </div>
    </div>
  </body>
</html>