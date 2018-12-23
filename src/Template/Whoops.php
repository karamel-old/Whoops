<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Whoops, There is an error</title>
    <style>
        <?= file_get_contents(__DIR__.'/assets/css/bootstrap.min.css') ?>
        <?= file_get_contents(__DIR__.'/assets/css/vs2015.min.css') ?>
        <?= file_get_contents(__DIR__.'/assets/css/styles.css') ?>
    </style>
</head>
<body>
<div class="container-fluid" style="padding: 0;margin:0">
    <div class="col-md-5" style="padding: 0;margin:0">
        <div class="jumbotron" style="margin-bottom:0;">
            <div class="container">
                <h3>Error : <?= get_class($exception) ?></h3>
                <p><?= nl2br($exception->getMessage()) ?></p>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <h4>Stack Trace</h4>
                <p>
                    <?php foreach ($exception->getTrace() as $ex) { ?>
                    <?php if (!isset($ex['file'])) { ?><?php continue; ?><?php } ?>
                <div class="well well-sm">
                    Called Function : <strong><?= $ex['function'] ?><br></strong>
                    <small><?= $ex['file'] ?>:<?= $ex['line'] ?></small>
                </div>
                <?php } ?>
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-7" style="padding: 0;margin:0">
         <pre style=" margin-top: -20px;">
             <code id="error" data-start="<?= $exception->getLine() - 15 ?>">
<?php
$file = file($exception->getFile());
for ($i = $exception->getLine() - 15; $i < $exception->getLine() + 15; $i++) {
    if ($i == $exception->getLine() - 1) {
        echo "<mark class=\"highlight - block\">" . htmlspecialchars($file[$i]) . "</mark>";
    } else {
        echo(isset($file[$i]) ? htmlspecialchars($file[$i]) : '');
    }
}
?>
             </code><div style="padding:20px;"><strong><?= $exception->getFile() ?>
                     :<?= $exception->getLine() ?></strong></div>
        </pre>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    $varialbes = [
                        'GET Values' => $options['get'],
                        'Post Values' => $options['post'],
                        'Files Values' => $options['files'],
                        'SERVER Values' => $options['server'],
                        'SESSIONS Values' => $options['session'],
                        'ENV Values' => $options['env'],
                    ]
                    ?>
                    <?php foreach ($varialbes as $name => $varialbe) { ?>
                        <h3><?= $name ?></h3>
                        <?php if (count($varialbe) == 0) { ?>
                            <strong>
                                <pre>Empty</pre>
                            </strong>
                        <?php } else { ?>
                            <table class="table table-striped table-hover">
                                <?php foreach ($varialbe as $key => $value) { ?>
                                    <tr>
                                        <td><strong><?= $key ?></strong></td>
                                        <td><?php if (mb_strlen($value) > 150) { ?><textarea disabled
                                                                                             style="width:100%"><?= print_r($value, true) ?></textarea><?php } else { ?>
                                                <pre><?= print_r($value, true) ?></pre><?php } ?></td>
                                    </tr>
                                <?php } ?>
                            </table>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

<script>
    <?= file_get_contents(__DIR__ . '/assets/js/jquery.js') ?>
</script>
<script>
    <?php echo file_get_contents(__DIR__ . '/assets/js/highlight.min.js'); ?>
</script>
<script>
    function addSourceLineNumbers() {
        let data_start = parseInt(this.getAttribute('data-start'));
        let l = data_start;
        let result = this.innerHTML.replace(/\n/g, function () {
            let html;
            if (l == data_start)
                html = '<a class="line">' + l + '</a>';
            else
                html = "\n" + '<a class="line">' + l + '</a>';
            l++;
            return html;
        });
        this.innerHTML = result;
    }

    $(function () {
        hljs.initHighlightingOnLoad();
        $('#error').each(addSourceLineNumbers);
    });
</script>
</html>