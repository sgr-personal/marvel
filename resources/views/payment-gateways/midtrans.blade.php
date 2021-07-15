<!DOCTYPE html>
<html lang="en">
    <head>
        <title>{{ Cache::get('app_name', get('name')) }}</title>
    </head>
    <body>
        <iframe crossorigin="anonymous" width="100%" height="100%" style="border:none" id="iframe" src="{{ $response['redirect_url'] }}" />
    </body>
    <script type="text/javascript">
        const interval = setInterval(function() {
            var url = document.getElementById("iframe").contentWindow.location.href
            console.log(url);
        });
    </script>
</html>