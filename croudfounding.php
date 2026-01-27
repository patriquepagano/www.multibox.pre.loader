<div class="news-block crowdfunding">
    <p>🗽 Somos uma equipe que atende fabricantes de TVBOX, trazendo um sistema base com atualização automática e uma ferramenta de distribuição de apps.</p>
    <p>ℹ️ É bom entender que os aplicativos são enviados pelo seu revendedor. Não temos acesso aos apps nem nos responsabilizamos pelo conteúdo.</p>
    <p>🤝 Nossa responsabilidade é manter seu TVBOX funcionando apesar de toda infraestrutura tecnológica e política brasileira.</p>
    <p>🧩 Estamos trabalhando para trazer esta nova função: <?php echo NEWS_TITLE; ?>. ⏳</p>
    <p>🫶🏻 Com sua ajuda financeira, chegamos até aqui. Todo mês entregamos: ⚙️ otimizações, 🛡️ antivírus e ✨ novas soluções.</p>
    <p>🤝 A gente agradece demais a galera que ajudou. Em especial:</p>
    <p>
        <?php
        $donators_file = $_SERVER['DOCUMENT_ROOT'] . "/donators.txt";
        $donators = array();
        if (file_exists($donators_file)) {
            $donators = file($donators_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        }
        $month = (int)date('n');
        if ($month == 12 || $month == 1) {
            $max_names = 7;
        } elseif ($month == 5) {
            $max_names = 33;
        } elseif ($month == 7 || $month == 8) {
            $max_names = 50;
        } else {
            $max_names = 11;
        }
        if (!empty($donators)) {
            $cache_file = $_SERVER['DOCUMENT_ROOT'] . "/news/.donators_cache.json";
            $month_key = date('Y-m');
            $selected = array();

            if (file_exists($cache_file)) {
                $cache_raw = file_get_contents($cache_file);
                $cache = json_decode($cache_raw, true);
                if (is_array($cache) && isset($cache[$month_key]) && is_array($cache[$month_key])) {
                    $selected = $cache[$month_key];
                }
            } else {
                $cache = array();
            }

            if (empty($selected)) {
                shuffle($donators);
                $selected = array_slice($donators, 0, $max_names);
                $cache[$month_key] = $selected;
                file_put_contents($cache_file, json_encode($cache));
            }

            $formatted = array();
            foreach ($selected as $name) {
                $formatted[] = "🫶🏻 $name";
            }
            echo implode(' ', $formatted);
        } else {
            echo "apoiadores da comunidade";
        }
        ?>
    </p>
    <p><b>Continuem nos ajudando: doações em bitcoin</b></p>
    <button type="button" class="btn btn-default" onclick="copyBitcoinAddress()">Copiar endereço bitcoin</button>
    <input type="text" id="btc-address" value="bc1q8jwdmpkhe5znjnstp8fwturtkql9208p69xlkd" style="position:absolute; left:-9999px;">
</div>
<script>
    function copyBitcoinAddress() {
        var field = document.getElementById('btc-address');
        field.select();
        field.setSelectionRange(0, 99999);
        try {
            document.execCommand('copy');
        } catch (e) {}
    }
</script>
