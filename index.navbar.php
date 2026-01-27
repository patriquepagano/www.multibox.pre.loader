<!-- Barra de navegacao fixa do painel -->
<?php
$ua = strtolower($_SERVER['HTTP_USER_AGENT'] ?? '');
$is_tvbox = (strpos($ua, 'android 7.1.2') !== false);
$is_ios = (strpos($ua, 'iphone') !== false || strpos($ua, 'ipad') !== false || strpos($ua, 'ipod') !== false);
$is_android = (strpos($ua, 'android') !== false);
$is_androidcel = ($is_android && !$is_tvbox);
$use_mobile_nav = ($is_androidcel || $is_ios);
$client_class = $is_tvbox ? 'client-tvbox' : ($use_mobile_nav ? 'client-mobile' : 'client-pc');
?>
<div id="top"><a href="top"></a></div>
<script>
    (function () {
        var cls = '<?php echo $client_class; ?>';
        if (document && document.documentElement && cls) {
            document.documentElement.classList.add(cls);
        }
        if (document && document.body && cls) {
            document.body.classList.add(cls);
        } else if (document && cls) {
            document.addEventListener('DOMContentLoaded', function () {
                document.documentElement.classList.add(cls);
                document.body.classList.add(cls);
            });
        }
    })();
</script>
<style>
    /* Alterna entre botoes grandes (TV) e glyphicons (celular) via PHP */
    .nav-tv,
    .nav-mobile {
        display: inline-block;
    }
    /* Respiro vertical para os botoes no navbar */
    #navigation-bar .navbar-header {
        padding: 6px 0;
    }
    .nav-tv {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        gap: 8px 10px;
    }
    .nav-tv a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        vertical-align: middle;
    }
    .nav-tv svg {
        display: block;
    }
    .tvbox-page-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 128px;
        height: 48px;
        border-radius: 8px;
        background: #1e242b;
        color: #e7f1ef;
        border: 2px solid #0f1419;
        font-size: 12px;
        text-decoration: none;
    }
    .client-tvbox #navigation-bar {
        position: fixed;
        top: 0;
        right: 0;
        left: auto;
        height: 100%;
        width: 180px;
        overflow-y: auto;
        background: transparent;
        border: none;
        box-shadow: none;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    .client-tvbox .navbar {
        left: auto !important;
        right: 0 !important;
        width: 180px !important;
        min-height: 100%;
        border: none;
    }
    .client-tvbox #navigation-bar .container,
    .client-tvbox #navigation-bar .navbar-header {
        width: 100%;
        max-width: 100% !important;
        padding: 0 !important;
        text-align: center;
        background: transparent;
        margin: 0 !important;
        box-sizing: border-box;
    }
    .client-tvbox #navigation-bar .navbar-header {
        padding: 8px 6px !important;
    }
    .client-tvbox .nav-tv {
        display: flex !important;
        flex-direction: column;
        gap: 6px;
        align-items: center;
        width: 100%;
        box-sizing: border-box;
        padding: 0 4px 8px 4px;
    }
    .client-tvbox .nav-tv a {
        width: 140px;
        display: inline-flex;
        justify-content: center;
    }
    .client-tvbox .nav-tv svg {
        width: 140px;
        height: 48px;
    }
