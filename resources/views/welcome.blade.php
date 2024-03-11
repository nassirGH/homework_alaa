<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Your Project</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('https://images.pexels.com/photos/733856/pexels-photo-733856.jpeg?auto=compress&cs=tinysrgb&w=600');
            background-repeat: no-repeat;
            opacity: 0.8;
            background-size: cover;
            /* Cover the entire viewport */
        }

        .container {
            background-color: rgba(255, 255, 255, 0.9);
            /* Semi-transparent white background */
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
            text-align: center;
            max-width: 500px;
            width: 100%;
            margin-top: -250px;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        p {
            color: #666;
            margin-bottom: 40px;
        }

        .btn {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Welcome to My Project</h1>
        <p>“Unleash your creativity. Spark new ideas. Explore a world of possibilities“</p>
        <a href="{{ route('posts.index') }}" class="btn">Go to Posts Page</a>
    </div>
    <footer>
        &copy; 2024 Your Project Name
    </footer>
</body>

</html>