<?php

define('NEWS_TITLE', 'Servidor Jellyfin');
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
                <h3>Servidor Jellyfin 🧊</h3>
                <p>🖥️ O Jellyfin Server é um servidor de mídia que organiza seus filmes, séries, músicas e fotos em um só lugar.</p>
                <p>📺 Ele cria sua própria “Netflix” local, para assistir na TV, celular ou computador, usando sua rede e seus arquivos.</p>
                <p>🔒 Você tem controle total do conteúdo, sem depender de serviços pagos.</p>
                <p>💡 Hoje, é a melhor solução para ter sua própria “Netflix” em casa, mas para isso você precisa de um computador. Dá para usar aquele PC antigo parado e transformar em um servidor pessoal de nuvem, seu media center perfeito.</p>
                <p>📺 O TVBOX vira o cliente que acessa seu servidor pessoal. Nesta página vamos avaliar se existe interesse em criar esse projeto.</p>
            </div>
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/croudfounding.php"; ?>
            <div class="news-block news-bottom-left">
                <h4>🛠️ Estamos trabalhando</h4>
                <ul>
                    <li>🛍️ Sistema para instalar direto deste site (tipo lojinha de apps)</li>
                    <li>💬 Comunicação simples para explicar que a configuração é pessoal</li>
                    <li>📘 Guia básico de configuração e uso</li>
                    <li>🔍 Guia com os melhores grupos e comunidades</li>
                    <li>desenvolvimento de sistema linux para instalar em computadores antigos</li>
                </ul>
            </div>
            <div class="news-block news-bottom-right">
                <h4>Limitações atuais ⚠️</h4>
                <ul>
                    <li>🫶🏻 Ajuda nas doações para pagar programadores e manter servidores ativos</li>
                    <li>🗳️ Precisamos do sistema de enquete para definir algumas ideias</li>
                    <li>🧪 Criar um grupo de teste</li>
                    <li>🧭 Criar um espaço de testes deixando claro que é para o desenvolvimento do Jellyfin (e não para problemas de internet ou listas)</li>
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
