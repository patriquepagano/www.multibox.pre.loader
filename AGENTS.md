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


## Estado atual do site (agora)
- Ponto de entrada: `index.php` decide o layout e delega para páginas dedicadas.
- TVBOX: detectado por UA (`Android 7.1.2`), carrega layout dedicado `index.720.php`.
  - Primeiro load injeta JS para capturar `window.innerHeight` e recarrega a própria URL com `?tvh=...`.
  - Com `tvh` presente, faz `require` do `index.720.php` e encerra.
- PC (Windows/Linux): carrega `index.1080.php` para testar o layout 1080p no desktop.
- Mobile (Android/iOS e fallback): permanece no fluxo tradicional dentro do `index.php`.

## Layouts dedicados (TVBOX/PC)
- `index.720.php`: duas colunas fixas sem scroll (comunicado à esquerda, QR à direita).
- `index.1080.php`: cópia do `index.720.php` com fontes/QR ampliados para 1080p.
- Ambos incluem `php/00.head.css.php` e `php/01.style.php`.
- O conteúdo é travado em tela única, sem rolagem.

## QR Code (atual)
- Geração do QR Code do IP local usando `/.code/qrcode/qrlib.php`.
- Cache em `/.code/qrcode/cache` e IP em `/.ip_local.txt`.
- Arquivo gerado: `/ip_qr.png` (com cache bust por `filemtime`).

## Detecção de device (atual)
- A detecção atual é por User-Agent (UA) e está centralizada em `index.php`.
- Regras de etiqueta:
  - `TVBOX` quando UA contém `Android 7.1.2`.
  - `AndroidCel` quando UA contém `Android` e **não** é TVBOX.
  - `iOS` quando UA contém `iphone|ipad|ipod`.
  - `PC Win` quando UA contém `windows`.
  - `PC Linux` quando UA contém `x11` ou `linux`.
- Fallback: `MOBILE`.

