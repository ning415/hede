<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Phalcon PHP Framework</title>
        <?= $this->assets->outputCss('style') ?> 
        <?= $this->assets->outputJs('script') ?> 
        <?= $this->assets->outputCss() ?> 
        <?= $this->assets->outputJs() ?> 
    </head>
    <body>
        <div class="container">
            <?= $this->getContent() ?>
        </div>

    </body>
</html>