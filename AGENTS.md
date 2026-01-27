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
- A maioria das páginas PHP inclui ambos no `<head>` (ex.: `index.php`, `news.php`, `painel.php`, `apps.php`, `user.php`, `log.php`, `userserial.php`, `contato.php`, `revendedor.php`, `messageToAdmin.php`, etc.).
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
- O navbar usa essa detecção em `index.navbar.php`:
  - `AndroidCel`/`iOS` => navbar com glyphicons.
  - `TVBOX`/`PC Win`/`PC Linux` => navbar com botões SVG.

## TVBOX: layout sem rolagem (index)
- Navbar vertical à direita, fixo, botões em coluna (ajustado em `index.navbar.php`).
- Para evitar sobreposição do navbar, o conteúdo ganha `margin-right` e `width` calculados no `php/01.style.php`.
- O Chrome 55 do TVBOX não suporta CSS Grid corretamente; a solução está em **Flexbox**.
- Para manter 2 blocos por “página” e evitar quebra, a combinação que funcionou foi:
  - `news-grid` com `display: flex`, `flex-wrap: nowrap`, `align-items: stretch` e altura baseada em `100vh`.
  - `news-block` com `flex: 1 1 0`, `min-width: 0`, `height: calc(100vh - 20px)` e `overflow: hidden`.
  - `index.php` aplica o modo TVBOX e o botão “Proxima” para paginar os blocos.
