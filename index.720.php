<?php

$user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
$ua_lower = strtolower($user_agent);
$is_tvbox_client = (strpos($ua_lower, 'android 7.1.2') !== false);
$client_label = $is_tvbox_client ? 'TVBOX' : 'MOBILE';
$client_class = $is_tvbox_client ? 'client-tvbox' : 'client-mobile';

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

$qr_version = time();
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
    <title>TVBOX 720p</title>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "php/00.head.css.php"; ?>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "php/01.style.php"; ?>
    <style>
        html, body {
            height: 100%;
            overflow: hidden;
        }
        body {
            margin: 0;
        }
        .tvbox-720 {
            height: 100vh;
            width: 100vw;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .tvbox-720-inner {
            width: 100%;
            max-width: 100%;
            height: 100%;
            max-height: 100%;
            display: flex;
            gap: 12px;
            padding: 11px 11px 65px 11px;
            box-sizing: border-box;
        }
        .tvbox-720-left,
        .tvbox-720-right {
            background: rgba(0, 0, 0, 0.35);
            border: 1px solid #20242b;
            border-radius: 6px;
            padding: 12px;
            box-sizing: border-box;
        }
        .tvbox-720-left {
            flex: 1 1 62%;
        }
        .tvbox-720-right {
            flex: 1 1 38%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        .tvbox-720-title {
            font-size: 30px;
            margin: 0 0 10px 0;
        }
        .tvbox-720-left p,
        .tvbox-720-left li {
            font-size: 18px;
            line-height: 1.3;
            margin: 6px 0;
        }
        .tvbox-720-left ol {
            margin: 6px 0 8px 20px;
        }
        .tvbox-720-qr-title {
            font-size: 22px;
            margin: 0 0 8px 0;
        }
        .tvbox-720-qr-note {
            font-size: 16px;
            margin: 6px 0 10px 0;
        }
        .tvbox-720-qr-ip {
            font-size: 15px;
            margin: 0 0 10px 0;
            word-break: break-word;
        }
        .tvbox-720-qr-image {
            width: 320px;
            height: 320px;
            max-width: 38vh;
            max-height: 38vh;
            border-radius: 8px;
        }
    </style>
</head>
<body class="page-index-main <?php echo $client_class; ?>">
    <div class="tvbox-720">
        <div class="tvbox-720-inner">
            <div class="tvbox-720-left">
                <h3 class="tvbox-720-title">🤖 Painel TVBOX</h3>
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
            </div>
            <div class="tvbox-720-right">
                <h3 class="tvbox-720-qr-title">📲 QR Code do Painel</h3>
                <div class="tvbox-720-qr-note">Use o QR Code para abrir este painel no celular.</div>
                <div class="tvbox-720-qr-ip">Endereço local: http://<?php echo $local_ip; ?></div>
                <img class="tvbox-720-qr-image" src="/ip_qr.png?v=<?php echo $qr_version; ?>" alt="QR Code IP TVBOX">
            </div>
        </div>
    </div>
</body>
</html>
