<html>
<head>
  <meta charset="utf-8">
  <title>TSC Shop</title>
  <script>
    var responseData = @json($response); // Convert PHP array to JSON
    window.opener.postMessage({ response: responseData }, "http://localhost:5173/");
    window.close();
  </script>
</head>
<body>
</body>
</html>
