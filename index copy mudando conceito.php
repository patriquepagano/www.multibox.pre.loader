<?php

$user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
$ua_lower = strtolower($user_agent);
$is_tvbox_client = (strpos($ua_lower, 'android 7.1.2') !== false); // identifica TVBOX pelo UA
$client_label = 'MOBILE';
if ($is_tvbox_client) {
    $client_label = 'TVBOX';
} elseif (strpos($ua_lower, 'iphone') !== false || strpos($ua_lower, 'ipad') !== false || strpos($ua_lower, 'ipod') !== false) {
    $client_label = 'iOS';
} elseif (strpos($ua_lower, 'android') !== false) {
    $client_label = 'AndroidCel';
} elseif (strpos($ua_lower, 'windows') !== false) {
    $client_label = 'PC Win';
} elseif (strpos($ua_lower, 'x11') !== false || strpos($ua_lower, 'linux') !== false) {
    $client_label = 'PC Linux';
}
$form_status = ""; // status para mensagens de cadastro
$saved_payload = null; // ultimo cadastro salvo (se existir)
$show_form = false; // controla se mostra o formulario ou o resumo
$client_class = ($client_label === 'TVBOX') ? 'client-tvbox' : (($client_label === 'AndroidCel' || $client_label === 'iOS') ? 'client-mobile' : 'client-pc'); // classe base para CSS

// QR Code do IP local (usado apenas no modo TVBOX)
function getLocalIp()
{
    if (!empty($_SERVER['SERVER_ADDR'])) {
        return $_SERVER['SERVER_ADDR'];
    }
    $hostname = gethostname();
    if ($hostname) {
        $resolved = gethostbyname($hostname);
        if ($resolved && $resolved !== $hostname) {
            return $resolved;
        }
    }
    return "0.0.0.0";
}

$local_ip = getLocalIp();
$ip_cache_file = $_SERVER['DOCUMENT_ROOT'] . "/.ip_local.txt";
$qr_file = $_SERVER['DOCUMENT_ROOT'] . "/ip_qr.png";

if (!defined('NEWS_TITLE')) {
    define('NEWS_TITLE', 'Painel');
}

function readLastJsonLine($path)
{
    if (!file_exists($path)) {
        return null;
    }
    $fh = fopen($path, "r");
    if (!$fh) {
        return null;
    }
    $last = "";
    while (($line = fgets($fh)) !== false) {
        $line = trim($line);
        if ($line !== "") {
            $last = $line;
        }
    }
    fclose($fh);
    if ($last === "") {
        return null;
    }
    $data = json_decode($last, true);
    return is_array($data) ? $data : null;
}

