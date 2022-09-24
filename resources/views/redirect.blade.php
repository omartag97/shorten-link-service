<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Redirect</title>
    <style>
        .container{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>
<body>
    <div class="container">
        <H1 id="RedirectingText"> </H1>
    </div>

    <script>
        var remaining = 5;
        const RedirectingText = document.getElementById("RedirectingText");

        const shortenURL = {!! json_encode($shortenURL) !!};

        // count down to redirect
        setInterval(() => {
            RedirectingText.innerHTML =`Redirecting in ${remaining} ...`;
            remaining --;
        }, 1000);

        // set 5s to redirect
        setTimeout(()=>{
        window.location.href = shortenURL;
        }, 5000);

    </script>
</body>
</html>
