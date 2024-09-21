
<?php
// autoRemoveToken();
 if (defined('_INCODE')!=1) {
    die('Access Denied');}
    // saveActivity();
?>

 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo !empty($data['pageTitle'])?$data['pageTitle']:'Unicode'?></title>
    <title><?php echo !empty($data['pageTitle']) ? $data['pageTitle'] : 'Unicode'; ?></title>
    <link rel="stylesheet" href="templates/css/style.css?ver=<?php echo time(); ?>">
    <link rel="stylesheet" href="module/users/style.css?ver=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"/>
    <style>
        body {
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }
        .login-form {
            background-color: #ffffff;
            padding: 40px 30px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .login-form .title {
            font-size: 26px;
            margin-bottom: 30px;
            font-weight: bold;
            color: #007bff;
            text-align: center;
        }
        .login-form .form-group {
            margin-bottom: 20px;
        }
        .login-form .form-control {
            border-radius: 5px;
            height: 50px;
            padding-left: 20px;
            font-size: 16px;
            border: 1px solid #ced4da;
            transition: border-color 0.3s ease;
        }
        .login-form .form-control:focus {
            border-color: #007bff;
            box-shadow: none;
        }
        .login-form button {
            background-color: #007bff;
            border: none;
            padding: 14px;
            border-radius: 5px;
            font-size: 18px;
            color: white;
            width: 100%;
            transition: background-color 0.3s ease;
        }
        .login-form button:hover {
            background-color: #0056b3;
        }
        .login-form .link {
            margin-top: 15px;
            text-align: center;
        }
        .login-form .link a {
            color: #007bff;
            text-decoration: none;
        }
        .login-form .link a:hover {
            text-decoration: underline;
        }
        input[type="text"], input[type="email"], input[type="password"] {
        width: 100%; /* Chiều rộng bằng 100% so với phần tử cha */
        max-width: 500px; /* Hoặc bạn có thể thiết lập một chiều rộng tối đa */
    
        html, body {
            height: 100%;
            margin: 0;
        }

        body {
            display: grid;
            grid-template-rows: 1fr auto;
        }

        .container {
            padding: 20px;
        }

        footer {
            background-color: #f8f9fa;
            padding: 10px 0;
            text-align: center;
            width: 100%;
        }
  
    }
    </style>
</head>
<body> 
    
