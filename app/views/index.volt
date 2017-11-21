<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Phalcon PHP Framework</title>
        {{ assets.outputCss("style") }} {# ใช้ดึง collection css ชื่อ style #}
        {{ assets.outputJs("script") }} {# ใช้ดึง collection js ชื่อ script #}
        {{ assets.outputCss() }} {# ใช้ดึง css #}
        {{ assets.outputJs() }} {# ใช้ดึง Js #}
    </head>
    <body>
        <div class="container">
            {{ content() }}
        </div>

    </body>
</html>
