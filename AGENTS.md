## Regras do Projeto
- Todo script criado deve comecar com:
```bash
#!/system/bin/sh
clear
path="$( cd "${0%/*}" && pwd -P )"
parent_path="$(dirname "$path")"
```
- Ambiente TVBOX limitado: apenas BusyBox e comandos basicos disponiveis para scripts.
- Scripts sao invocados por um launcher Linux que usa fzf.
- Nao adicionar `set -euo pipefail` nos scripts.
- Evitar usar `exit` nos scripts.
- Nao usar `read -p` ou `read -r -p` (BusyBox sh nao suporta); usar `printf` + `read`.
- Todo script criado deve terminar com (se nao estiver assim, padronize):

```bash
if [ ! "$1" == "skip" ]; then
    echo "Press any key to exit."
    read bah
fi

```
- Scripts de engine compartilhada nao devem incluir o prompt de `skip`; apenas os wrappers.
- Preferir `source` nas engines compartilhadas para herdar variaveis definidas nos wrappers.
- Nunca ler ou mexer fora do `cwd` do workspace.
- Nunca ler a pasta `.git`.
- Quando eu pedir um comando simples para debugar em terminal remoto, sempre envie os comandos em blocos de código (```bash ... ```), um comando por bloco, para facilitar copiar.

## Notas de layout global (CSS compartilhado)
- Ponto central de CSS global: `php/00.head.css.php` (links para CSS base) + `php/01.style.php` (estilos globais).
- No site atual apenas `index.php` inclui esses arquivos no `<head>`.
- `php/00.head.css.php` puxa os arquivos `/.code/css/*.css` (Bootstrap, heroic-features, catalogo, utils, blueimp-gallery, video-js).
- `php/01.style.php` define tema escuro e grid padrão (`.news-grid`, `.news-block`), além do toggle `.force-desktop-theme` para forçar o tema escuro em mobile.
- `php/01.style.php` também define ajustes de densidade por altura (telas altas/médias/baixas) para caber mais blocos sem rolagem.

## Detecção de device (atual)
- A detecção atual é por User-Agent (UA) e está centralizada em `index.php`.
- Regras de etiqueta:
  - `TVBOX` quando UA contém `Android 7.1.2`.
  - `AndroidCel` quando UA contém `Android` e **não** é TVBOX.
  - `iOS` quando UA contém `iphone|ipad|ipod`.
  - `PC Win` quando UA contém `windows`.
  - `PC Linux` quando UA contém `x11` ou `linux`.
- Fallback: `MOBILE`.

## Estado atual do site (atualizado)
- O site atual usa somente `index.php` como pagina principal

## Index.php: objetivo e funcionamento atual
- Objetivo: pagina unica do painel, com comunicado principal e area de interacao (QR no TVBOX ou cadastro em PC/celular).
- Detecao de device: por User-Agent, define `client_label` e `client_class` (`TVBOX`, `AndroidCel`, `iOS`, `PC Win`, `PC Linux`, fallback `MOBILE`).
- Conteudo: um unico bloco com texto do comunicado + area inferior condicional:
  - `TVBOX`: mostra QR Code do IP local do painel.
  - `PC/AndroidCel/iOS`: mostra cadastro rapido e resumo do ultimo cadastro salvo.
- QR Code: gera `ip_qr.png` usando `/.code/qrcode/qrlib.php` e cache em `/.code/qrcode/cache` apenas quando `client_label === 'TVBOX'`.
- Cadastro: grava linhas JSON em `/MinhaBox.json`, e le a ultima linha para exibir o ultimo cadastro.
- CSS: usa `php/00.head.css.php` + `php/01.style.php`, tema escuro e layout em coluna unica (sem grid/colunas).
- JS: apenas toggle de tema escuro no mobile (salvo em `localStorage`).

## Problema em aberto
- No TVBOX (Chrome antigo + controle remoto), a rolagem da pagina para antes do final; QR Code fica parcialmente fora da area visivel.
- A hipotese atual e limitacao de scroll no navegador/controle remoto, nao resolvida ainda.

