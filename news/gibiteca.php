<?php

define('NEWS_TITLE', 'Gibiteca');
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
                <h3>Gibiteca 📚</h3>
                <p>Eu confesso: este é o recurso que eu mais sonho ter no TVBOX há mais de 10 anos 🤣. A ideia é simples e poderosa: o TVBOX conectado a um drive externo vira um hub, uma biblioteca organizada do seu acervo 🗂️.</p>
                <p>Imagina a quantidade de scans antigos e raridades que já não existem mais em papel. Também queremos permitir compartilhamento entre TVBOXes: cada um compartilha o que quiser, com quem quiser 🤝.</p>
                <p>O conteúdo fica hospedado no próprio TVBOX e pode ser baixado por este site (na TV 📺 ou no celular 📲). Os gibis ficam no 💾 HDD offline, sem depender de internet, com um leitor dinâmico para TV, monitor ou celular.</p>
            </div>
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/croudfounding.php"; ?>
            <div class="news-block news-bottom-left">
                <h4>Estamos trabalhando 🛠️</h4>
                <ul>
                    <li>📦 Usar formatos conhecidos (CBR/CBZ) ou criar um novo?</li>
                    <li>✂️ Corte de quadrinhos ajustado automaticamente ou pelo usuário?</li>
                    <li>🔗 Definir o sistema de compartilhamento</li>
                    <li>🧩 Definir o pareamento entre usuários</li>
                    <li>👀 Desenvolvimento do leitor para TV e monitor</li>
                </ul>
            </div>
            <div class="news-block news-bottom-right">
                <h4>Limitações atuais ⚠️</h4>
                <ul>
                    <li>🫶🏻 Ajuda nas doações para pagar programadores e manter servidores ativos</li>
                    <li>🤝 Buscando parcerias com sites e grupos de gibis</li>
                    <li>💾 Temos 4TB de gibis como acervo inicial, mas ainda é pouco para nossa sede de leitura 🤣🤣🤣</li>
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
