<div class="news-subbar" align="center">
    <a href="/news.php" class="btn btn-default">Voltar</a>
    <label class="theme-toggle">
        <input type="checkbox" id="mobile-theme-toggle" />
        <span>Tema escuro</span>
    </label>
    <a href="/news/novos-recursos-instalados.php" class="btn btn-default">Novos recursos instalados</a>
    <a href="/news/sistema-de-enquete.php" class="btn btn-default">Sistema de enquete</a>
    <a href="/news/celular-no-controle.php" class="btn btn-default">Celular no controle</a>
    <a href="/news/download-filmes.php" class="btn btn-default">Download Filmes</a>
    <a href="/news/gibiteca.php" class="btn btn-default">Gibiteca</a>
    <a href="/news/album-de-fotos.php" class="btn btn-default">Album de fotos</a>
    <a href="/news/kodi.php" class="btn btn-default">Kodi</a>
    <a href="/news/stremio.php" class="btn btn-default">Stremio</a>
    <a href="/news/servidor-jellyfin.php" class="btn btn-default">Servidor Jellyfin</a>
</div>
<style>
    .news-subbar {
        margin: 10px 0;
        text-align: left;
    }
    .news-subbar .btn {
        margin: 4px 6px;
        white-space: normal;
        display: inline-block;
    }
    .news-subbar .theme-toggle {
        display: none;
        align-items: center;
        gap: 6px;
        margin: 4px 6px;
        padding: 6px 10px;
        border: 1px solid #30363d;
        border-radius: 6px;
        background-color: #161b22;
        color: #c9d1d9;
        font-size: 12px;
        cursor: pointer;
    }
    .news-subbar .theme-toggle input {
        margin: 0;
    }
    @media (max-width: 1279px) {
        .news-subbar {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
        }
        .news-subbar .theme-toggle {
            display: inline-flex;
        }
        .news-subbar .btn,
        .news-subbar .theme-toggle {
            flex: 1 1 calc(50% - 12px);
            max-width: calc(50% - 12px);
        }
    }
</style>
<script>
    (function () {
        var toggle = document.getElementById('mobile-theme-toggle');
        if (!toggle) return;
        var key = 'newsThemeDesktop';
        var stored = localStorage.getItem(key);
        if (stored === '1') {
            document.body.classList.add('force-desktop-theme');
            toggle.checked = true;
        }
        toggle.addEventListener('change', function () {
            if (toggle.checked) {
                document.body.classList.add('force-desktop-theme');
                localStorage.setItem(key, '1');
            } else {
                document.body.classList.remove('force-desktop-theme');
                localStorage.setItem(key, '0');
            }
        });
    })();
</script>
