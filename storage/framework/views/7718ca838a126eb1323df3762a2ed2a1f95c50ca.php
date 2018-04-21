<?php
$config = [
'appName' => config('app.name'),
'locale' => $locale = app()->getLocale(),
'locales' => config('app.locales'),
'githubAuth' => config('services.github.client_id'),
];
$polyfills = [
'Promise',
'Object.assign',
'Object.values',
'Array.prototype.find',
'Array.prototype.findIndex',
'Array.prototype.includes',
'String.prototype.includes',
'String.prototype.startsWith',
'String.prototype.endsWith',
];
?>
<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title><?php echo e(config('app.name')); ?></title>

        <!--link rel="stylesheet" href="<?php echo e(mix('css/app.css')); ?>"-->
        <!-- Bootstrap core CSS -->
        <link href="<?php echo e(asset('user/vendor/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('user/css/blog-home.css')); ?>" rel="stylesheet">
        <link href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/components/icon.min.css" rel="stylesheet">
        <link href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/components/comment.min.css" rel="stylesheet">
        <link href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/components/form.min.css" rel="stylesheet">
        <link href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/components/button.min.css" rel="stylesheet">        
        <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
        <script src="https://apis.google.com/js/api:client.js"></script>
        <script type="text/javascript">
            var _token = "<?php echo e(csrf_token()); ?>";
        </script>
    </head>
    <body>
        <div id="app"></div>
        <!-- Footer -->
        <footer class="py-5 bg-dark">
            <div class="container">
                <p class="m-0 text-center text-white">Copyright &copy; Your Website 2018</p>
            </div>
            <!-- /.container -->
        </footer>
        
        <script>window.config = <?php echo json_encode($config, 15, 512) ?>;</script>

        
        <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=<?php echo e(implode(',', $polyfills)); ?>"></script>

        
        <?php if(app()->isLocal()): ?>
        <script src="<?php echo e(mix('js/app.js')); ?>"></script>
        <script src="<?php echo e(asset('user/vendor/jquery/jquery.min.js')); ?>"></script>        
        <script src="<?php echo e(asset('user/vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
        <?php else: ?>
        <script src="<?php echo e(mix('js/app.js')); ?>"></script>
        <script src="<?php echo e(asset('user/vendor/jquery/jquery.min.js')); ?>"></script>        
        <script src="<?php echo e(asset('user/vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
        <?php endif; ?>
    </body>
</html>