// Controle do formulario de cadastro rapido
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['minhabox_edit'])) {
    $show_form = true;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['minhabox_form'])) {
    $show_form = false;
    $name = trim($_POST['name'] ?? '');
    $keyword = trim($_POST['keyword'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $whatsapp = trim($_POST['whatsapp'] ?? '');
    $telegram = trim($_POST['telegram'] ?? '');
    $tvbox = trim($_POST['tvbox'] ?? '');

    $payload = array(
        "created_at" => date('c'),
        "name" => $name,
        "keyword" => $keyword,
        "email" => $email,
        "whatsapp" => $whatsapp,
        "telegram" => $telegram,
        "tvbox" => $tvbox
    );

    $target = $_SERVER['DOCUMENT_ROOT'] . "/MinhaBox.json"; // arquivo de registros
    $line = json_encode($payload, JSON_UNESCAPED_UNICODE) . "\n";
    $ok = @file_put_contents($target, $line, FILE_APPEND | LOCK_EX);
    if ($ok === false) {
        $form_status = "Não foi possível salvar os dados no arquivo.";
    } else {
        $form_status = "Dados salvos com sucesso.";
        $saved_payload = $payload;
    }
}
if ($saved_payload === null) {
    $saved_payload = readLastJsonLine($_SERVER['DOCUMENT_ROOT'] . "/MinhaBox.json");
}

$qr_version = time();
if ($client_label === 'TVBOX') {
    $qr_base_dir = $_SERVER['DOCUMENT_ROOT'] . "/.code/qrcode";
    $qr_cache_dir = $qr_base_dir . "/cache";
    if (!file_exists($qr_cache_dir)) {
        @mkdir($qr_cache_dir, 0777, true);
    }
    for ($i = 0; $i <= 7; $i++) {
        $mask_dir = $qr_cache_dir . "/mask_" . $i;
        if (!file_exists($mask_dir)) {
            @mkdir($mask_dir, 0777, true);
        }
    }
    $cached_ip = "";
    if (file_exists($ip_cache_file)) {
        $cached_ip = trim(file_get_contents($ip_cache_file));
    }
    if ($cached_ip !== $local_ip || !file_exists($qr_file)) {
        file_put_contents($ip_cache_file, $local_ip);
        require_once $_SERVER['DOCUMENT_ROOT'] . "/.code/qrcode/qrlib.php";
        $qr_data = "http://" . $local_ip;
        QRcode::png($qr_data, $qr_file, 'L', 5, 2);
    }
    $qr_version = file_exists($qr_file) ? filemtime($qr_file) : time();
}

?>
<!DOCTYPE html>
<html class="<?php echo $client_class; ?>">
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
    <meta name="description" content="log de instalação">
    <meta name="keywords" content="log,install">
    <title>TVBOX</title>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "php/00.head.css.php"; ?>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "php/01.style.php"; ?>
    <style>
        .hidden-fb {
            opacity: 0;
            display: none;
        }

        .links > a {
            display: none;
        }

        .links > a:first-child {
            display: block;
        }

        .btn {
            margin-top: 5px;
        }
        .theme-toggle {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin: 6px 0;
            padding: 6px 10px;
            border: 1px solid #30363d;
            border-radius: 6px;
            background-color: #161b22;
            color: #c9d1d9;
            font-size: 12px;
            cursor: pointer;
        }
        .theme-toggle input {
            margin: 0;
        }
        .panel-tools {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            margin: 6px 0 8px;
        }
        .info-btn {
            border: 1px dashed #3d444d;
            border-radius: 999px;
            background: transparent;
            color: #c9d1d9;
            padding: 6px 12px;
            font-size: 12px;
            cursor: default;
        }
    </style>
</head>
<body class="page-index-main <?php echo $client_class; ?>">
    <!-- Container Start -->
    <div class="container" style="margin-top: 1px;" align="center">
        <div class="row">
            <div class="news-grid">
                <div class="news-block news-top-right">
                    <h3>🤖 Painel TVBOX</h3>
                    <div class="panel-tools">
                        <?php if ($client_label === 'AndroidCel' || $client_label === 'iOS') { ?>
                            <label class="theme-toggle">
                                <input type="checkbox" id="mobile-theme-toggle" />
                                <span>Tema escuro</span>
                            </label>
                        <?php } ?>
                    </div>
                    <div>
                        <p>🙂 Fique tranquilo: o aparelho está funcionando normalmente e continua recebendo atualizações de segurança.</p>
                        <p>⚠️ Nos últimos meses, muitas marcas pararam por bloqueios e por questões de impostos e taxas. 💸 Com menos clientes em serviços oficiais de streaming, a arrecadação caiu, e isso mudou o cenário no Brasil.</p>
                        <p>👥 Entenda as equipes envolvidas:</p>
                        <ol>
                            <li>🏭 Fabricante: produz o aparelho fisico e garante a qualidade do hardware.</li>
                            <li>🛠️ Plataforma (nós): fornecemos o sistema base, atualizações e a infraestrutura que mantém o aparelho funcionando.</li>
                            <li>🧑‍💼 Revendedor: entrega a solução final da marca, publica os aplicativos e presta o suporte ao cliente.</li>
                        </ol>
                        <p>⚠️ Importante: os aplicativos e o conteúdo são de responsabilidade do revendedor. 📵 Nós não temos acesso aos apps nem ao conteúdo enviado.</p>
                        <p>🧾 Por que estamos pedindo recadastro? 🇧🇷 O Brasil vive um momento de alta carga de impostos e taxas, e isso pressiona toda as equipes. 📈 Além disso, o crescimento de ativações e o controle exigido pelos órgãos reguladores aumentaram nossas responsabilidades. 🛡️ Para proteger seu aparelho e manter a estabilidade do sistema, precisamos organizar todos os aparelhos por revendedor oficial.</p>
                    </div>
                    <hr>
                        <?php if ($client_label === 'TVBOX') { ?>
                            <h3>📲 QR Code do Painel</h3>
                            <div class="qr-section">
                                <p>Use o QR Code para abrir este painel no celular.</p>
                                <p>Endereço local: http://<?php echo $local_ip; ?></p>
                                <img class="qr-image" src="/ip_qr.png?v=<?php echo $qr_version; ?>" alt="QR Code IP TVBOX">
                        </div>
                    <?php } else { ?>
                        <h3><?php echo ($saved_payload && !$show_form) ? '🤗 Registrado com sucesso!' : '✍🏻 Cadastro rápido'; ?></h3>
                        <?php if ($form_status !== "") { ?>
                            <p><b><?php echo $form_status; ?></b></p>
                        <?php } ?>
                        <?php if ($saved_payload && !$show_form) { ?>
                            <div style="display: flex; gap: 12px; align-items: flex-start; flex-wrap: wrap;">
                                <div style="flex: 1 1 240px;">
                                    <?php
                                    $sv_name = htmlspecialchars($saved_payload['name'] ?? '', ENT_QUOTES, 'UTF-8');
                                    $sv_keyword = htmlspecialchars($saved_payload['keyword'] ?? '', ENT_QUOTES, 'UTF-8');
                                    $sv_email = htmlspecialchars($saved_payload['email'] ?? '', ENT_QUOTES, 'UTF-8');
                                    $sv_whatsapp = htmlspecialchars($saved_payload['whatsapp'] ?? '', ENT_QUOTES, 'UTF-8');
                                    $sv_telegram = htmlspecialchars($saved_payload['telegram'] ?? '', ENT_QUOTES, 'UTF-8');
                                    $sv_tvbox = htmlspecialchars($saved_payload['tvbox'] ?? '', ENT_QUOTES, 'UTF-8');
                                    ?>
                                    <p style="font-size: 18px;"><b><?php echo $sv_name; ?></b>, seja bem-vindo!</p>
                                    <p>Seu TVBOX <b style="font-size: 18px;"><?php echo $sv_tvbox; ?></b> vai receber todas as atualizações.</p>
                                    <p>Em nossa comunidade você será chamado como <b style="font-size: 18px;"><?php echo $sv_name . "." . $sv_keyword; ?></b> para participar de enquetes, sorteios e promoções exclusivas.</p>
                                    <p>Seus contatos pessoais não serão compartilhados com ninguém.</p>
                                    <p>Email: <?php echo $sv_email; ?></p>
                                    <p>WhatsApp: <?php echo $sv_whatsapp; ?></p>
                                    <p>Telegram: <?php echo $sv_telegram; ?></p>
                                </div>
                            </div>
                            <form method="post" action="">
                                <input type="hidden" name="minhabox_edit" value="1">
                                <p><button type="submit" class="btn btn-default">Alterar cadastro</button></p>
                            </form>
                        <?php } else { ?>
                            <div class="cadastro-hints">
                                <p>⚠️ Você ainda não registrou seu TVBOX e isso é necessário para receber atualizações e manter todo o funcionamento.</p>
                                <p>🧰 Se precisar de suporte , todo o procedimento será feito pelos contatos que você informar aqui.</p>
                                <p>❤︎ Seja gentil! Nomes ofensivos ou insultos podem gerar denúncias na comunidade.</p>
                                <p>📌 Fique atento: não verificamos contatos automaticamente.</p>
                            </div>
                            <form method="post" action="">
                                <input type="hidden" name="minhabox_form" value="1">
                                <p><input type="text" name="name" placeholder="Nome (seu primeiro nome real ou nickname)" style="width: 100%;" required></p>
                                <p><input type="text" name="keyword" placeholder="Palavra-chave (recomendamos um animal ou vegetal)" style="width: 100%;" required></p>
                                <p><input type="email" name="email" placeholder="Email (digite um email válido pois ele não será confirmado)" style="width: 100%;" required></p>
                                <p><input type="text" name="whatsapp" placeholder="WhatsApp (padrão +55 ddd 9 12345678)" style="width: 100%;" required></p>
                                <p><input type="text" name="telegram" placeholder="Telegram (padrão +55 ddd 9 12345678)" style="width: 100%;" required></p>
                                <p><input type="text" name="tvbox" placeholder="TVBOX (ex: sala, cozinha, garagem)" style="width: 100%;" required></p>
                                <p><button type="submit" class="btn btn-default">Salvar</button></p>
                            </form>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
            <!-- Footer -->
            <footer>
                <?php include $_SERVER['DOCUMENT_ROOT'] . "php/footer.php"; ?>
            </footer>
        </div>
        <!-- Container End -->
        <!-- Javascript Libraries -->
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
</body>
</html>
