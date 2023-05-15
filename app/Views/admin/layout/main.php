<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title><?= $this->renderSection('title') ?></title>
    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!--Favicon-->
    <link rel="icon" type="image/png" href="<?=base_url('img/LOGO-TRABAJO-DIGNO.jpeg')?>" />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Nucleo Icons -->
    <link href="<?=base_url('css/nucleo-icons.css')?>" rel="stylesheet" />
    <link href="<?=base_url('css/nucleo-svg.css')?>" rel="stylesheet" />
    <!-- Popper -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <!-- Main Styling -->
    <link href="<?=base_url('css/argon-dashboard-tailwind.css')?>" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
        theme: {
            extend: {
            colors: {
                clifford: '#da373d',
            }
            }
        }
        }
    </script>
    <style type="text/tailwindcss">
    @layer utilities {
        .content-auto {
            content-visibility: auto;
        }
        }
    </style>

</head>

<body class="m-0 font-sans text-base antialiased font-normal Light:bg-slate-900 leading-default bg-gray-50 text-slate-500">

    <?= $this->include('admin/layout/nav') ?>
    
    <?= $this->include('admin/layout/header') ?>
    
    <?= $this->renderSection('content') ?>
    
    <!-- plugins -->
    <script src="<?=base_url('plugins/jQuery/jquery.min.js')?>"></script>
    <script src="<?=base_url('plugins/masonry/masonry.min.js')?>"></script>
    <script src="<?=base_url('plugins/clipboard/clipboard.min.js')?>"></script>
    <script src="<?=base_url('plugins/match-height/jquery.matchHeight-min.js')?>"></script>

    <!-- Main Script -->
    <script src="<?=base_url('js/script.js')?>"></script>

    <script src="<?=base_url('js/plugins/chartjs.min.js')?>" async></script>
    <!-- plugin for scrollbar  -->
    <script src="<?=base_url('js/plugins/tailwindcss.js')?>" async></script>
    <!-- main script file  -->

    <!-- JS  -->
    <script src="<?=base_url('js/argon-dashboard-tailwind.js')?>" async></script>

    <script src="https://cdn.tailwindcss.com/3.2.4"></script>
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>  
</body>

</html>