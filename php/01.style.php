<style>
    /* Utilitarios de exibicao */
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

    /* Abas (tabs) */
    div.tab {
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
    }
    div.tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
    }
    div.tab button:hover {
        background-color: #ddd;
    }
    div.tab button.active {
        background-color: #ccc;
    }
    .tabcontent {
        display: none;
        padding: 6px 12px;
        border: 0px solid #ccc;
        border-top: none;
    }

    /* Acordeao */
    button.accordion {
        background-color: #eee;
        color: #444;
        cursor: pointer;
        padding: 18px;
        width: 100%;
        text-align: left;
        border: none;
        outline: none;
        transition: 0.4s;
    }
    button.accordion.active,
    button.accordion:hover {
        background-color: #ddd;
    }
    div.panel {
        padding: 0 18px;
        background-color: white;
        display: none;
    }

    /* Layout simples em colunas */
    .rowa {
        display: flex;
    }
    .coluna {
        flex: 50%;
    }

    /* Textareas ocupando largura total */
    textarea {
        width: 100%;
    }

    /* TV/desktop: tema escuro para reduzir brilho */
    @media (min-aspect-ratio: 16/9), (min-width: 1280px) {
        html,
        body {
            background-color: #0d1117;
            color: #c9d1d9;
            margin: 0;
        }
        a {
            color: #58a6ff;
        }
        a:hover {
            color: #79c0ff;
        }
        hr {
            border-color: #30363d;
        }
        .container {
            background-color: #0d1117;
        }
        button,
        .btn,
        input,
        select,
        textarea {
            background-color: #161b22;
            color: #c9d1d9;
            border: 1px solid #30363d;
        }
        input::placeholder,
        textarea::placeholder {
            color: #8b949e;
        }
        .news-grid {
            display: block;
            text-align: left;
        }
    .news-block {
        background-color: #0f1419;
        border: 1px solid #30363d;
        border-radius: 6px;
        padding: 14px;
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    .page-index-main .news-block {
        display: block;
        height: auto;
    }
    .page-index-main .news-block {
        overflow: visible;
    }
    .qr-section {
        display: block;
        margin-top: 8px;
    }
    .qr-image {
        display: block;
        width: 240px;
        max-width: 100%;
        height: auto;
        margin-top: 8px;
        background: #ffffff;
        padding: 6px;
        border-radius: 6px;
        box-sizing: border-box;
    }
        .news-block h3,
        .news-block h4 {
            margin: 0 0 8px 0;
        }
        .news-block p {
            margin: 6px 0;
        }
        .news-block ul {
            margin: 6px 0 0 18px;
            padding: 0;
        }
        .news-block li {
            margin: 6px 0;
        }
        .news-log {
            margin-top: 10px;
        }
        .news-log-item {
            padding: 8px 0;
            border-top: 1px solid #30363d;
        }
        .news-log-item:first-child {
            border-top: none;
        }
        .news-log-date {
            color: #8b949e;
            font-size: 12px;
        }
        .news-log-title {
            color: #e6edf3;
            font-weight: bold;
        }
        .news-log-desc {
            color: #c9d1d9;
        }
    }
    /* Forcar tema desktop no mobile (toggle) */
    .force-desktop-theme {
        background-color: #0d1117;
        color: #c9d1d9;
    }
    .force-desktop-theme a {
        color: #58a6ff;
    }
    .force-desktop-theme a:hover {
        color: #79c0ff;
    }
    .force-desktop-theme hr {
        border-color: #30363d;
    }
    .force-desktop-theme .container {
        background-color: #0d1117;
    }
    .force-desktop-theme button,
    .force-desktop-theme .btn,
    .force-desktop-theme input,
    .force-desktop-theme select,
    .force-desktop-theme textarea {
        background-color: #161b22;
        color: #c9d1d9;
        border: 1px solid #30363d;
    }
    .force-desktop-theme input::placeholder,
    .force-desktop-theme textarea::placeholder {
        color: #8b949e;
    }
    .force-desktop-theme .news-block {
        background-color: #0f1419;
        border: 1px solid #30363d;
    }
    .force-desktop-theme .news-log-item {
        border-top: 1px solid #30363d;
    }
    .force-desktop-theme .news-log-date {
        color: #8b949e;
    }
    .force-desktop-theme .news-log-title {
        color: #e6edf3;
    }
    .force-desktop-theme .news-log-desc {
        color: #c9d1d9;
    }
    @media (max-width: 1279px) {
        .news-grid {
            display: block;
            text-align: left;
        }
        .news-block {
            margin-bottom: 12px;
            width: 100%;
            text-align: left;
            position: relative;
        }
        .news-block + .news-block::before {
            content: "";
            display: block;
            height: 1px;
            background: #30363d;
            margin: -6px 0 10px 0;
        }
        .crowdfunding {
            margin-bottom: 12px;
        }
    }
    /* TVBOX index: layout em uma coluna com rolagem liberada */
    .client-tvbox .page-index-main {
        overflow: visible;
    }
    .client-tvbox html,
    .client-tvbox body {
        height: auto;
        min-height: 100%;
        overflow-y: auto;
    }
    .client-tvbox body {
        padding-top: 0 !important;
    }
    .client-tvbox body > .container {
        margin-right: 0;
        margin-left: 0;
        width: 100%;
        max-width: 100%;
        margin-top: 0 !important;
        padding-top: 0 !important;
        padding-right: 6px;
    }
    .client-tvbox .page-index-main .container {
        margin-right: 0;
        margin-left: 0;
        width: 100%;
        max-width: 100%;
        margin-top: 0 !important;
        padding-top: 0 !important;
        padding-right: 6px;
    }
    .client-tvbox .page-index-main .news-grid {
        display: block !important;
        text-align: left;
        margin-top: 0;
    }
    .client-tvbox .page-index-main .news-block {
        display: block;
        width: 100% !important;
        min-width: 0;
        margin: 0 0 12px 0 !important;
        height: auto;
        box-sizing: border-box;
        overflow: visible;
    }
    .client-tvbox html,
    .client-tvbox body {
        height: auto;
        min-height: 100%;
        overflow-y: scroll;
        -webkit-overflow-scrolling: touch;
    }
    .client-tvbox .page-index-main .news-block {
        margin-top: 0;
    }
    .client-tvbox .page-index-main .news-block h3,
    .client-tvbox .page-index-main .news-block h4 {
        margin-top: 0;
    }
    .client-tvbox .page-index-main .news-block:first-child {
        margin-top: 0;
    }
    /* Densidade por altura da tela (TVs e resolucoes variadas) */
    @media (min-height: 900px) {
        .news-grid {
            display: block;
        }
        .news-block {
            padding: 12px;
        }
        .news-block h3,
        .news-block h4 {
            font-size: 18px;
        }
        .news-block p,
        .news-block li {
            font-size: 14px;
            line-height: 1.3;
        }
    }
    @media (min-height: 700px) and (max-height: 899px) {
        .news-grid {
            display: block;
        }
        .news-block {
            padding: 12px;
        }
        .news-block h3,
        .news-block h4 {
            font-size: 18px;
        }
        .news-block p,
        .news-block li {
            font-size: 15px;
            line-height: 1.35;
        }
    }
    @media (max-height: 699px) {
        .news-grid {
            display: block;
        }
        .news-block {
            padding: 12px;
        }
        .news-block h3,
        .news-block h4 {
            font-size: 19px;
        }
        .news-block p,
        .news-block li {
            font-size: 16px;
            line-height: 1.4;
        }
    }
    @media (min-width: 1800px) {
        .news-block {
            padding: 10px;
            border-radius: 4px;
        }
        .news-block h3,
        .news-block h4 {
            font-size: 22px;
        }
        .news-block p,
        .news-block li,
        .news-block input,
        .news-block button {
            font-size: 16px;
        }
        .panel-tools .info-btn {
            font-size: 13px;
            padding: 4px 10px;
        }
    }
</style>
