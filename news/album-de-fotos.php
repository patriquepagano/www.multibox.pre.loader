<?php

define('NEWS_TITLE', 'Album De Fotos');
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
<body class="page-news">
    <!-- Navigation -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/index.navbar.php"; ?>
    <!-- Container Start -->
    <div class="container" style="margin-top: 1px;" align="center">
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/news/news_bar.php"; ?>
        <div class="news-grid tvbox-grid">
            <div class="news-block news-top-right">
                <h3>Álbum de fotos 📸</h3>
                <p>👥 Ao longo dos anos, vários aplicativos passaram pelo nosso sistema para atender os pedidos da comunidade.</p>
                <p>📦 O último teste foi o Kodi, que na nossa visão entrega bem um álbum de fotos offline (fora da internet).</p>
                <p>🗳️ Sem um sistema de enquete para ouvir todos de forma organizada, ficou difícil lidar com o volume de dúvidas e suporte.</p>
                <p>📞 Muita gente perguntando “para que serve?”, “como configuro?”, “não está funcionando”. Por isso removemos o Kodi por enquanto, até melhorar a comunicação com a comunidade.</p>
            </div>
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/croudfounding.php"; ?>
            <div class="news-block news-bottom-left">
                <h4>Estamos trabalhando 🛠️</h4>
                <ul>
                    <li>🤔 Decidir entre usar o Kodi ou este site offline para ver fotos</li>
                    <li>💾 Testes de fotos em pendrive offline carregadas neste site</li>
                    <li>📤 Se não tem internet, como enviar as fotos para o TVBOX?</li>
                    <li>🧭 Guia de uso para usuários</li>
                    <li>🔒 Guia para provar que as fotos estão seguras e offline</li>
                    <li>📺 Fotos acessíveis na TV ou celular apenas na rede local</li>
                    <li>🤝 Compartilhamento privado por pareamento (precisa de enquete)</li>
                </ul>
            </div>
            <div class="news-block news-bottom-right">
                <h4>Limitações atuais ⚠️</h4>
                <ul>
                    <li>🫶🏻 Ajuda nas doações para pagar programadores e manter servidores ativos</li>
                    <li>📣 Comunicação com o usuário para entender a diferença entre suporte técnico e desenvolvimento por doação e cortesia</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Javascript Libraries -->
    <script src="/js/jquery.js"></script>
    <script>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "php/scripts.php"; ?>
                        (function () {
                if (!document.documentElement.classList.contains('client-tvbox')) return;
                var blocks = Array.prototype.slice.call(document.querySelectorAll('.news-grid .news-block'));
                if (!blocks.length) return;
                var perPage = 2;
                var page = 0;
                var totalPages = Math.ceil(blocks.length / perPage);
                function render() {
                    blocks.forEach(function (block, idx) {
                        var start = page * perPage;
                        var end = start + perPage;
                        block.style.display = (idx >= start && idx < end) ? '' : 'none';
                    });
                }
                function advance() {
                    page = (page + 1) % totalPages;
                    render();
                }
                var nextBtn = document.getElementById('tvbox-next');
                if (nextBtn) {
                    nextBtn.addEventListener('click', function (e) {
                        e.preventDefault();
                        advance();
                    });
                }
                if (blocks[1] && !blocks[1].querySelector('.tvbox-next-inline')) {
                    var btn = document.createElement('button');
                    btn.type = 'button';
                    btn.className = 'btn btn-default tvbox-next-inline';
                    btn.textContent = 'Proxima pagina';
                    btn.addEventListener('click', function () {
                        advance();
                    });
                    var wrap = document.createElement('p');
                    wrap.appendChild(btn);
                    blocks[1].appendChild(wrap);
                }
                render();
            })();;
    </script>
</body>
</html>
