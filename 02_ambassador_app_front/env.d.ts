/// <reference types="vite/client" />

interface ImportMetaEnv {
    VITE_API_URL: string;
    // Adicione outras variáveis de ambiente conforme necessário
}

interface ImportMeta {
    readonly env: ImportMetaEnv;
}