</style>
<nav id="navigation-bar" class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <?php if (!$use_mobile_nav) { ?>
            <span class="nav-tv">
                <?php if ($is_tvbox) { ?>
                <a href="#" class="tvbox-page-btn" id="tvbox-next" aria-label="Proxima pagina">Proxima</a>&nbsp;
                <?php } ?>
                <a href="/" id="navbar-brand" aria-label="Favoritos">
                    <svg xmlns="http://www.w3.org/2000/svg" width="128" height="48" viewBox="0 0 128 48" role="img" aria-label="Favoritos">
                        <defs>
                            <linearGradient id="bg-favoritos" x1="0" y1="0" x2="0" y2="1">
                                <stop offset="0" stop-color="#2f3a44"/>
                                <stop offset="1" stop-color="#1e242b"/>
                            </linearGradient>
                        </defs>
                        <rect x="1" y="1" width="126" height="46" rx="8" fill="url(#bg-favoritos)" stroke="#0f1419" stroke-width="2"/>
                        <path d="M28 13 L32 22 L42 23 L34 29 L36 39 L28 33 L20 39 L22 29 L14 23 L24 22 Z" fill="#e7f1ef"/>
                        <text x="54" y="30" font-family="Arial, sans-serif" font-size="12" fill="#e7f1ef">Favoritos</text>
                    </svg>
                </a>&nbsp;
                <a href="/contato.php" id="opt-fit-width" aria-label="Contato">
                    <svg xmlns="http://www.w3.org/2000/svg" width="128" height="48" viewBox="0 0 128 48" role="img" aria-label="Contato">
                        <defs>
                            <linearGradient id="bg-contato" x1="0" y1="0" x2="0" y2="1">
                                <stop offset="0" stop-color="#2f3a44"/>
                                <stop offset="1" stop-color="#1e242b"/>
                            </linearGradient>
                        </defs>
                        <rect x="1" y="1" width="126" height="46" rx="8" fill="url(#bg-contato)" stroke="#0f1419" stroke-width="2"/>
                        <circle cx="28" cy="20" r="7" fill="#e7f1ef"/>
                        <rect x="18" y="28" width="20" height="10" rx="5" fill="#e7f1ef"/>
                        <text x="54" y="30" font-family="Arial, sans-serif" font-size="12" fill="#e7f1ef">Contato</text>
                    </svg>
                </a>&nbsp;
                <a href="/painel.php" id="navbar-brand" aria-label="Painel">
                    <svg xmlns="http://www.w3.org/2000/svg" width="128" height="48" viewBox="0 0 128 48" role="img" aria-label="Painel">
                        <defs>
                            <linearGradient id="bg-painel" x1="0" y1="0" x2="0" y2="1">
                                <stop offset="0" stop-color="#2f3a44"/>
                                <stop offset="1" stop-color="#1e242b"/>
                            </linearGradient>
                        </defs>
                        <rect x="1" y="1" width="126" height="46" rx="8" fill="url(#bg-painel)" stroke="#0f1419" stroke-width="2"/>
                        <circle cx="26" cy="26" r="9" fill="#e7f1ef"/>
                        <circle cx="26" cy="26" r="4" fill="#1e242b"/>
                        <rect x="24" y="14" width="4" height="6" fill="#e7f1ef"/>
                        <rect x="24" y="32" width="4" height="6" fill="#e7f1ef"/>
                        <rect x="16" y="24" width="6" height="4" fill="#e7f1ef"/>
                        <rect x="30" y="24" width="6" height="4" fill="#e7f1ef"/>
                        <rect x="18" y="17" width="4" height="4" transform="rotate(-45 20 19)" fill="#e7f1ef"/>
                        <rect x="30" y="17" width="4" height="4" transform="rotate(45 32 19)" fill="#e7f1ef"/>
                        <rect x="18" y="31" width="4" height="4" transform="rotate(45 20 33)" fill="#e7f1ef"/>
                        <rect x="30" y="31" width="4" height="4" transform="rotate(-45 32 33)" fill="#e7f1ef"/>
                        <text x="54" y="30" font-family="Arial, sans-serif" font-size="12" fill="#e7f1ef">Painel</text>
                    </svg>
                </a>&nbsp;
                <a href="/news.php" id="opt-fit-width" aria-label="News">
                    <svg xmlns="http://www.w3.org/2000/svg" width="128" height="48" viewBox="0 0 128 48" role="img" aria-label="News">
                        <defs>
                            <linearGradient id="bg-news" x1="0" y1="0" x2="0" y2="1">
                                <stop offset="0" stop-color="#2f3a44"/>
                                <stop offset="1" stop-color="#1e242b"/>
                            </linearGradient>
                        </defs>
                        <rect x="1" y="1" width="126" height="46" rx="8" fill="url(#bg-news)" stroke="#0f1419" stroke-width="2"/>
                        <rect x="16" y="16" width="26" height="18" rx="2" fill="#e7f1ef"/>
                        <rect x="19" y="19" width="8" height="6" fill="#1e242b"/>
                        <rect x="29" y="19" width="10" height="2" fill="#1e242b"/>
                        <rect x="29" y="23" width="10" height="2" fill="#1e242b"/>
                        <rect x="19" y="28" width="20" height="2" fill="#1e242b"/>
                        <text x="54" y="30" font-family="Arial, sans-serif" font-size="12" fill="#e7f1ef">News</text>
                    </svg>
                </a>&nbsp;
                <a href="/log.php" id="opt-fit-width" aria-label="Log">
                    <svg xmlns="http://www.w3.org/2000/svg" width="128" height="48" viewBox="0 0 128 48" role="img" aria-label="Log">
                        <defs>
                            <linearGradient id="bg-log" x1="0" y1="0" x2="0" y2="1">
                                <stop offset="0" stop-color="#2f3a44"/>
                                <stop offset="1" stop-color="#1e242b"/>
                            </linearGradient>
                        </defs>
                        <rect x="1" y="1" width="126" height="46" rx="8" fill="url(#bg-log)" stroke="#0f1419" stroke-width="2"/>
                        <rect x="16" y="16" width="28" height="18" rx="4" fill="#e7f1ef"/>
                        <path d="M24 34 L20 40 L30 34 Z" fill="#e7f1ef"/>
                        <text x="54" y="30" font-family="Arial, sans-serif" font-size="12" fill="#e7f1ef">Log</text>
                    </svg>
                </a>&nbsp;
                <a href="/controleremoto.php" id="opt-fit-width" aria-label="Controle">
                    <svg xmlns="http://www.w3.org/2000/svg" width="128" height="48" viewBox="0 0 128 48" role="img" aria-label="Controle">
                        <defs>
                            <linearGradient id="bg-controle" x1="0" y1="0" x2="0" y2="1">
                                <stop offset="0" stop-color="#2f3a44"/>
                                <stop offset="1" stop-color="#1e242b"/>
                            </linearGradient>
                        </defs>
                        <rect x="1" y="1" width="126" height="46" rx="8" fill="url(#bg-controle)" stroke="#0f1419" stroke-width="2"/>
                        <circle cx="28" cy="26" r="10" fill="none" stroke="#e7f1ef" stroke-width="3"/>
                        <rect x="27" y="12" width="2" height="10" fill="#e7f1ef"/>
                        <text x="54" y="30" font-family="Arial, sans-serif" font-size="12" fill="#e7f1ef">Controle</text>
                    </svg>
                </a>&nbsp;
                <a href="/apps.php" id="opt-fit-width" aria-label="Apps">
                    <svg xmlns="http://www.w3.org/2000/svg" width="128" height="48" viewBox="0 0 128 48" role="img" aria-label="Apps">
                        <defs>
                            <linearGradient id="bg-apps" x1="0" y1="0" x2="0" y2="1">
                                <stop offset="0" stop-color="#2f3a44"/>
                                <stop offset="1" stop-color="#1e242b"/>
                            </linearGradient>
                        </defs>
                        <rect x="1" y="1" width="126" height="46" rx="8" fill="url(#bg-apps)" stroke="#0f1419" stroke-width="2"/>
                        <rect x="18" y="16" width="8" height="8" rx="2" fill="#e7f1ef"/>
                        <rect x="30" y="16" width="8" height="8" rx="2" fill="#e7f1ef"/>
                        <rect x="18" y="28" width="8" height="8" rx="2" fill="#e7f1ef"/>
                        <rect x="30" y="28" width="8" height="8" rx="2" fill="#e7f1ef"/>
                        <text x="54" y="30" font-family="Arial, sans-serif" font-size="12" fill="#e7f1ef">Apps</text>
                    </svg>
                </a>&nbsp;
                <a href="/hdd.php" id="opt-fit-width" aria-label="HDD">
                    <svg xmlns="http://www.w3.org/2000/svg" width="128" height="48" viewBox="0 0 128 48" role="img" aria-label="HDD">
                        <defs>
                            <linearGradient id="bg-hdd" x1="0" y1="0" x2="0" y2="1">
                                <stop offset="0" stop-color="#2f3a44"/>
                                <stop offset="1" stop-color="#1e242b"/>
                            </linearGradient>
                        </defs>
                        <rect x="1" y="1" width="126" height="46" rx="8" fill="url(#bg-hdd)" stroke="#0f1419" stroke-width="2"/>
                        <rect x="16" y="16" width="28" height="16" rx="3" fill="#e7f1ef"/>
                        <circle cx="24" cy="24" r="3" fill="#1e242b"/>
                        <circle cx="34" cy="24" r="3" fill="#1e242b"/>
                        <text x="54" y="30" font-family="Arial, sans-serif" font-size="12" fill="#e7f1ef">HDD</text>
                    </svg>
                </a>&nbsp;
            </span>
            <?php } ?>
            <?php if ($use_mobile_nav) { ?>
            <span class="nav-mobile">
                <a href="/" id="navbar-brand"><span class="btn btn-default glyphicon glyphicon-star"></span></a>&nbsp;
                <a href="/contato.php" id="opt-fit-width"><span class="btn btn-default glyphicon glyphicon-user"></span></a>&nbsp;
                <a href="/painel.php" id="navbar-brand"><span class="btn btn-default glyphicon glyphicon-wrench"></span></a>&nbsp;
                <a href="/news.php" id="opt-fit-width"><span class="btn btn-default glyphicon glyphicon-bullhorn"></span></a>&nbsp;
                <a href="/log.php" id="opt-fit-width"><span class="btn btn-default glyphicon glyphicon-comment"></span></a>&nbsp;
                <a href="/controleremoto.php" id="opt-fit-width"><span class="btn btn-default glyphicon glyphicon-off"></span></a>&nbsp;
                <a href="/apps.php" id="opt-fit-width"><span class="btn btn-default glyphicon glyphicon-th parece apps"></span></a>&nbsp;
                <a href="/hdd.php" id="opt-fit-width"><span class="btn btn-default glyphicon glyphicon-hdd"></span></a>&nbsp;
            </span>
            <?php } ?>
        </div>
    </div>
</nav>
