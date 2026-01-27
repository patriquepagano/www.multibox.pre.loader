<?php

define('NEWS_TITLE', 'Novos Recursos Instalados');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="google" content="notranslate">
    <meta http-equiv="Content-Language" content="pt-br">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="expires" content="-1">
    <meta http-equiv="cache-control" content="no-cache, must-revalidate, post-check=0, pre-check=0">
    <meta http-equiv="expires" content="Wed, 1 Jan 1111 00:00:00 GMT">
    <meta name="description" content="news">
    <meta name="keywords" content="news">
    <title><?php echo NEWS_TITLE; ?></title>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "php/00.head.css.php"; ?>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "php/01.style.php"; ?>
</head>
<body>
    <!-- Navigation -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/index.navbar.php"; ?>
    <!-- Container Start -->
    <div class="container" style="margin-top: 1px;" align="center">
                <?php include $_SERVER['DOCUMENT_ROOT'] . "/news/news_bar.php"; ?>
        <div class="news-block">
            <h3><?php echo NEWS_TITLE; ?></h3>
            <p>Registro de mudanças e melhorias aplicadas no sistema.</p>
            <div class="news-log">
                <div class="news-log-item">
                    <div class="news-log-date">2026-01-26</div>
                    <div class="news-log-title">Barra de navegação responsiva (TV/PC vs celular)</div>
                    <div class="news-log-desc">Botões SVG inline em TV/PC, glyphicons no celular.</div>
                </div>
                <div class="news-log-item">
                    <div class="news-log-date">2026-01-26</div>
                    <div class="news-log-title">Tema escuro TV/PC (estilo GitHub)</div>
                    <div class="news-log-desc">Fundo escuro, contraste ajustado e inputs alinhados.</div>
                </div>
                <div class="news-log-item">
                    <div class="news-log-date">2026-01-26</div>
                    <div class="news-log-title">News subpáginas e sub-bar</div>
                    <div class="news-log-desc">Criação das páginas internas e barra de navegação.</div>
                </div>
                <div class="news-log-item">
                    <div class="news-log-date">2026-01-26</div>
                    <div class="news-log-title">Layout em blocos para leitura</div>
                    <div class="news-log-desc">Grid com até 4 blocos em TV e empilhamento no celular.</div>
                </div>
            </div>
        </div>
    </div>
    <!-- Javascript Libraries -->
    <script src="/js/jquery.js"></script>
    <script>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "php/scripts.php"; ?>
    </script>
</body>
</html>
